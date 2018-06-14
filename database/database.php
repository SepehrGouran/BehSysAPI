<?php
/**
 * Created by PhpStorm.
 * User: Sepehr
 * Date: 6/14/2018
 * Time: 10:04 AM
 */

$servername = "localhost:3308";
$user = "root";
$pass = "";
$dbname = "behsysne_api";

function login ($username, $password) {
    $connection = new mysqli($GLOBALS['servername'], $GLOBALS['user'],
        $GLOBALS['pass'], $GLOBALS['dbname']);
    mysqli_set_charset($connection,"utf8");

    if ($connection->connect_error) {
        die("Connection failed ".$connection->connect_error);
    } else {

        $loginQuery = 'select * from users WHERE userName = ? and userPass = ?';
        $prepared_statement = $connection->prepare($loginQuery);
        $prepared_statement->bind_param("ss", $username, $password);

        $prepared_statement->execute();
        $result = $prepared_statement->get_result();

        if ($prepared_statement->error != null) {
            $prepared_statement->close();
            $connection->close();
            return "error";
        }

        $prepared_statement->close();
        $connection->close();
        return $result;
    }
}