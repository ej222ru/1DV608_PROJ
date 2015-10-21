<?php

namespace view;

class LayoutView {
    //put your code here
    
    
    public function renderGame($user, GameView $gameView, $cellNumbers) {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <title>The 15 Puzzle</title>
            </head>
            <body>
                <h1>The 15 Puzzle</h1>
                <?php 
                    echo "<h2>" . $user . "</h2>";
                ?>
                <div class="container" >
                    <?php 
                      echo $gameView->createGameTable();
                ?>
                </div>
                <div>
                    <em>This site uses cookies to improve user experience. By continuing to browse the site you are agreeing to our use of cookies.</em>
                </div>
            </body>
        </html>
        <?php
    }    
}
