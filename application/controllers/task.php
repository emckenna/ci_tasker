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
		$data['recurrence_opts'] = $this->Task_model->recurrence_options();

		$this->form_validation->set_rules('start_date', 'Star Date', 'trim|required|min_length[5]|max_length[12]|xss_clean');

		if ($this->form_validation->run() === FALSE) {
			$data['validation_css'] =  '';
	        if (isset($_POST['task_add_submit'])) {
	          $data['validation_css'] = 'error';
	        }
			$this->wrap_content('tasker_task_add', $data);

		}else {
			$this->Task_model->add_task($uid);
			//$this->wrap_content('tasker_task_add', $data);
			redirect("user/$uid");
		}


	}

	function edit($uid, $tid) {

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


}