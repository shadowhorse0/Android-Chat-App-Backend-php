<?php
include "../db/db.php";
// dummy values to check php is correct
// $data = new \stdClass();
// $data->username = "vaibhav";
// $data->email = "vaibhav.111padghan";
// $data->phone = "7517263842";
// $data->password = "vaibhav";

// $data = json_encode($data);
// $request_type = "signup";

//dummy values finish here
$request_type = $_POST['request_type'];
$data = $_POST['data'];
$data = json_decode($data, true);
$response = null;


switch ($request_type) {
    case "signup":
        $response['status'] = true;
        $username = $data['username'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = $data['password'];

        

        try {
            //check if anything is blank
            

            //check username here
            if (strlen($username) == 0) {
                throw new Exception("Username must not be blank!");
            }

            //check email here
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email is not valid!");
            }

            //check phone here
            if (strlen($phone) != 10) {
                throw new Exception("Phone number must be of 10 digit!");
            }

            //check password here
            if (strlen($password) <= 5) {
                throw new Exception("Password length must be greater than 5 characters!");
            }


            //Check if email already exits
            $sql = "SELECT * FROM `users` WHERE `email`='$email'";
            $result = $conn->query($sql);
            if ($result->num_rows >= 1) {
                throw new Exception("Email already exists!!");
            }

            //Check if username already exits
            $sql = "SELECT * FROM `users` WHERE `username`='$username'";
            $result = $conn->query($sql);
            if ($result->num_rows >= 1) {
                throw new Exception("Username already exists!!");
            }

            $sql = "INSERT INTO `users`(`username`, `email`, `password`, `phone`) VALUES ('$username','$email','$phone','$password')";
            $result = $conn->query($sql);

            $response['status'] = true;
            $response['msg'] = "Sign up Successfull!!";
        } catch (Exception $e) {
            $response['status'] = false;
            $response['msg'] = $e->getMessage();
        }
        break;

        //case for sign in

    case "signup":
        $response['status'] = true;
        $username = $data['signin_username'];
        $password = $data['signin_password'];

        

        try{
            $sql = "SELECT * FROM `users` WHERE `username`='$username' && 'password' ='$password'";
            $result = $conn->query($sql);
            $noOF=mysqli_num_rows($result);
            if($noOF!=1){
                throw new Exception("not such user");
            }
         

            $response['status'] = true;
            $response['msg'] = "Sign in Successfully!!";

        }
        catch (Exception $e) {
            $response['status'] = false;
            $response['msg'] = $e->getMessage();
        }
        break;





}

$response = json_encode($response);
echo $response;
