<?php


class Note
{

	public $Title = "";
	public $Text = "";

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
			"text" => $this->Text
			);

		$this->GetNotes()->insert($data);

		$this->Id = $data["_id"];
	}



	public function Update(){
		
		$newdata = array(
			"title" => $this->Title,
			"text" => $this->Text,
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





}


?>