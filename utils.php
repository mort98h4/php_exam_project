<?php

function _respond(string $message='', int $status=200) {
    http_response_code($status);
    header('Content-Type: application/json');
    $res = is_array($message) ? $message : ['info' => $message];
    echo json_encode($res);
    exit();
}

function _redirect(string $url='/') {
    header("Location: $url");
    exit();
}