<?php
$username = $_POST['username'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$zip = $_POST['zip'];
$email = $_POST['email'];
$password = $_POST['password'];
//$param_password = password_hash($password, PASSWORD_DEFAULT);

if( !empty($username) || !empty($first_name) || !empty($last_name) || !empty($gender) || !empty($phone) || !empty($address) || !empty($city) || !empty($state) || !empty($country) || !empty($zip) || !empty($email) || !empty($password))
{
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "exact";


    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname); 

    if(mysqli_connect_error())
    {
        die('Connect Error('. mysqli_connect_errno(). ')' . mysqli_connect_error());
    }

    else
    {
        //$SELECT = "SELECT email from user_info where email = ? Limit 1";
        $SELECT= "SELECT username from user_info where username = ? Limit 1";
        $password = password_hash($password, PASSWORD_DEFAULT); 
        $INSERT = "INSERT into user_info (username, first_name, last_name, gender, phone, address, city, state, country, zip, email, password) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        /*$stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;*/

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($username);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum == 0)
        {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssissssiss", $username, $first_name, $last_name, $gender, $phone, $address, $city, $state, $country, $zip, $email, $password);
            
           // $param_username = $username;
            
            $stmt-> execute();
            header('Location: index.html');
            //echo "New Record inserted successfully";

        }

        else
        {
            echo "Somebody already registered using this username. Please try a new username";
        }
        $stmt->close();
        $conn->close(); 




    }

}

else
{
    echo "All fields are required";
    die();
}










?>
