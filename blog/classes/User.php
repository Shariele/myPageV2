<?php

class User{
	private $username;
	private $user_type;
	private $super_id;

	public function __construct($username, $user_type, $super_id){
		$this->username = $username;
		$this->user_type = $user_type;
		$this->super_id = $super_id;
	}

	// Medlemsfunktioner
	public function Set_name($username){
		$this->username = $username;
	}
	public function Set_type($user_type){
		$this->user_type = $user_type;
	}
	public function Set_id($super_id){
		$this->super_id = $super_id;
	}

	public function Get_name(){
		return $this->username;
	}
	public function Get_type(){
		return $this->user_type;
	}
	public function Get_id(){
		return $this->super_id;
	}

}
?>