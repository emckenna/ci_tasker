<?php
class Task extends MY_Controller {
	function index() {
		$this->wrap_content('tasker_task', $data);

	}

	function add($uid) {
		$this->load->model('Task_model');
		$this->load->model('User_model');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$user = $this->User_model->view($uid);
		$data['display_name'] = $user->getName();
		$data['uid'] = $uid;
		$data['form_action'] = "task/add/$uid";
		$data['recurrence_opts'] = $this->Task_model->recurrence_options();
		$this->form_validation->set_rules('start_date', 'Star Date', 'trim|required|min_length[5]|max_length[12]|xss_clean');

		if ($this->form_validation->run() === FALSE) {
			$data['validation_css'] =  '';
	        if (isset($_POST['task_add_submit'])) {
	          $data['validation_css'] = 'error';
	        }

	        $this->load_default_values($data, $uid);
			$this->wrap_content('tasker_task_add', $data);

		}else {
			$this->Task_model->add_task($uid);
			redirect("user/$uid");
		}

	}

	/**
	 * edit controller for task.
	 * TODO: refactor edit and add to have form prep and validation in one
	 * location.
	 * @param  int $uid user id
	 * @param  int $tid task id
	 * @return none      redirects to user profile page.
	 */
	function edit($uid, $tid) {
		$this->load->model('Task_model');
		$this->load->model('User_model');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$user = $this->User_model->view($uid);

		$data['display_name'] = $user->getName();
		$data['uid'] = $uid;
		$data['tid'] = $tid;
		$data['form_action'] = "task/edit/$uid/$tid";

		$data['recurrence_opts'] = $this->Task_model->recurrence_options();
		$this->form_validation->set_rules('start_date', 'Star Date', 'trim|required|min_length[5]|max_length[12]|xss_clean');

		if ($this->form_validation->run() === FALSE) {
			$data['validation_css'] =  '';
	        if (isset($_POST['task_add_submit'])) {
	          $data['validation_css'] = 'error';
	        }

	        $this->load_default_values($data, $uid, $tid);
			$this->wrap_content('tasker_task_add', $data);

		}else {
			$this->Task_model->update_task($tid);
			redirect("user/$uid");
		}
	}

	/**
	 * callback for deleting tasks
	 * @param  int $uid user id
	 * @param  int $tid task id
	 * @return none redirect to user profile.
	 */
	function delete($uid, $tid) {
		$this->load->model('Task_model');
		$result = $this->Task_model->delete_task($uid, $tid);
		redirect("user/$uid");
	}

	function show_all_tasks() {
		$this->wrap_content('tasker_all_tasks', $data);
	}

	function load_default_values(&$data, $uid, $tid = NULL) {
		date_default_timezone_set('America/New_York'); 
		$data['action'] 		= "Adding";
		$data['description']	= '';
		$data['start_date']		= date('m/d/Y');
		$data['start_time']		= date("g A", strtotime("+1 hour"));
		$data['end_date']		= date('m/d/Y');
		$data['end_time']		= date("g A", strtotime("+2 hour"));
		$data['recurrence']		= 0;


		if ($tid) {
			$task = $this->Task_model->load_task($tid);
			$unix_start = mysqldatetime_to_timestamp($task->start);
			$unix_stop	= mysqldatetime_to_timestamp($task->end);

			$data['action'] 		= "Editing";
			$data['description']	= $task->description;
			$data['start_date']		= date('m/d/Y', $unix_start);
			$data['start_time']		= date("g A", $unix_start) ;
			$data['end_date']		= date('m/d/Y', $unix_stop);
			$data['end_time']		= date("g A", $unix_stop);
			$data['recurrence']		= $task->recurrence;

		}

	}
}