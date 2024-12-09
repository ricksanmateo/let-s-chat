<?php

require_once './classes/autoload.php';
$DB = new Database();
$DATA_RAW = file_get_contents('php://input');
$DATA_OBJ = json_decode($DATA_RAW);

// process the data
if (isset($DATA_OBJ['data_type']) && $DATA_OBJ['data_type'] == 'signup') {
    $data = false;
    $data['userid'] = $DB->generate_id(20);
    $data['username'] = $DATA_OBJ['username'];
    $data['email'] = $DATA_OBJ['email'];
    $data['gender'] = $DATA_OBJ['gender'];
    $data['password'] = $DATA_OBJ['password'];
    $data['date'] = date('Y-m-d H:i:s');
    // signup
    $query = 'insert into users (userid, username, email, gender, password) values(:userid, :username, :email, :gender, :password);';
    $DB->write($query, $data);
}
