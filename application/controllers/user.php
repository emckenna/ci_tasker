<?php
class User extends My_Controller {
	public function index($uid = NULL) {
		if (isset($uid)) {
			echo 'uid is set';
			$this->wrap_content('tasker_user_profile', $data);
		}else {
			$this->load->helper('html');
			$this->load->model('User_model');
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

		}else {
			$this->User_model->add_user();
			//$this->wrap_content('tasker_user');
			redirect('user');
		}

	}
}