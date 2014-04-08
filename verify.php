<?php

/* 
    Created on : 01-Abr-2014, 11:15:50
    Author     : Mitosu
    Name: Miguel Angel Torres 
 */

include ('config.php');
require_once ('recaptchalib.php');

$privatekey = _REC_PRIVATE_KEY;
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if(!$resp->is_valid){
    echo 0;
}else{
    echo 1;
}
