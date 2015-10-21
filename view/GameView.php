<?php
/**
 * Description of GameView
 *
 * @author User
 */

namespace view;

class GameView {
    //put your code here
    private static $game = "GameView::Game";
    private static $name = "GameView::UserName";
    private static $messageId = "GameView::Message";
    private static $button = "GameView::Button";
    private static $sessionSaveLocation = "\\view\\GameView\\message";
        
    public function getUserClient() {
 //           return new \model\UserClient($_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_USER_AGENT"]);
    }   
    
    public function createGameTable() {
            //cookies
            $this->unsetCookies();
            
            $message = $this->getSessionMessage();
            $buttonText = 'Start a 15Game';
            //generate HTML
            if ($this->getRequestStartAGame())
            {
               $buttonText = 'Restart a 15Game'; 
            }
            return $this->generateGameTableHTML($message, $buttonText);
    }

    
    private function redirect($message) {
            $_SESSION[self::$sessionSaveLocation] = $message;
            header("Location: /index.php");
    }    

    
    private function generateGameTableHTML($message, $buttonText) {
            self::$button = $buttonText;
            return "<form method='post' > 
                            <fieldset>
                                    <legend>15Game - the ultimate challenge</legend>
                                    <p id='".self::$messageId."'>$message</p>
                                    <label for='".self::$name."'>Username :</label>
                                    <input type='text' id='".self::$name."' name='".self::$name."' value='".$this->getRequestUserName()."'/>
                                        
                                    <input type='submit' name='".self::$game."' value='".self::$button."'/>
                            </fieldset>
                            
        <table  border='5' width='400' cellpadding='40'>
            <tr><!First row>
                <td><div id = 'cell_00'/></td>
                <td><div id = 'cell_01'/></td>
                <td><div id = 'cell_02'/></td>
                <td><div id = 'cell_03'/></td>
            </tr>
            <tr><!Second row>
                <td><div id = 'cell_10'/></td>
                <td><div id = 'cell_11'/></td>
                <td><div id = 'cell_12'/></td>
                <td><div id = 'cell_13'/></td>
            </tr>
            <tr><!Third row>
                <td><div id = 'cell_20'/></td>
                <td><div id = 'cell_21'/></td>
                <td><div id = 'cell_22'/></td>
                <td><div id = 'cell_23'/></td>
            </tr>
            <tr><!Fourth row>
                <td><div id = 'cell_30'/></td>
                <td><div id = 'cell_31'/></td>
                <td><div id = 'cell_32'/></td>
                <td><div id = 'cell_33'/></td>
            </tr>
        </table>
   

                    </form>
            ";
    }    
    
    
	public function getRequestUserName() {
		if (isset($_POST[self::$name]))
			return trim($_POST[self::$name]);
		return "";
	} 
	public function getRequestStartAGame() {
		if (isset($_POST[self::$game]))
                {
                    return ((strcmp(trim($_POST[self::$game]), "Start a 15Game") == 0) ||
                            (strcmp(trim($_POST[self::$game]), "Restart a 15Game") == 0));
                }
		return false;
	} 

        public function setSessionMessage($message) {
                $_SESSION[self::$sessionSaveLocation] = $message;
        }     
        
	private function getSessionMessage() {
		if (isset($_SESSION[self::$sessionSaveLocation])) {
			$message = $_SESSION[self::$sessionSaveLocation];
			unset($_SESSION[self::$sessionSaveLocation]);
			return $message;
		}
		return "";
	}
        
	private function unsetCookies() {
//		setcookie(self::$cookieName, "", time()-1);
//		unset($_COOKIE[self::$cookieName]);
	}        
        
        
}
