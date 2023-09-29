<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        $this->load->view('auth/login');
    }
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
		$this->load->helper('my_helper');
    }
    public function aksi_login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $data = ['email' => $email];
        $query = $this->m_model->getwhere('admin', $data);
        $result = $query->row_array();
        if (!empty($result) && md5($password) === $result['password']) {
            $data = [
                'logged_in' => true,
                'email' => $result['email'],
                'username' => $result['username'],
                'role' => $result['role'],
                'id' => $result['id'],

            ];
            $this->session->set_userdata($data);
            if ($this->session->userdata('role') == 'admin') {
                redirect(base_url() . "admin");
            } else if($this->session->userdata('role') == 'keuangan'){
                redirect(base_url() . "keuangan");
            }
             else {
                redirect(base_url() . "auth");
            }
        } else {
            redirect(base_url() . "auth");
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'auth');
    }

}
