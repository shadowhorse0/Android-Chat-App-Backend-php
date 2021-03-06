<?php
$request_type = $_POST['request_type'];
$data = $_POST['data'];
$data = json_decode($data, true);
$response = $request_type;
$response['hello'] = "helllo";

switch ($request_type) {
    case "signup":
        $response['status'] = true;
        $username = $data['username'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = $data['password'];




        $sql = "INSERT INTO `users`(`username`, `email`, `password`, `phone`) VALUES ('$username','$email','$phone','$password')";
        $conn->query($sql);
        break;
}

$response = json_encode($response);
echo $response;
