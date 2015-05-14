<?php
class player
{
	protected $playerId;

	public function __construct($playerId)
	{
		$this -> _playerId = $playerId;
	}

	public function findUser($id)
	{
		if($id == 0)
		{
			$this -> _name = 'GlaDoS';
		}else
		{
			include('./assets/connect.php');
			$userQuery = $pdo -> prepare("SELECT user_login FROM users_accounts WHERE id = :id");
			//
			$userQuery -> bindValue(':id',$id,PDO::PARAM_INT);
			//
			$userQuery -> execute();
			//
			$fetchName = $userQuery -> fetch(PDO::FETCH_OBJ);
			//
			$this -> _name = $fetchName -> user_login;
		}
	}
}

class listingMessages extends player
{
	public $name;

	public function __construct($id)
	{
		parent::__construct($id);
	}

	public function showMsg()
	{
		include('./assets/connect.php');
		//this method gonna fetch all of player messages
		$query = $pdo -> prepare("SELECT * FROM users_messages WHERE messages_userId = :id");
		//
		$query -> bindValue(':id',$this -> _playerId,PDO::PARAM_INT);
		//
		$query -> execute();
		//
		$this -> list = 0;
		while($fetchMessages = $query -> fetch(PDO::FETCH_OBJ))
		{
			self::findUser(($fetchMessages -> messages_by));
			$this -> list = $this -> list + 1;
			echo '<br>'.$this -> list.'.<a href="/messagesRead.php?id='.$fetchMessages -> id.'">'.$fetchMessages -> messages_subject.'</a> From: '.$this -> _name;
		}
	}
}

class readMessage extends player
{

	private $messageId;
	private $permission;
	public $by;
	public $subject;
	public $text;
	public $readStatus;

	public function __construct($playerId,$messageId)
	{
		parent::__construct($playerId);
		$this -> _messageId = $messageId;
	}

	public function fetchMsg()
	{
		include('./assets/connect.php');
		//
			$query = $pdo -> prepare("SELECT * FROM users_messages WHERE messages_userId = :userId AND id = :msgId");
		//
			$query -> bindValue(':userId',$this -> _playerId,PDO::PARAM_INT);
		//
			$query -> bindValue(':msgId',$this -> _messageId,PDO::PARAM_INT);
		//
			$query -> execute();
		//
			if($fetchMessages = $query -> fetch(PDO::FETCH_OBJ))
			{
				//
				$this -> _persmission = true;
				//
				$this -> _by = $fetchMessages -> messages_by;
				$this -> _subject = $fetchMessages -> messages_subject;
				$this -> _text = $fetchMessages -> messages_text;
				$this -> _readStatus = $fetchMessages -> messages_readStatus;
			}else
			{
				$this -> _persmission = false;
			}

	}

	public function permission()
	{
		self::fetchMsg();
		if(($this -> _persmission) == true)
		{
			self::viewMsg();
		}else
		{
			self::FatalError();
			exit;
		}
	}

	public function FatalError()
	{
		echo "Sorry but you don't have persmission to read this message";
	}

	public function updateReadStatus()
	{
		include("./assets/connect.php");
		$update = $pdo -> prepare("UPDATE users_messages SET messages_readStatus = 1 WHERE id = :id");
		$update -> bindValue(':id',$this -> _messageId,PDO::PARAM_INT);
		$update -> execute();
	}

	public function checkReadStatus()
	{
		if(($this -> _readStatus) == 0)
		{
			self::updateReadStatus();
		}else
		{
			//Do nothin cuz readstatus equal 1
		}
	}

	public function viewMsg()
	{
		self::checkReadStatus();
		self::findUser(($this -> _by));
		echo '<br>Send by:'.$this -> _name;
		echo '<br>Subject:'.$this -> _subject;
		echo '<br>'.$this -> _text;
	}
}
?>