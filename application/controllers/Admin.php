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
        $data['siswa'] = $this-> m_model->get_data('siswa')->num_rows();
        $data['kelas'] = $this-> m_model->get_data('kelas')->num_rows();
        $data['guru'] = $this-> m_model->get_data('guru')->num_rows();
        $data['mapel'] = $this-> m_model->get_data('mapel')->num_rows();
        $this->load->view('page/dashboard', $data);
    }
    public function siswa(){
        $data['siswa'] = $this-> m_model->get_data('siswa')->result();
        
        $this->load->view('page/siswa', $data);

    }
    public function tambah_siswa(){       
        $data['kelas'] = $this-> m_model->get_data('kelas')->result();
        $this->load->view('page/tambah_siswa', $data);

    }
    public function ubah_siswa($id_siswa){       
        $data['kelas'] = $this-> m_model->get_data('kelas')->result();
        $data['siswa']=$this->m_model->get_by_id('siswa' , 'id_siswa' , $id_siswa)->result();
        $this->load->view('page/ubah_siswa', $data);

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

    public function ubah_siswa_form()
    {
        $data =  [
            'nama_siswa' => $this->input->post('nama_siswa'),
            'nisn' => $this->input->post('nisn'),
            'gender' => $this->input->post('gender'),
            'id_kelas' => $this->input->post('id_kelas'),
        ];
        $eksekusi = $this->m_model->update('siswa', $data, array('id_siswa'=>$this->input->post('id_siswa')));
        if($eksekusi) {
            $this->session->set_flashdata('sukses' , 'berhasil');
            redirect(base_url('admin/siswa'));
        } else {
            $this->session->set_flashdata('error' , 'gagal...');
            redirect(base_url('admin/siswa/ubah_siswa/'.$this->input->post('id_siswa')));
        }
    }
}
