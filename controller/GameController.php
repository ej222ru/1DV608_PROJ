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

    public function __construct( ) {
        $this->gameModel = new \model\GameModel();
        $this->gameView =  new \view\GameView($this->gameModel);
    }    
    
    public function startGameApplikation($layoutView) {
        $user = $this->gameView->getUserClient();
        $cellToMove = $this->gameView->getRequestMoveCell();
        if (($this->gameView->getRequestStartAGame()) && 
            ($this->gameView->getRequestUserName() != ''))
        {
            $this->gameView->setSessionMessage("A game is started, good luck!");
            $cellNumbers = $this->gameModel->initCellNumbers();
            $this->gameView->setCellNumbers($cellNumbers );
            $cellNumbers = $this->gameModel->renderGameSetup();
            $this->gameView->setCellNumbers($cellNumbers );
        }
        else if ($cellToMove != 999)
        {
            if (!$this->gameModel->moveCell($cellToMove)) {
                $this->gameView->setSessionMessage("You can only move a number directly neighbouring the empty cell");
            }
            else {
                $this->gameView->setSessionMessage("Click one of the numbers directly neighbouring the empty cell");
            }
            
        }
        else {
            $this->gameView->setSessionMessage("Enter your name and start a Game!");
            $cellNumbers = $this->gameModel->initCellNumbers();
            $this->gameView->setCellNumbers($cellNumbers );
            
        }
                 
        $layoutView->renderGame($user, $this->gameView, $this->gameModel->getCellNumbers());
    }    
}
