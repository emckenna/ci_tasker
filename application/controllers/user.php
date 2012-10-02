<?php
class User extends My_Controller {
	public function index($uid = NULL) {
		$this->load->helper('html');
		$this->load->model('User_model');
		$this->load->model('Task_model');
		$this->load->library('table');

		$data['user'] = $this->User_model->view($uid);
		$table_data = array(array('start', 'end', 'description', ''));

		if ($data['user']) {

			$tasks = $this->Task_model->get_tasks_by_user($uid);
			//print_r($tasks);
			foreach ($tasks as $task) {
				$edit = anchor('#', 'Edit');
				$del = anchor("user/$uid/deleteTask/$task->tid", 'Delete');
				$table_data[] = array($task->start, $task->end, $task->description, "$edit | $del");
			}

			$data['task_table_data'] = $table_data;
			$this->wrap_content('tasker_user_profile', $data);
		}
		else {
			$users = $this->User_model->list_users();

			foreach ($users as $user) {
				$list[] = anchor('user/'.$user->uid, $user->lastname .", ". $user->firstname);
			}

			$data['users'] = ul($list);

			$this->wrap_content('tasker_user', $data);
		}
	}

	public function add() {
		$this->load->model('User_model');

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[3]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[3]|max_length[255]|xss_clean');

		if ($this->form_validation->run() === FALSE) {
			 $form_opts = array('validation_css' => '');;
	        if (isset($_POST['user_add_submit'])) {
	          $form_opts = array('validation_css' => ' error');
	        }
			$this->wrap_content('tasker_user_add', $form_opts);

		}
		else {
			$this->User_model->add_user();
			//$this->wrap_content('tasker_user');
			redirect('user');
		}

	}
}