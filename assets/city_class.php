<?php 

class City
{
    
    protected $_cityId;
    
    public function __construct($cityId)
    {
        $this -> _cityId = $cityId;
    }

}

class merchantsExist extends City
{
    private $_cityWeapons;
    private $_cityArmors;
    
    public function fetchCity()
    {
        include('./assets/connect.php');
        $id = $this -> _cityId;
        $queryCity = $pdo -> query("SELECT * FROM game_city WHERE id = '$id'");
        $fetchCity = $queryCity -> fetch(PDO::FETCH_OBJ);
        //
        $this -> _cityWeapons = $fetchCity -> city_weapons;
        $this -> _cityArmors = $fetchCity -> city_armors;
    }
    
    public function checkWeapons()
    {
        self::fetchCity();
        if(($this -> _cityWeapons) == 1)
        {
            return $this -> existWeapons = true; 
        }else
        {
            return $this -> existWeapons = false;
        }
    }
    
    public function checkArmors()
    {
        self::fetchCity();
        if(($this -> _cityArmors) == 1)
        {
            return $this -> existArmors = true; 
        }else
        {
            return $this -> existArmors = false;
        }
    }
    
}

class Merchants
{
    public function showItemList($id)
    {
        include('assets/connect.php');
        $queryMerchant = $pdo -> query("SELECT shop_item_id,shop_price FROM game_shops WHERE shop_id = '$id' ");

        while($fetchMerchant = $queryMerchant -> fetch(PDO::FETCH_OBJ))
        {
            //
            $item_id = $fetchMerchant -> shop_item_id;
            $queryItems = $pdo -> query("SELECT item_name FROM game_items WHERE id = '$item_id'");
            //
            while($fetchItems = $queryItems -> fetch(PDO::FETCH_OBJ))
            {
                echo '<br>'.$fetchItems -> item_name.' for:'.$fetchMerchant -> shop_price.' gold <form action="weaponBuy.php" method="POST" style="position:relative;"><input type="submit" 
                name="id" value="'.$item_id.'" style="color:transparent;background-color:lightgreen"/></form>'; 
            }
        }
    }

    public function weaponMerchant()
    {
        echo 'Hello adventure!!
        What brings you to me ?!
        <br>Let me show you my goods
        ';
    }
}

class MerchantsBuy
{
    protected $_itemId;
    protected $_playerId;

    public function __construct($itemId,$playerId)
    {
        $this -> _itemId = $itemId;
        $this -> _playerId = $playerId;
    }

    public function changeGold($itemPrice)
    {
        include("./assets/connect.php");
        $playerId = $this -> _playerId;
        $updateGold = $pdo -> exec("UPDATE users_accounts SET user_gold = user_gold - '$itemPrice' WHERE id = '$playerId'");
    }

     public function addItem()
    {
    $playerId = $this -> _playerId;
        include("./assets/connect.php");
        $highestBackpackIdQuery = $pdo -> query("SELECT users_backpack_id FROM users_backpacks WHERE users_id = '$playerId' ORDER BY users_backpack_id DESC 
            ");
            $highestBackpackId = $highestBackpackIdQuery -> fetch(PDO::FETCH_OBJ);
            $highestBackpackId -> users_backpack_id = $highestBackpackId -> users_backpack_id + 1;
        //
            $addItem = $pdo -> prepare("INSERT INTO users_backpacks (`users_id`,`users_backpack_id`,`users_item_id`) VALUES (
            :users_id,:users_backpack_id,:users_item_id)");
            $addItem -> bindValue(':users_id', $playerId, PDO::PARAM_INT);
            $addItem -> bindValue(':users_backpack_id', ($highestBackpackId -> users_backpack_id), PDO::PARAM_INT);
            $addItem -> bindValue(':users_item_id', ($this -> _itemId), PDO::PARAM_INT);
        //
        $queryExec = $addItem -> execute();
    }
}

class WeaponMerchant extends MerchantsBuy
{
    public function searchWeaponId()
    {
        include("./assets/connect.php");
        $itemId = $this -> _itemId;
        $queryPrice = $pdo -> query("SELECT shop_price FROM game_shops WHERE shop_item_id = '$itemId' AND shop_id = 1");
        $fetchPrice = $queryPrice -> fetch(PDO::FETCH_OBJ);

        $this -> shop_price = $fetchPrice -> shop_price;
    }

    public function moneyCheck()
    {
        require_once("./assets/variables.php");
        $user = new Variables();
        $user -> userVariables($this -> _playerId);
        //
            self::searchWeaponId();
        //
        if(($user -> user_gold) >= ($this -> shop_price))
        {
            return $this -> moneyBalance = true;
            $this -> user_gold = $user -> user_gold;
            $this -> shop_price; 
        }else
        {

            return $this -> moneyBalance = false;
        }
    }

    public function weaponBuy()
    {
        require_once("./assets/variables.php");
        self::moneyCheck();
        if(($this -> moneyBalance) == true)
        {
            self::changeGold($this -> shop_price);
            self::addItem();
            header("Location: /weaponMerchant.php");
            //  

        }else
        {
            header("Location: /weaponMerchant.php");
        }

    }
}
?>