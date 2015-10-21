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
//    private $cells;
    
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
        $cells =  $_SESSION['GameView::cellNumbers'];
        for ($ind=1;$ind<100;$ind++)
        {
            $cell1 = mt_rand(0,14);
            $cell2 = mt_rand(0,14);

            $temp = $cells[$cell1];
            $cells[$cell1] = $cells[$cell2];
            $cells[$cell2] = $temp;
        }  
        return $cells;
    }
    public function moveCell($cellToMove){
        // is cellToMove neigbour to blanc
        // same row
        $cells =  $_SESSION['GameView::cellNumbers'];
        $empty = 0;
        for ($i=0;$i<16;$i++){
            if ($_SESSION['GameView::cellNumbers'][$i] == 0){
                
                $empty = $i;
            }
        }   
        
        $sameRow = false;
        $sameColumn = false;
        $neighbour = false;
        if (floor($cellToMove / 4) == floor($empty / 4)){
            $sameRow = true;
            if (($cellToMove + 1 == $empty) || ($empty + 1 == $cellToMove)){
                $neighbour = true;
            }
        }
        
        // check if directly above or below
        if ((($cellToMove + 4) == $empty) || (($empty + 4) == $cellToMove)){
                $neighbour = true;
        }
        
        if ($neighbour){
            // switch place

            $temp = $cells[$cellToMove];
            $_SESSION['GameView::cellNumbers'][$cellToMove] = 0;
            $_SESSION['GameView::cellNumbers'][$empty] = $temp;

        }
        
        return $neighbour;
        
    }
  
    public function initCellNumbers(){
        $cells = array();
        for ($i=0;$i<15;$i++){
            $cells[$i] = $i+1;
        }
        $cells[15] = 0;
        return $cells;
    }
    

    
    public function getCellNumbers(){
        return $_SESSION['GameView::cellNumbers'];
    }
}
