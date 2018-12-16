Python 3.6.6 (v3.6.6:4cf1f54eb7, Jun 27 2018, 03:37:03) [MSC v.1900 64 bit (AMD64)] on win32
Type "copyright", "credits" or "license()" for more information.
>>> import numpy as np
import cv2
import pytesseract
from datetime import datetime, date
import os
SyntaxError: multiple statements found while compiling a single statement
>>> if __name__ == '__main__':

    image = ''

    option = int(input("Input 1 to capture image \nInput 2 to get image from the local folder\n"))

    if option == 1:
        # Open camera using OpenCV
        camera = cv2.VideoCapture(0)

        # Check if camera opened successfully
        if not camera.isOpened():
            print("Error opening video stream or file")
        else:
            # Read until video is completed
            print("Press Q to capture a photo of NID card")
            while camera.isOpened():
                # Capture frame-by-frame
                ret, image = camera.read()

                if ret:

                    # Display the resulting frame
                    cv2.imshow('Frame', image)

                    # Press Q on keyboard to  exit
                    if cv2.waitKey(25) & 0xFF == ord('q'):
                        break

                # Break the loop
                else:
                    break

            # When everything done, release the video capture object
            camera.release()

            # Closes all the frames
            cv2.destroyAllWindows()
    else:
        # Read image using opencv
        if os.path.isfile('image1.jpg'):
            image = cv2.imread('image1.jpg')

    if image is not '':
        # Read image text and get date of birth as string
        dob = get_birthdate_string(image)

        if dob != 'no':

            # Calculating age
            age = calculate_age(datetime.strptime(dob, "%d %b %Y"))

            print("User's age is ", age)
            
            # Checking if age is 21+ or not
            is21plus(age)
        else:
            print("OCR could not read the image properly, please try again")
    else:
        print("No image found")

