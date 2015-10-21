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

  //        echo "BEFORE: cell1:" . $this->cells[$cell1] . "  cell2:" . $this->cells[$cell2];

            $temp = $this->cells[$cell1];
            $this->cells[$cell1] = $this->cells[$cell2];
            $this->cells[$cell2] = $temp;

//          echo "AFTER: cell1:" . $this->cells[$cell1] . "  cell2:" . $this->cells[$cell2];
        }  
/*        
        echo "AFTER: cell0" . $this->cells[0] . PHP_EOL;
        echo "AFTER: cell1:" . $this->cells[1] . PHP_EOL;
        echo "AFTER: cell2:" . $this->cells[2] . PHP_EOL ;
        echo "AFTER: cell3:" . $this->cells[3]  . PHP_EOL;
        echo "AFTER: cell4:" . $this->cells[4]  . PHP_EOL;
        echo "AFTER: cell5:" . $this->cells[5] . PHP_EOL;
        echo "AFTER: cell6:" . $this->cells[6] . PHP_EOL;
        echo "AFTER: cell7:" . $this->cells[7] . PHP_EOL;
        echo "AFTER: cell8:" . $this->cells[8] . PHP_EOL;
        echo "AFTER: cell9:" . $this->cells[9] . PHP_EOL;
        echo "AFTER: cell10:" . $this->cells[10] . PHP_EOL;
        echo "AFTER: cell11:" . $this->cells[11] . PHP_EOL;
        echo "AFTER: cell12:" . $this->cells[12] . PHP_EOL;
        echo "AFTER: cell13:" . $this->cells[13] . PHP_EOL;
        echo "AFTER: cell14:" . $this->cells[14] . PHP_EOL;
        echo "AFTER: cell15:" . $this->cells[15] . PHP_EOL;
*/
        
        return $this->cells;
    }
    public function getCellNumbers(){
        return $this->cells;
    }
}
