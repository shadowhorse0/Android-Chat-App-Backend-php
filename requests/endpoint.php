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
}

$response = json_encode($response);
echo $response;
