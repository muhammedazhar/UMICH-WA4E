<?php

    header("Content-Type: application/json; charset=utf-8");

    $stuff = array(
        "first" => "first object returned from php",
        "second" => "second object returned from php",
    );

    echo (json_encode($stuff));