<?php
$request_type = $_POST['request_type'];
$data = $_POST['data'];
$data = json_decode($data, true);
$response = $request_type;
$response=null;

switch ($request_type) {
    case "signup":
        $response['status'] = true;
        $username = $data['username'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = $data['password'];




        $sql = "INSERT INTO `users`(`username`, `email`, `password`, `phone`) VALUES ('$username','$email','$phone','$password')";
        $result=$conn->query($sql);
        if(!$result){
            $response["error"]=$conn->error;
        }
        else{
            $response["status"]=true;
            $response["msg"]="Your test was successfull";
        }
        break;
}

$response = json_encode($response);
echo $response;
