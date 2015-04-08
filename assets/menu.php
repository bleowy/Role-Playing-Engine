<?php
class menu{

    public function showRightMenu($id)
    {
        include_once('/assets/variables.php');
        $user_variables = new Variables();
        $user_variables -> userVariables($id);
        
        echo '<h1>'.$user_variables -> user_login.'</h1>'; 
        echo '<p1>'.$user_variables -> user_gender.'</p1>';
        echo '<br><p1>Strength:'.$user_variables -> user_str.'</p1>';
        echo '<br><p1>Intelligence:'.$user_variables -> user_know.'</p1>';
        echo '<br><p1>Dexterity:'.$user_variables -> user_dex.'</p1>';
        echo '<br><p1>Charisma:'.$user_variables -> user_charisma.'</p1>';
        
    }
}
?>