<?php
class Equipment
{

	protected $_playerId;

	public function __construct($playerId)
	{
		$this -> _playerId = $playerId;
	}

	public function itemInfo($itemId)
	{
		include("./assets/connect.php");
		$itemInfo = $pdo -> query("SELECT * FROM game_items WHERE id = '$itemId'");
		$itemInfoFetch = $itemInfo -> fetch(PDO::FETCH_OBJ);
		//
		$this -> item_name = $itemInfoFetch -> item_name;
		$this -> item_str = $itemInfoFetch -> item_str;
		$this -> item_int = $itemInfoFetch -> item_int;
		$this -> item_dex = $itemInfoFetch -> item_dex;
		$this -> item_cha = $itemInfoFetch -> item_cha;
		//
	}
}

class Show extends Equipment
{

	public function showItems()
	{
		include("./assets/connect.php");
		$user = $this -> _playerId;
		$userBackpackQuery = $pdo -> query("SELECT users_item_id FROM users_backpacks WHERE users_id = 1 ORDER BY 
			users_backpack_id");
		$this -> i = 0;
		while($userBackpackFetch = $userBackpackQuery -> fetch(PDO::FETCH_OBJ))
		{
			$this -> i = $this -> i + 1;
			self::itemInfo($userBackpackFetch -> users_item_id);
			echo '<br><a class="tooltip">'.$this -> i.'.'.$this -> item_name.'<span>Strength:'.$this -> item_str.
			'<br>Intelligence:'.$this -> item_int.'<br>Dexterity:'.$this -> item_dex.'<br>Charisma:'.$this -> item_cha.'</span></a>';
		}
	}

	public function fetchEquipment()
	{
		include("./assets/connect.php");
		$user = $this -> _playerId;
		$equipmentQuery = $pdo -> query("SELECT * FROM users_equipment WHERE id = '$user'");
		$equipmentFetch = $equipmentQuery -> fetch(PDO::FETCH_OBJ);
		//
		$this -> user_head = $equipmentFetch -> user_head;
		$this -> user_body = $equipmentFetch -> user_body;
		$this -> user_legs = $equipmentFetch -> user_legs;
		$this -> user_foots = $equipmentFetch -> user_foots;
		$this -> user_lefthand = $equipmentFetch -> user_lefthand;
		$this -> user_righthand = $equipmentFetch -> user_righthand;
		$this -> user_necklace = $equipmentFetch -> user_necklace;
		$this -> user_ring = $equipmentFetch -> user_ring;
		//
	}

	public function showEquipment()
	{
		self::fetchEquipment();
		echo 'Head: '.$this -> user_head;
		echo '<br>Body: '.$this -> user_body;
		echo '<br>Legs: '.$this -> user_legs;
		echo '<br>Foots: '.$this -> user_foots;
		echo '<br>Righthand: '.$this -> user_righthand;
		echo '<br>Lefthand: '.$this -> user_lefthand;
		echo '<br>Necklace: '.$this -> user_necklace;
		echo '<br>Ring: '.$this -> user_ring;
	}
}
?>