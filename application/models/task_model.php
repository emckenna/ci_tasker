<?php

class Task_model extends CI_Model {
	var $tid;
	var $creator_uid;
	var $start;
	var $end;
	var $description;
	var $recurrence;

	function __contruct() {
		parent::__contruct();
	}

	function add_task($uid) {
		$this->start = $this->getDateInput();
		$this->end = $this->getDateInput(FALSE);
		$this->creator_uid = $this->input->post('creator_uid');
		$this->description = $this->input->post('description');
		$this->recurrence = $this->input->post('recurrence');


		// refactor this to add in recurrence
		$this->db->insert('task', $this);
		$this->tid = $this->db->insert_id();
		$this->add_user_attendance($this->tid, $uid);
	}

	/**
	 * Edit the task.  Only the task creator can edit a task.
	 * @param  int $tid the task id
	 * @return [type]      [description]
	 */
	function edit_task($tid) {

	}

	// hmm
	// difference between creator delete vs invite delete
	function delete_task($tid) {
		$this->db->delete('task', array('tid' => $tid));
		$this->db->delete('attendence', array('tid' => $tid));
	}

	function get_todays_tasks_by_user($uid) {
		$start_today = timestamp_to_mysqldatetime(mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
		$end_today = timestamp_to_mysqldatetime(mktime(11, 59, 59, date("m")  , date("d"), date("Y")));


	}

	function get_tasks_by_user($uid) {
		$start_today = timestamp_to_mysqldatetime(mktime(0, 0, 0, date("m")  , date("d"), date("Y")));

		$sql = "SELECT t.* FROM task t JOIN attendence a ON a.tid = t.tid WHERE a.uid = ?";
		$sql .= " AND t.end >= '$start_today'";
		$query = $this->db->query($sql, array($uid));

		$tasks = array();
		foreach ($query->result('Task_model') as $row) {
			$tasks[] = $row;
		}
		return $tasks;
	}


	function add_user_attendance($tid, $uid) {
		$sql = 'INSERT INTO attendence (tid, uid) VALUES (?, ?)';
		$this->db->query($sql, array($tid, $uid));
	}

	/**
	 * the options for recurrence, could easily be its own table, but
	 * for this lets keep it simple.
	 * @return array options for recurrence dropdown.
	 */
	function recurrence_options() {
		return array(
			0 => 'One Time',
			1 => 'Daily',
			2 => 'Weekly',
			3 => 'Montly',
		);
	}

	function getDateInput($start = TRUE) {
		$field = 'start';
		if (!$start) {
			$field = 'end';
		}

		$time = $this->input->post($field .'_time');
		$date = $this->input->post($field .'_date');
		$datetime = strtotime($date ." ". $time);
		return timestamp_to_mysqldatetime($datetime);
	}

}