<?php
session_start();


if (isset($_GET['callback'])) {
    $callback = $_GET['callback'];

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
        // 登录状态
        $data = array(
            'login' => true,
        );
    } else {
        // 未登录状态
        $data = array(
            'login' => false,
        );
    }

    echo $callback . '(' . json_encode($data) . ')';
}
