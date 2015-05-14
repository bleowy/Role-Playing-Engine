<?php
class Expedition
{

	protected $playerId;
	protected $travelTime;
	public $chance;

	public function __construct($playerId)
	{
		$this -> _playerId = $playerId;
	}

	public function fetchExpedition()
	{
		include("./assets/connect.php");
			$prepareExpedition = $pdo -> prepare("SELECT * FROM game_expeditions WHERE id = :id");
			$prepareExpedition -> bindValue(':id',$this -> _playerId,PDO::PARAM_INT);
			$prepareExpedition -> execute();
			$fetchExpedition = $prepareExpedition -> fetch(PDO::FETCH_OBJ);

			$this -> expedition_time = $fetchExpedition -> expedition_time;
			$this -> gold = $fetchExpedition -> expedition_gold;
			$this -> id = $fetchExpedition -> id;
			$this -> text = $fetchExpedition -> expedition_text;
			$this -> _chance = $fetchExpedition -> expedition_chance;
	}

	public function travel()
	{
		include('./assets/connect.php');
		$query = $pdo -> prepare("SELECT travel_time FROM game_travel WHERE id = :id");
		$query -> bindValue(':id',$this -> _playerId,PDO::PARAM_INT);
		$query -> execute();
		$userTravel = $query -> fetch(PDO::FETCH_OBJ);
		$this -> _travelTime = $userTravel -> travel_time;
	}
}

class showExpeditions extends Expedition
{

	public function Show($status)
	{
		if($status == false)
		{
			include('./assets/connect.php');
			$queryExpeditions = $pdo -> query("SELECT id,expedition_name,expedition_time FROM game_expeditions");

			while($fetchExpeditions = $queryExpeditions -> fetch(PDO::FETCH_OBJ))
			{
				echo '<br>'.$fetchExpeditions -> expedition_name.', this expedition needs '
				.$fetchExpeditions -> expedition_time.' min to end. <a href="/expedition_go.php?id='.$fetchExpeditions -> id.'">Go</a>';
			}
		}else{
			self::travel();
			echo 'You are already on expedition!<br>Remaining Time:'.$this -> _travelTime;

		}
	}

}

class startExpeditions extends Expedition
{

	public function __construct($expeditionId,$playerId)
	{
		parent::__construct($playerId);
		$this -> _expeditionId = $expeditionId;
	}



	public function timeCalculate()
	{
		self::fetchExpedition();
		$timestamp = time() + ($this -> expedition_time) * 60;
		$timeCalculeted = date("Y-m-d H:i:s",$timestamp);
		
		$this -> timeCalculeted = $timeCalculeted;
	} 

	public function setExpedition()
	{
		include("./assets/connect.php");
		self::timeCalculate();
		$updateId = $pdo -> prepare("UPDATE game_travel SET travel_id = :travel_id 
				WHERE id = :id");
		$updateTime = $pdo -> prepare("UPDATE game_travel SET travel_time = :travel_time 
				WHERE id = :id");
		//
			$updateId -> bindValue(':travel_id',$this -> id,PDO::PARAM_INT);
			$updateId -> bindValue(':id',$this -> _playerId,PDO::PARAM_INT);
			//
			$updateTime -> bindValue(':travel_time',$this -> timeCalculeted,PDO::PARAM_INT);
			$updateTime -> bindValue(':id',$this -> _playerId,PDO::PARAM_INT);
			//
				$updateId -> execute();
				//
				$updateTime -> execute();
		//
		
		
	}
}

class endExpeditions extends Expedition
{

	public $gold;

	public function checkTime()
	{
		include('./assets/connect.php');
		$this -> time = $time = date("Y-m-d H:i:s");
		//
		$prepareTravel = $pdo -> prepare("SELECT * FROM game_travel WHERE travel_id > 0 AND id = :id");
		//
		$prepareTravel -> bindValue(':id',$this -> _playerId,PDO::PARAM_INT);
		//
		$prepareTravel -> execute();
		//
		$fetchTravel = $prepareTravel -> fetch(PDO::FETCH_OBJ);
		if($fetchTravel)
		{
				if(($fetchTravel -> travel_time) <= ($this -> time))
				{
					self::RestartTime();
					return $this -> EndedExp = true;
				}else
				{
					return $this -> Busy = true;
				}
		}else
		{
			return $this -> Busy = false;
		}
	}

	public function RestartTime()
	{
		 include('./assets/connect.php');
		 //
		 	$prepareId = $pdo -> prepare("UPDATE game_travel SET travel_id = 0 WHERE id = :id");
		 //
		 	$prepareId -> bindValue(':id',$this -> _playerId,PDO::PARAM_INT);
		 //
		 	$prepareId -> execute();
		 //
		 	$prepareTime = $pdo -> prepare("UPDATE game_travel SET travel_time = travel_time - travel_time WHERE id = :id");
		 //
		 	$prepareTime -> bindValue(':id',$this -> _playerId,PDO::PARAM_INT);
		 //
		 	$prepareTime -> execute();
		 //
		 	self::chance();
	}

	public function end()
	{
		//Put here methods for the end of expedition.Things like a addmoney,additem itd.
		self::addMoney();
		self::sendMessage();	
	}

	public function randGold($max)
	{
		return $this -> randGold = rand(1,$max);
	}

	public function addMoney()
	{
		include('./assets/connect.php');
		//
		self::fetchExpedition();
		self::randGold(($this -> gold));
		//
			$updateUser = $pdo -> prepare("UPDATE users_accounts SET user_gold = user_gold + :gold WHERE id = :id");
		//
			$updateUser -> bindValue(':gold',$this -> randGold,PDO::PARAM_INT);
		//
			$updateUser -> bindValue(':id',$this -> _playerId,PDO::PARAM_INT);
		//
			$updateUser -> execute();
		//
			$this -> _gold = $this -> randGold;
		//
	}

	public function textMessage($text)
	{
		$this -> notreadyText = $text.'<br>Reward: Gold = '.$this -> _gold;
		$this -> readyText = $this -> notreadyText;
	}

	public function sendMessage()
	{
		include('./assets/connect.php');
		self::fetchExpedition();
		self::textMessage(($this -> text));
		//
			$sendMessage = $pdo -> prepare("INSERT INTO users_messages (`messages_userId`,`messages_by`,`messages_subject`,`messages_text`) 
				VALUES (:userId,0,'Expedition Report',:messageText)");
		//
			$sendMessage -> bindValue(':userId',$this -> _playerId,PDO::PARAM_INT);
		//
			$sendMessage -> bindValue(':messageText',$this -> readyText,PDO::PARAM_STR);
		//
			$sendMessage -> execute();
		//
	}

	public function chance()
	{
		self::fetchExpedition();
		$this -> rand = rand(0,100);
		echo $this -> rand.$this -> _chance;
		if(($this -> rand) <= ($this -> _chance))
		{
			self::end();
		}else
		{
			self::sendMessageFail();
		}
	}

	public function sendMessageFail()
	{
		include('./assets/connect.php');
		self::fetchExpedition();
		//
			$sendMessage = $pdo -> prepare("INSERT INTO users_messages (`messages_userId`,`messages_by`,`messages_subject`,`messages_text`) 
				VALUES (:userId,0,'Expedition Report Fail','This time you have no chance do that expedition')");
		//
			$sendMessage -> bindValue(':userId',$this -> _playerId,PDO::PARAM_INT);
		//
			$sendMessage -> execute();
		//
	}
}
?>