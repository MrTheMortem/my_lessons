<?php

spl_autoload_register(function($name) {
    $fileName = $_SERVER['DOCUMENT_ROOT'] . '/class/' . $name . '.php';
    if(is_file($fileName)) {
        include $fileName;
    } else {
        throw new \Exception("Can't load class <b>{$name}</b> from file <b>{$fileName}</b>");
    }
});