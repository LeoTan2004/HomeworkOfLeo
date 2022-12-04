<?php
$username = $_POST['username']??"";
$password = $_POST['pwd']??"";
echo json_encode($log->sign_up($username,$password));