<?php

/**
 * Simple user model
 */
class User_model extends CI_Model {
	var $uid;
	var $firstname;
	var $lastname;

	function __contruct() {
		parent::__contruct();
	}

	/*
	 * add user to db
	 */
	function add_user() {
		$this->firstname = $this->input->post('firstname');
		$this->lastname = $this->input->post('lastname');
		$this->db->insert('user', $this);
		$this->uid = $this->db->insert_id();
	}

	function list_users() {
		$q = $this->db->query("SELECT * FROM user ORDER BY lastname, firstname");

		$users = array();
		foreach($q->result("User_model") as $item) {
			$users[] = $item;
		}
		return $users;
	}
}