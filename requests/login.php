<?php
/**
 * Created by PhpStorm.
 * User: Sepehr
 * Date: 6/14/2018
 * Time: 10:01 AM
 */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

require_once("../results/LoginResult.php");

session_start();
include '../database/database.php';
include '../auth/auth.php';

$token = getBearerToken();
$auth = auth($token);
if ($auth->num_rows == 1) {

    // Authenticated routs


}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['login'])) {

    $username = $data['username'];
    $password = $data['password'];

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
            $login_result->token = $row[8];
            echo $login_result->toJSON();
        } else {
            $login_result = new LoginResult();
            $login_result->status = "denied";
            echo $login_result->toJSON();
        }
    }
}
