<?php

const DB_HOST = '';
const DB_NAME = '';
const DB_USER = '';
const DB_PASS = ''; 

$conn = new PDO(
                    'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8;',
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
