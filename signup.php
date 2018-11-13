<?php

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

if(!empty($first_name) || !empty($last_name) || !empty(gender) || !empty(phone) || !empty(address) || !empty(city) || !empty(state) || !empty(country) || !empty(zip) || !empty(email) || !empty(password))
{
     
     $host = "localhost";
     $dbUsername = "root";
     $dbPassword = "";
     $dbname = "customer_info";

     //create connection
     $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
     if(mysqli_connect_error())
     {
     	die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
     }

     else
     {
     	$SELECT = "SELECT email From sign_up where email = ? Limit 1";
     	$INSERT = "INSERT Into sign_up (first_name, last_name, gender, phone, address, city, state, country, zip, email, password) values(?, ?, ?, ?, ?, ?, ?, ?
     		, ?, ?, ?)";

        //Prepare Statement
       
       $stmt = $conn -> prepare($SELECT);
       $stmt->bind_param("s", $email);
       $stmt->execute();
       $stmt->bind_result($email);
       $stmt->store_result();
       $rnum = $stmt->num_rows;

       if($rnum ==0)
       {
       	$stmt->close();
       	$stmt = $conn->prepare($INSERT);
       	$stmt->bind_param("sssissssiss", $first_name, $last_name, $gender, $phone, $address, $city, $state, $country, $zip, $email, $password);
       	$stmt->execute();
       	echo "New record inserted successfully";

       }
       else
       {
            echo "Someone already registered using this email";

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