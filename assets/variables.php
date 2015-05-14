<?php 
class Variables
{
    
public function GeneralVariables()
{
    $this -> _title = 'Role Plaing Engine';
}
    
public function userVariables($id)
{
    include('./assets/connect.php');
    $user_query = $pdo -> query("SELECT * FROM users_accounts WHERE id = '$id'");
    $user_fetch = $user_query -> fetch(PDO::FETCH_OBJ);
    //
    $user_query_stats = $pdo -> query("SELECT * FROM users_stats WHERE id = '$id'");
    $user_fetch_stats = $user_query_stats-> fetch(PDO::FETCH_OBJ);
    //
    $this -> user_gender = $user_fetch -> user_gender;
    $this -> user_login = $user_fetch -> user_login;
    $this -> user_city = $user_fetch -> user_city;
    $this -> user_class = $user_fetch -> user_class;
    $this -> user_gold = $user_fetch -> user_gold;
    $this -> user_str = $user_fetch_stats -> user_str;
    $this -> user_know = $user_fetch_stats -> user_know;
    $this -> user_charisma = $user_fetch_stats -> user_charisma;
    $this -> user_dex = $user_fetch_stats -> user_dex;
    
}
 
public function cityVariables($city_id)
{
    include('./assets/connect.php');
    $user_query = $pdo -> query("SELECT * FROM game_city WHERE id = '$city_id'");
    $user_fetch = $user_query -> fetch(PDO::FETCH_OBJ);
    
    $this -> city_name = $user_fetch -> city_name;
    $this -> city_weather = $user_fetch -> city_weather;
    $this -> city_text = $user_fetch -> city_text;
}
    
}
?>