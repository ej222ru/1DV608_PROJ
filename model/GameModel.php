<?php

/**
 * Description of GameModel
 *
 * @author Erland Jönsson
 */
namespace model;

require_once("UserClient.php");

class GameModel {
    //put your code here
    private static $sessionUserLocation = "LoginModel::loggedInUser";
        
    public function __construct() {
            self::$sessionUserLocation .= \Settings::APP_SESSION_NAME;

            if (!isset($_SESSION)) {
                    //Alternate check with newer PHP
                    //if (\session_status() == PHP_SESSION_NONE) {
                    assert("No session started");
            }
    }    
}
