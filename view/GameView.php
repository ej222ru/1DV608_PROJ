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
    private static $cell = "GameView::cell";
    private static $name = "GameView::UserName";
    private static $messageId = "GameView::Message";
    private static $button = "GameView::Button";
    private static $moves = "GameView::moves";
    private static $sessionSaveLocation = "\\view\\GameView\\message";
    private static $cellNumbers = "GameView::cellNumbers";
    
             
    public function getUserClient() {
 //           return new \model\UserClient($_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_USER_AGENT"]);
    }   
    
    public function createGameTable() {
            //cookies
            $this->unsetCookies();
            
            $message = $this->getSessionMessage();
          //  $cellPics[] = $this->getCellNumbers();
            
            $buttonText = 'Start a 15 Puzzle';
            //generate HTML
            if ($this->getRequestStartAGame() || $this->getRequestMoveCell())
            {
               $buttonText = 'Restart a 15 Puzzle'; 
            }
            return $this->generateGameTableHTML($message, $buttonText);
    }

    
    private function redirect($message) {
            $_SESSION[self::$sessionSaveLocation] = $message;
            header("Location: /index.php");
    }    

    public function setCellNumbers($cellNumbers )
    {
        $_SESSION[self::$cellNumbers] = $cellNumbers;
    }
    public function resetMoves()
    {
        $_SESSION[self::$moves] = 0;
    }
    public function setUser($user)
    {
        $_SESSION[self::$name] = $user;
    }    
    public function resetUser()
    {
        $_SESSION[self::$name] = "";
    }    
    private function generateGameTableHTML($message, $buttonText) {
            self::$button = $buttonText;
            $cells = $_SESSION[self::$cellNumbers];
            $moves = $_SESSION[self::$moves];
            $name = "";
            if (isset($_SESSION[self::$name])){
                $name = $_SESSION[self::$name];
            }
            
            
            for ($i=0;$i<16;$i++){
                $cellPics[] = 'http://ej.3space.info/WS3/pics/' . $cells[$i] . '.JPG';
            }
            return "<form method='post' > 
                            <fieldset>
                                    <legend>15 Puzzle - the ultimate challenge</legend>
                                    <div style='color:#FF99FF;font-weight:bold;' id='".self::$messageId."'>$message</div>
                                    <label for='".self::$name."'>Username :</label>
                                    <input type='text' id='".self::$name."' name='".self::$name."' value='".$name."'/>
                                        
                                    <input type='submit' name='".self::$game."' value='".self::$button."'/>
                                    <p id='".self::$moves."'>Moves: $moves</p>
                            </fieldset>
                            <table  border='4' bgcolor='#00D000' width='200' cellpadding='1'>
                                <tr><!First row>
                                    <td><div id = 'cell_00'/><input type='image' name='cell0' value='CELL1' src=$cellPics[0] alt='0' style='width:80px;height:80px;' /> </td>
                                    <td><div id = 'cell_01'/><input type='image' name='cell1' value='CELL1' src=$cellPics[1] alt='1' style='width:80px;height:80px;' /> </td>
                                    <td><div id = 'cell_02'/><input type='image' name='cell2' value='CELL1' src=$cellPics[2] alt='2' style='width:80px;height:80px;' /> </td>
                                    <td><div id = 'cell_03'/><input type='image' name='cell3' value='CELL1' src=$cellPics[3] alt='3' style='width:80px;height:80px;' /> </td>
                                </tr>
                                <tr><!Second row>
                                    <td><div id = 'cell_10'/><input type='image' name='cell4' value='CELL1' src=$cellPics[4] alt='4' style='width:80px;height:80px;' /> </td>
                                    <td><div id = 'cell_11'/><input type='image' name='cell5' value='CELL1' src=$cellPics[5] alt='5' style='width:80px;height:80px;' /> </td>
                                    <td><div id = 'cell_12'/><input type='image' name='cell6' value='CELL1' src=$cellPics[6] alt='6' style='width:80px;height:80px;' /> </td>
                                    <td><div id = 'cell_13'/><input type='image' name='cell7' value='CELL1' src=$cellPics[7] alt='7' style='width:80px;height:80px;' /> </td>
                                </tr>
                                <tr><!Third row>
                                    <td><div id = 'cell_20'/><input type='image' name='cell8' value='CELL1' src=$cellPics[8] alt='8' style='width:80px;height:80px;' /> </td>
                                    <td><div id = 'cell_21'/><input type='image' name='cell9' value='CELL1' src=$cellPics[9] alt='9' style='width:80px;height:80px;' /> </td>
                                    <td><div id = 'cell_22'/><input type='image' name='cell10' value='CELL1' src=$cellPics[10] alt='10' style='width:80px;height:80px;' /> </td>
                                    <td><div id = 'cell_23'/><input type='image' name='cell11' value='CELL1' src=$cellPics[11] alt='11' style='width:80px;height:80px;' /> </td>
                                </tr>
                                <tr><!Fourth row>
                                    <td><div id = 'cell_30'/><input type='image' name='cell12' value='CELL1' src=$cellPics[12] alt='12' style='width:80px;height:80px;' /> </td>
                                    <td><div id = 'cell_31'/><input type='image' name='cell13' value='CELL1' src=$cellPics[13] alt='13' style='width:80px;height:80px;' /> </td>
                                    <td><div id = 'cell_32'/><input type='image' name='cell14' value='CELL1' src=$cellPics[14] alt='14' style='width:80px;height:80px;' /> </td>
                                    <td><div id = 'cell_33'/><input type='image' name='cell15' value='CELL1' src=$cellPics[15] alt='15' style='width:80px;height:80px;' /> </td>
                                </tr>
                            </table>
                    </form>
            ";
    }    
    
    
	public function getRequestUserName() {
		if (isset($_POST[self::$name])){
                    $this->setUser(trim($_POST[self::$name]));
            echo "name" . trim($_POST[self::$name]);
                    return trim($_POST[self::$name]);
                }
		return "";
	} 
	public function getRequestStartAGame() {
            
		if (isset($_POST[self::$game]))
                {
                    return ((strcmp(trim($_POST[self::$game]), "Start a 15 Puzzle") == 0) ||
                            (strcmp(trim($_POST[self::$game]), "Restart a 15 Puzzle") == 0));
                    $_SESSION[self::$name] = trim($_POST[self::$name]);
                    
                }
		return false;
	} 
	public function getResendOngoingGame() {
            if (!isset($_POST[self::$game]) && isset($_SESSION[self::$moves]) && isset($_SESSION[self::$name]) && ($_SESSION[self::$name] != "")) {
                return true;
            }
            return false;
	}         
        
	public function getRequestMoveCell() {
            /*
             * Check if any of the cells have been clicked
             * If so there is a client00_x, client01_x, client02_x ...
             * set in the $_POST global
             */
            for ($index=0;$index<16;$index++)
            {
                $cmpStringStart = "cell" . $index . "_x";
		if (isset($_POST[$cmpStringStart]))
                {
                    return $index; // return index of cell clicked
                }
            }
            return 999; // would have returned 0 but that is an actual cell so 999 indicates no cell clicked
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
