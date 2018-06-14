<?php

/**
 * Created by PhpStorm.
 * User: Sepehr
 * Date: 6/14/2018
 * Time: 10:10 AM
 */
class LoginResult
{
    public $userId;
    public $username;
    public $userPic;
    public $fName;
    public $fLast;


    function toJSON() {
        return json_encode($this);
    }

}