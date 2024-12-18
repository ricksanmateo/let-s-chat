<?php

session_start();
// check if logged in
$info = (object) [];
if (!isset($_SESSION['userid'])) {
    if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != 'login') {
        $info->logged_in = false;
        echo json_encode($info);
        exit;
    }
}

require_once './classes/autoload.php';
$DB = new Database();
$DATA_RAW = file_get_contents('php://input');
$DATA_OBJ = json_decode($DATA_RAW);

$Error = '';
// process the data
if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'signup') {
    // signup
    include './includes/signup.php';
} elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'login') {
    include './includes/login.php';
} elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'logout') {
    include './includes/logout.php';
} elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'user_info') {
    include './includes/user_info.php';
}
