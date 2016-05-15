<?php


class Note
{

	public $Title = "";
	public $Text = "";

	public $Date="";
	public $Located = "";

	public $UserId = "";

	public $Id = "";




	public function GetNotes(){
		$Mongo = new Mongo();
		return $Mongo->mydb->notes;
	}



	public function Add() {

		$data = array(
			"user_id" => $this->UserId,
			"title" => $this->Title,
			"text" => $this->Text,
			"date" => $this->Date,
			"located"=>$this->Located
			);

		$this->GetNotes()->insert($data);

		$this->Id = $data["_id"];
	}



	public function Update(){
		
		$newdata = array(
			"title" => $this->Title,
			"text" => $this->Text,
			"date" => $this->Date
		);


		$this->GetNotes()->update(
			array("_id" => new MongoId($this->Id)),
			array('$set' => $newdata)
		);
	}




	public function Remove(){
		$this->GetNotes()->remove(array(
			"_id" => new MongoId($this->Id)
			));
	}



	public function GetNotesJSON(){

		$mynotes = $this->GetNotes()->find(array(
			"user_id" => $this->UserId
			));

		$json = array();
		foreach ($mynotes as $note) {
			array_push($json, array(
				"id" => $note["_id"]->{'$id'},
				"title" => $note["title"],
				"text" => $note["text"],
				"date" => $note["date"],
				"located"=>$note["located"]
				));
		}
		return json_encode($json);
	}




	public static function GetAllNotes(){
		$Mongo = new Mongo();
		return $Mongo->mydb->notes;
	}





}


?>