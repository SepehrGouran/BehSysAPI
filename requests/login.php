<?php
/**
 * Created by PhpStorm.
 * User: Sepehr
 * Date: 6/14/2018
 * Time: 10:01 AM
 */

require_once("../results/LoginResult.php");

session_start();
include '../database/database.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = login($username, $password);

    if ($login == "error") {
        echo "Error";
    } else if ($login != null) {
        $row = $login->fetch_row();
        if ($row != null) {
            $login_result = new LoginResult();
            $login_result->status = "accept";
            $login_result->userId = $row[0];
            $login_result->username = $row[1];
            $login_result->fLast = $row[6];
            $login_result->fName = $row[5];
            $login_result->userPic = $row[4];
            echo $login_result->toJSON();
        } else {
            $login_result = new LoginResult();
            $login_result->status = "denied";
            echo $login_result->toJSON();
        }
    }
}
