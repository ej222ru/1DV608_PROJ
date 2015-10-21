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
    private $cells = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 0);
    
    private static $sessionUserLocation = "LoginModel::loggedInUser";
        
    public function __construct() {
            self::$sessionUserLocation .= \Settings::APP_SESSION_NAME;

            if (!isset($_SESSION)) {
                    //Alternate check with newer PHP
                    //if (\session_status() == PHP_SESSION_NONE) {
                    assert("No session started");
            }
            
    }    
    public function renderGameSetup(){
        // change place on two cells values
        
        for ($ind=1;$ind<100;$ind++)
        {
            $cell1 = mt_rand(0,14);
            $cell2 = mt_rand(0,14);

            $temp = $this->cells[$cell1];
            $this->cells[$cell1] = $this->cells[$cell2];
            $this->cells[$cell2] = $temp;
        }  
        return $this->cells;
    }
    public function getCellNumbers(){
        return $this->cells;
    }
}
