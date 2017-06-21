<?php 
class Messages{
	var $name;
	var $content;
	var $time;

	function __construct($n, $c, $t){
		$this->name = $n;
		$this->content = $c;
		$this->time = $t;
	}
	function show(){
		echo "Name: ".$n."<br>";
		echo "content: ".$c."<br>";
		echo "Time: ".$t."<br>";	
		echo "-----------------------------------------------";

	}
}
//implement
$m = new Messages("GG", "2017.6.20", "GG is big.");
$m->show();
 ?>