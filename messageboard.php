<?php
class MessageBoard{
	var $message = array();
	
	function __construct(){
		$this->receiveMessage();
		$this->saveData();
		$this->loadData();
		$this->showAllMessages();
		$this->showForm();
	}
	
	function receiveMessage(){
		//echo "1";
		$this->saveData();
	}

	function saveData(){
		//echo "2";
	}

	function loadData(){
		//echo "3";
	}

	function showAllMessages(){
		//echo "4";
	}
	
	function showForm(){
		//echo "5";
	}
}
//implement
$mb = new MessageBoard();
?>
