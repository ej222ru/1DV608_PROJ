<?php

 /**
  * 15 game
  * @author Erland Jönsson
  */

require_once("Settings.php");
require_once("controller/GameController.php");
require_once("view/LayoutView.php");
require_once("model/GameModel.php");

//phpinfo();
if (Settings::DISPLAY_ERRORS) {
	error_reporting(-1);
	ini_set('display_errors', 'ON');
}

//session must be started before LoginModel is created
session_start(); 

//Dependency injection
$gameModel = new \model\GameModel();
$gameView = new \view\GameView($gameModel);
$gameController = new \controller\GameController($gameModel, $gameView);


//Controller must be run first since state is changed
// $gameController->doControl();


//Generate output
$layoutView = new \view\LayoutView();

$gameController->startGameApplikation($layoutView);
