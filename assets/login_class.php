<?php
class login
{
    protected $_login;
    protected $_password;
    protected $_id;
    public function __construct($login,$password)
    {
        $this -> _login = stripslashes($login);
        $this -> _password = md5(stripslashes($password));
    }
    
    public function login()
    {
        include('./assets/connect.php');
        //
        $login = $this -> _login;
        $password = $this -> _password;
        $login_query = $pdo -> query("SELECT id FROM users_accounts WHERE user_login = '$login' AND user_password = '$password'");
        $login_r = $login_query -> fetch(PDO::FETCH_OBJ);
        $this -> _id = $login_r -> id;
    }

    public function updateLastLogin()
    {
        include('./assets/connect.php');
        $this -> time = date("Y-m-d H:i:s");
        $update = $pdo -> prepare("UPDATE users_accounts SET user_lastlogin = :time WHERE id = :id");
        $update -> bindValue(':time',$this -> time,PDO::PARAM_INT);
        $update -> bindValue(':id',$this -> _id,PDO::PARAM_INT);
        $update -> execute();
    }
}

class login_check extends login
{   
    private $_check_correct_login;
    private $_check_correct_password;
    protected $_check_corret_final;
    
    public function check_login()
    {
        if(!empty($this -> _login))
        {
            return $this -> _check_correct_login = 1; 
        }else
        {
            return $this -> _check_correct_login = 0; 
        }
    }
    
    public function check_password()
    {
        if(!empty($this -> _password))
        {
            return $this -> _check_correct_password = 1; 
        }else
        {
            return $this -> _check_correct_password = 0; 
        }
    }
    
    public function check_all()
    {
        //Use previous methods :) 
        self::check_login();
        self::check_password();
        //
        if(($this -> _check_correct_login) == 1 && ($this -> _check_correct_password) == 1)
        {
        return $this -> _check_correct_all = 1;
        }else
        {
        return $this -> _check_correct_all = 0;
        }
    }
    
    public function return_all()
    {
    //
    self::check_all();
    //
    if(($this -> _check_correct_all) == 0)
        {
            header("Location: /");
            exit();
        }   
    }
    
    public function GoIntogameSite()
    {
        if(!empty($this -> _id))
        {
         self::updateLastLogin();
         session_start();
         $_SESSION['id'] = $this -> _id;
         header("Location: /welcome.php");
        }else
        {
            header("Location: /");
            exit();
        }
        
    }
}
?>