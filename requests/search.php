<?php
/**
 * Created by PhpStorm.
 * User: Sepehr
 * Date: 6/14/2018
 * Time: 11:18 AM
 */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

if (isset($_POST['login'])) {

    echo json_encode($_POST['login']);
} else {
	echo json_encode("no body");
}

?>