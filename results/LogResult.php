<?php

/**
 * Created by PhpStorm.
 * User: Sepehr
 * Date: 6/22/2018
 * Time: 10:34 AM
 */
class LogResult
{
    public $logId;
    public $logTitle;
    public $logDes;
    public $logTime;
    public $logOwner;
    public $logCost;
    public $userOwner;
    public $logDel;

    function toJSON() {
        return json_encode($this);
    }
}