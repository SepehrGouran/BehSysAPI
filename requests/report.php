<?php
/**
 * Created by PhpStorm.
 * User: Sepehr
 * Date: 6/14/2018
 * Time: 11:17 AM
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

include '../database/database.php';
require_once("../results/LogResult.php");

include '../auth/auth.php';
$token = getBearerToken();
$auth = auth($token);
if ($auth->num_rows == 1) {

    // Authenticated routs

    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['userLog'])) {

        $userId = $data['userId'];
        $startDate = $data['startDate'];
        $endDate = $data['endDate'];

        $logResult = getLogsInRangeForUser($startDate, $endDate, $userId);
        if ($logResult == "error") {
            echo "Error";
        } else if ($logResult != null) {

            $logReport = array();
            while ($row = $logResult->fetch_assoc()) {
                if ($row != null) {
                    $log_res = new LogResult();
                    $log_res->logId = $row['logId'];
                    $log_res->logTitle = $row['logTitle'];
                    $log_res->logDes = $row['logDes'];
                    $log_res->logTime = $row['logTime'];
                    $log_res->logOwner = $row['logOwner'];
                    $log_res->logCost = $row['logCost'];
                    $log_res->userOwner = $row['userOwner'];
                    $log_res->logDel = $row['logDel'];
                    array_push($logReport, $log_res);
                }
            }
            echo json_encode($logReport);
        }
    }

}

if (isset($_POST['startDate']) && isset($_POST['endDate'])){

    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $logResult = getLogsInRange($startDate, $endDate);
    if ($logResult == "error") {
        echo "Error";
    } else if ($logResult != null) {

        $logReport = array();
        while ($row = $logResult->fetch_assoc()) {
            if ($row != null) {
                $log_res = new LogResult();
                $log_res->logId = $row['logId'];
                $log_res->logTitle = $row['logTitle'];
                $log_res->logDes = $row['logDes'];
                $log_res->logTime = $row['logTime'];
                $log_res->logOwner = $row['logOwner'];
                $log_res->logCost = $row['logCost'];
                $log_res->userOwner = $row['userOwner'];
                $log_res->logDel = $row['logDel'];
                array_push($logReport, $log_res);
            }
        }
        echo json_encode($logReport);
    }

}
