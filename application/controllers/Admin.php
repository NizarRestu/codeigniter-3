<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
        if ($this->session->userdata('logged_in') != true) {
            redirect(base_url().'auth');
        }
    }

    public function index()
    {
        $this->load->view('page/dashboard');
    }
    public function siswa(){
        $data['siswa'] = $this-> m_model->get_data('siswa')->result();
        
        $this->load->view('page/siswa', $data);

    }
    public function tambah_siswa(){       
        $data['kelas'] = $this-> m_model->get_data('kelas')->result();
        $this->load->view('page/tambah_siswa', $data);

    }
    public function  hapus_siswa($id) {
        $this -> m_model->delete('siswa' , 'id_siswa' , $id);
        redirect(base_url('admin/siswa'));
    }

    public function tambah_siswa_form()
    {
        $data = [
            'nama_siswa' => $this->input->post('nama_siswa'),
            'nisn' => $this->input->post('nisn'),
            'gender' => $this->input->post('gender'),
            'id_kelas' => $this->input->post('id_kelas'),
        ];

        $this->m_model->add('siswa', $data);
        redirect(base_url('admin/siswa'));
    }
}
