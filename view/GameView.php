<?php
/**
 * Description of GameView
 *
 * @author Erland Jönsson
 */

namespace view;

class GameView {
    //put your code here
    private static $game = "GameView::Game";
    private static $name = "GameView::UserName";
    private static $messageId = "GameView::Message";
    private static $button = "GameView::Button";
    private static $sessionSaveLocation = "\\view\\GameView\\message";
    
    private $cells = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 0);
    
             
    public function getUserClient() {
 //           return new \model\UserClient($_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_USER_AGENT"]);
    }   
    
    public function createGameTable() {
            //cookies
            $this->unsetCookies();
            
            $message = $this->getSessionMessage();
          //  $cellPics[] = $this->getCellNumbers();
            
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

    public function setCellNumbers($cellNumbers )
    {
        $this->cells = $cellNumbers;
    }
    
    private function generateGameTableHTML($message, $buttonText) {
            self::$button = $buttonText;
            $arr[0] = '1';
            $arr[1] = '2';
            $arr[2] = '3';
            $arr[3] = '4';
            $arr[4] = '5';
            $arr[5] = '6';
            $arr[6] = '7';
            $arr[7] = '8';
            $arr[8] = '9';
            $arr[9] = '10';
            $arr[10] = '11';
            $arr[11] = '12';
            $arr[12] = '13';
            $arr[13] = '14';
            $arr[14] = '15';
            $arr[15] = '0';
            
            foreach ($this->cells as $value) {
                $cellPics[] = 'pics/' . $value . '.jpg';
            }
            return "<form method='post' > 
                            <fieldset>
                                    <legend>15Game - the ultimate challenge</legend>
                                    <p id='".self::$messageId."'>$message</p>
                                    <label for='".self::$name."'>Username :</label>
                                    <input type='text' id='".self::$name."' name='".self::$name."' value='".$this->getRequestUserName()."'/>
                                        
                                    <input type='submit' name='".self::$game."' value='".self::$button."'/>
                            </fieldset>
                            <table  border='4' bgcolor='#00D000' width='200' cellpadding='1'>
                                <tr><!First row>
                                    <td><div id = 'cell_00'/><img src=$cellPics[0] alt='1' style='width:80px;height:80px;'></td>
                                    <td><div id = 'cell_01'/><img src=$cellPics[1] alt='1' style='width:80px;height:80px;'></td>
                                    <td><div id = 'cell_02'/><img src=$cellPics[2] alt='1' style='width:80px;height:80px;'></td>
                                    <td><div id = 'cell_03'/><img src=$cellPics[3] alt='1' style='width:80px;height:80px;'></td>
                                </tr>
                                <tr><!Second row>
                                    <td><div id = 'cell_10'/><img src=$cellPics[4] alt='1' style='width:80px;height:80px;'></td>
                                    <td><div id = 'cell_11'/><img src=$cellPics[5] alt='1' style='width:80px;height:80px;'></td>
                                    <td><div id = 'cell_12'/><img src=$cellPics[6] alt='1' style='width:80px;height:80px;'></td>
                                    <td><div id = 'cell_13'/><img src=$cellPics[7] alt='1' style='width:80px;height:80px;'></td>
                                </tr>
                                <tr><!Third row>
                                    <td><div id = 'cell_20'/><img src=$cellPics[8] alt='1' style='width:80px;height:80px;'></td>
                                    <td><div id = 'cell_21'/><img src=$cellPics[9] alt='1' style='width:80px;height:80px;'></td>
                                    <td><div id = 'cell_22'/><img src=$cellPics[10] alt='1' style='width:80px;height:80px;'></td>
                                    <td><div id = 'cell_23'/><img src=$cellPics[11] alt='1' style='width:80px;height:80px;'></td>
                                </tr>
                                <tr><!Fourth row>
                                    <td><div id = 'cell_30'/><img src=$cellPics[12] alt='1' style='width:80px;height:80px;'></td>
                                    <td><div id = 'cell_31'/><img src=$cellPics[13] alt='1' style='width:80px;height:80px;'></td>
                                    <td><div id = 'cell_32'/><img src=$cellPics[14] alt='1' style='width:80px;height:80px;'></td>
                                    <td><div id = 'cell_33'/><img src=$cellPics[15] alt='1' style='width:80px;height:80px;'></td>
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
