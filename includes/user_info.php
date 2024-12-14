<?php

$info = (object) [];
// validate info

$data['userid'] = $_SESSION['userid'];

// login
if ($Error == '') {
    $query = 'SELECT * FROM users WHERE userid = :userid limit 1;';
    $result = $DB->read($query, $data);

    if (is_array($result)) {
        $result = $result[0];
        $result->data_type = 'user_info';
        echo json_encode($result);
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
