<?php
/**
 * Description of GameController
 *
 * @author Erland Jönsson
 */

namespace controller;

require_once("model/GameModel.php");
require_once("view/GameView.php");


class GameController {
    //put your code here

    private $gameModel;
    private $gameView;

    public function __construct(\model\GameModel $gameModel, \view\GameView $gameView) {
            $this->gameModel = $gameModel;
            $this->gameView =  $gameView;
    }    
    
    public function startGameApplikation($layoutView) {
        $user = $this->gameView->getUserClient();
        if (($this->gameView->getRequestStartAGame()) && 
            ($this->gameView->getRequestUserName() != '')){
            
            $this->gameView->setSessionMessage("A game is started, good luck!");
            $cellNumbers = $this->gameModel->renderGameSetup();
            $this->gameView->setCellNumbers($cellNumbers );
        }
        else {
            $this->gameView->setSessionMessage("Enter your name and start a Game!");
        }
                 
        $layoutView->renderGame($user, $this->gameView);
    }    
}
