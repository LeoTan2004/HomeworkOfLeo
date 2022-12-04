<?php
require '__business.php';
$username = $_POST['username']??"";
$password = $_POST['pwd']??"";
$password_changed = $_POST['changed-pwd']??"";
$option = $_POST['operation']??"";
$log = new login();
$info = new doInfo();
switch ($option){
    case 'login':
        $s =  $log->sign_in($username,$password);
        echo json_encode($s);
        if ($s->code==0){
            echo json_encode($info->getInfo($username));
        }
        break;
    case 'sign-up':
        $s =  json_encode($log->sign_up($username,$password));
        break;
    case 'login-out':
        echo json_encode($log->sign_out($username.$password));
        break;
    case 'change-pwd':
        echo $log->change_password($username,$password,$password_changed);
}
