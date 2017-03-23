<?php

const DB_HOST = 'localhost';
const DB_NAME = 'Twitter';
const DB_USER = 'root';
const DB_PASS = 'coderslab'; 

$conn = new PDO(
                    'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8;',
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );