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

	/**
	 * load task data for use on forms and views
	 * @param  int $tid task id
	 * @return Task_model      Task model object
	 */
	function load_task($tid) {
		$q = $this->db->query("SELECT * FROM task WHERE tid = ?", array($tid));

		if (empty($q)) {
			return FALSE;
		}

		return $q->row(0, 'Task_model');

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
	function update_task($tid) {
		$this->start = $this->getDateInput();
		$this->end = $this->getDateInput(FALSE);
		$this->creator_uid = $this->input->post('creator_uid');
		$this->description = $this->input->post('description');
		$this->recurrence = $this->input->post('recurrence');
		$this->tid = $this->input->post('tid');

		// How are recurring tasks affected?
		$this->db->where('tid', $tid);
		$this->db->update('task', $this);
	}

	/**
	 * delete a task.  remove task and all attendence if deleted by creator,
	 * otherwise only delete attendence for user
	 * @param  int $uid user id
	 * @param  int $tid task id
	 */
	function delete_task($uid, $tid) {
		$result = array();
		if ($this->is_user_creator($uid, $tid)) {
			$result[] = $this->db->delete('task', array('tid' => $tid));
			$result[] = $this->db->delete('attendence', array('tid' => $tid));
		}
		else {
			$result[] = $this->db->delete('attendence', array('uid' => $uid, 'tid' => $tid));
		}
		return $result;
	}

	function get_todays_tasks_by_user($uid) {
		$start_today = timestamp_to_mysqldatetime(mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
		$end_today = timestamp_to_mysqldatetime(mktime(11, 59, 59, date("m")  , date("d"), date("Y")));
	}

	function get_tasks_by_user($uid) {
		$start_today = timestamp_to_mysqldatetime(mktime(0, 0, 0, date("m")  , date("d"), date("Y")));

		$sql = "SELECT t.* FROM task t JOIN attendence a ON a.tid = t.tid WHERE a.uid = ?";
		$sql .= " AND t.end >= '$start_today' ORDER by t.start ASC";
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

	function is_user_creator($uid, $tid){
		$sql = "SELECT 1 FROM task WHERE creator_uid = ? AND tid = ?";
		$query = $this->db->query($sql, array($uid, $tid));
		return $query->num_rows() > 0;
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