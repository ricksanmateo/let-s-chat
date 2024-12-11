<?php

$info = (object) [];
$data['userid'] = $DB->generate_id(10);
$data['date'] = date('Y-m-d H:i:s');
// validate username
$data['username'] = $DATA_OBJ->username;
if (empty($DATA_OBJ->username)) {
    $Error .= 'username is required . <br>';
} else {
    if (strlen($DATA_OBJ->username) < 3) {
        $Error .= 'username must be at least 3 characters . <br>';
    }

    if (!preg_match('/^[a-z A-Z 0-9]*$/', $DATA_OBJ->username)) {
        $Error .= 'Please enter a valid username . <br>';
    }
}

$data['email'] = $DATA_OBJ->email;
if (empty($DATA_OBJ->email)) {
    $Error .= 'Please enter valid email . <br>';
} else {
    if (!preg_match('/([\w\-]+\@[\w\-]+\.[\w\-]+)/', $DATA_OBJ->email)) {
        $Error .= 'Please enter a valid email . <br>';
    }
}
$data['password'] = $DATA_OBJ->password;
$password = $DATA_OBJ->password2;
if (empty($DATA_OBJ->password)) {
    $Error .= 'password is required . <br>';
} else {
    if ($DATA_OBJ->password != $DATA_OBJ->password2) {
        $Error .= 'passwords do not match . <br>';
    }
    if (strlen($DATA_OBJ->password) < 8) {
        $Error .= 'password must be at least 8 characters . <br>';
    }
}

// signup
if ($Error == '') {
    $query = 'insert into users (userid, username, email, password, date) values(:userid, :username, :email, :password, :date);';
    $result = $DB->write($query, $data);

    if ($result) {
        $info->message = 'youre profile was created';
        $info->data_type = 'info';
        echo json_encode($info);
    } else {
        $info->message = 'something went wrong';
        $info->data_type = 'error';
        echo json_encode($info);
    }
} else {
    $info->message = $Error;
    $info->data_type = 'error';
    echo json_encode($info);
}
