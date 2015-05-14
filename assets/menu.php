<?php
class menu{

    private $_playerId;
    private $_cityId;

    public function __construct($playerId,$cityId)
    {
        $this -> _playerId = $playerId;
        $this -> _cityId = $cityId;
    }
    
    public function nicknameColor()
    {

    }

    public function countMessages()
    {
        include('./assets/connect.php');
            $count = $pdo -> prepare("SELECT count(id) AS count FROM users_messages WHERE messages_readStatus = 0 AND messages_userId = :id");
        //
            $count -> bindValue('id',$this -> _playerId,PDO::PARAM_INT);
        //
            $count -> execute();
        //
            $fetch = $count -> fetch(PDO::FETCH_ASSOC);
        //
            $this -> count = $fetch['count'];
    }

    public function showRightMenu()
    {
        include_once('./assets/variables.php');
        $user_variables = new Variables();
        $user_variables -> userVariables(($this -> _playerId));
        
            echo '<h1>'.$user_variables -> user_login.'</h1>';
        //
            echo '<b><br><p1>'.$user_variables -> user_class.'</p1></b>';
        //
            echo '<br><p1>'.$user_variables -> user_gender.'</p1>';
        //
            echo '<br><p1>Gold:'.$user_variables -> user_gold.'</p1>';
        //
            echo '<br><p1>Strength:'.$user_variables -> user_str.'</p1>';
        //
            echo '<br><p1>Intelligence:'.$user_variables -> user_know.'</p1>';
        //
            echo '<br><p1>Dexterity:'.$user_variables -> user_dex.'</p1>';
        //
            echo '<br><p1>Charisma:'.$user_variables -> user_charisma.'</p1>';
        
    }
    
    public function showLeftMenu()
    {
        include_once('./assets/variables.php');
        //
            $city_variables = new Variables();
        //
            $city_variables -> cityVariables(($this -> _cityId));
        //
            self::countMessages(($this -> _playerId));
        //
            echo '<g><a href="/welcome.php">Annoucement</a></g>';
        //
            echo '<br><g><a href="/city.php">'.$city_variables -> city_name.'</a></g>';
        //
            echo '<br><g><a href="/equipment.php">Equipment</a></g>';
        //
            echo '<br><g><a href="/expedition.php">Expedition</a></g>';
        //
            echo '<br><g><a href="/messages.php">Messages('.$this -> count.')</a></g>';
        //
            echo '<br><g><a href="/logout.php">Logout</a></g>';
    }
}
?>