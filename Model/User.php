<?php

require_once(realpath(__DIR__.'/..').'/Model/Note.php'); 

class User
{

	public $Login = "";
	public $Password = "";

	public $UserId = "";

	public $Authorized = False;




	function Authorize(){
		$user = User::GetUsers()->findOne(array(
			"login" => $this->Login,
			"pass" => $this->Password,
		));

		$this->UserId = $user["_id"];

		$this->Authorized = isset($user);

		return $this->Authorized;
	}



	public static function DeleteUserById($user_id){

		Note::GetNotes()->remove(array(
			"user_id" => new MongoId($user_id)
			));
		User::GetUsers()->remove(array(
			"_id" => new MongoId($user_id)
			));
	}





	public static function GetUsers(){
		$Mongo = new Mongo();
		return $Mongo->mydb->users;
	}



	public static function GetUserNameById($user_id){
		return User::GetUsers()->findOne(array("_id" => new MongoId($user_id)))["login"];
	}








	public function Register(){
		if($this->IsPasswordValid() && $this->IsLoginValid()){
			User::GetUsers()->insert(array(
				"login" => $this->Login,
				"pass" => $this->Password
			));
			$this->Authorize();
			return True;
		}
		return False;
	}




	public function IsPasswordValid(){
		return (strlen($this->Password) >= 6);			
	}



	public function IsLoginValid(){
		
		if(strlen($this->Login) <= 6){
			return False;
		}


		$user = User::GetUsers()->findOne(array(
			"login" => $this->Login
		));

		if(isset($user)){
			return False;
		}
		return True;
	}
			
	


}


?>