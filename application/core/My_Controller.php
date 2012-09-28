<?php
/**
 * Quick wrapper for content
 * 
 */
 
class MY_Controller extends CI_Controller{

    protected function wrap_content($content, $data = NULL) {
        $this->load->view('tasker_top');
        $this->load->view('tasker_menu_top');
        $this->load->view($content, $data);
        $this->load->view('tasker_footer');
    }
}
