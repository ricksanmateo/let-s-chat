<?php

$info = (object) [];
// validate info

$data['email'] = $DATA_OBJ->email;
if (empty($DATA_OBJ->email)) {
    $Error = 'Please enter valid email';
}

if (empty($DATA_OBJ->password)) {
    $Error = 'Please enter valid password';
}

// login
if ($Error == '') {
    $query = 'SELECT * FROM users WHERE email = :email limit 1;';
    $result = $DB->read($query, $data);

    if (is_array($result)) {
        $result = $result[0];
        if ($result->password == $DATA_OBJ->password) {
            $_SESSION['userid'] = $result->userid;
            $info->message = 'You are logged in';
            $info->data_type = 'info';
            echo json_encode($info);
        } else {
            $info->message = 'Wrong password';
            $info->data_type = 'error';
            echo json_encode($info);
        }
    } else {
        $info->message = 'Wrong email';
        $info->data_type = 'error';
        echo json_encode($info);
    }
} else {
    $info->message = $Error;
    $info->data_type = 'error';
    echo json_encode($info);
}
