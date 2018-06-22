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

function login($username, $password)
{
    $connection = new mysqli($GLOBALS['servername'], $GLOBALS['user'],
        $GLOBALS['pass'], $GLOBALS['dbname']);
    mysqli_set_charset($connection, "utf8");

    if ($connection->connect_error) {
        die("Connection failed " . $connection->connect_error);
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

function auth($token)
{
    $connection = new mysqli($GLOBALS['servername'], $GLOBALS['user'],
        $GLOBALS['pass'], $GLOBALS['dbname']);
    mysqli_set_charset($connection, "utf8");

    if ($connection->connect_error) {
        die("Connection failed " . $connection->connect_error);
    } else {

        $authQuery = 'select userId from users WHERE auth_token = ?';
        $prepared_statement = $connection->prepare($authQuery);
        $prepared_statement->bind_param("s", $token);

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

function getLogsInRange($startDate, $endDate)
{

    $connection = new mysqli($GLOBALS['servername'], $GLOBALS['user'],
        $GLOBALS['pass'], $GLOBALS['dbname']);
    mysqli_set_charset($connection, "utf8");

    if ($connection->connect_error) {
        die("Connection failed " . $connection->connect_error);
    } else {

        $logQuery = 'select * from logs WHERE logTime > ? and logTime < ?';
        $prepared_statement = $connection->prepare($logQuery);
        $prepared_statement->bind_param("ss", $startDate, $endDate);

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

function getLogsInRangeForUser($startDate, $endDate, $userId)
{

    $connection = new mysqli($GLOBALS['servername'], $GLOBALS['user'],
        $GLOBALS['pass'], $GLOBALS['dbname']);
    mysqli_set_charset($connection, "utf8");

    if ($connection->connect_error) {
        die("Connection failed " . $connection->connect_error);
    } else {

        $logQuery = 'select * from logs where logTime > ? and logTime < ? and userOwner = ?';
        $prepared_statement = $connection->prepare($logQuery);
        $prepared_statement->bind_param("sss", $startDate, $endDate, $userId);

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