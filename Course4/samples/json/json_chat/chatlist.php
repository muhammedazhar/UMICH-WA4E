<?php
    sleep(1);
    header("Content-Type: application/json; charset=utf-8");
    session_start();
    if (isset($_SESSION['chats'])) {
        $chatlist = $_SESSION['chats'];
    } else {
        $chatlist = array();
    }
    echo (json_encode($chatlist));