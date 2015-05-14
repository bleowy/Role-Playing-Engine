<?php 

//Check if session exist which means "its there somebody?"
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: /');
    exit();
}
//
require_once('./assets/variables.php');
require_once('./assets/city_class.php');
require_once('./assets/expedition.php');
$variables = new Variables();
$variables -> GeneralVariables();
$userVariables = new Variables();
$userVariables -> userVariables($_SESSION['id']);
$cityVariables = new Variables();
$cityVariables -> cityVariables(($userVariables -> user_city));
$gameExpedition = new showExpeditions(($_SESSION['id']));
$checkExpedition = new endExpeditions(($_SESSION['id']));
$checkExpedition -> checkTime();
//
require_once('./assets/menu.php');
$menu = new menu(($_SESSION['id']),($userVariables -> user_city));
//
?>
<title><?php echo $variables -> _title ?></title>
<link rel="stylesheet" href="style/ingame.css"/>

<html>
    
    <head>
        <div class="head">
            <div id="GameName"><a href="/welcome.php">Test Game Name</a></div>
            <div id="location"></div>
            <div id="location_name"><?php echo $cityVariables -> city_name; ?></div>
        </div>
    </head>
    <body>
        <div class="left_menu">
            <div id="top_side">
                <div id="top_side_href">
                    <?php $menu -> showLeftMenu(); ?>
                </div>
            </div>
        </div>
        <div class="center_side">
            <div id="text">
                <?php
                ?>
            	You looked slightly on your map and those places are the most relevant to explore.
            	<br>
                <?php
                	$gameExpedition -> Show(($checkExpedition -> Busy));
                ?>
            </div>
        </div>
        <div class="right_side">
            <div id="right_top_side">              
                <?php 
                $menu -> showRightMenu();
                ?>
            </div>
        </div>
    </body>
<div id="footer">
        Engine Created by <a href="http://www.github.com/bleowy">Bleowy</a>.Check code at <a href="http://www.github.com/bleowy/Role-Playing-Engine">Github</a>
</div>
</html>
<script type="text/javascript">
function logoPosition()
    {
    var logo_Width = document.getElementById('GameName').offsetWidth;
    var logo = parseInt(logo_Width);
    var b = 0 - logo / 2 ;
    document.getElementById('GameName').style.marginLeft = b;
    }
    logoPosition();
</script>