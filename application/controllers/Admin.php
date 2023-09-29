<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
        $this->load->library('upload');
        if ($this->session->userdata('logged_in') != true && $this->session->userdata('role') !== 'admin') {
            redirect(base_url() . 'auth');
        }
    }

    public function index()
    {
        $data['siswa'] = $this->m_model->get_data('siswa')->num_rows();
        $data['kelas'] = $this->m_model->get_data('kelas')->num_rows();
        $data['guru'] = $this->m_model->get_data('guru')->num_rows();
        $data['mapel'] = $this->m_model->get_data('mapel')->num_rows();
        $this->load->view('page/dashboard', $data);
    }
    public function upload_image_admin($value)
    {
        $kode = round(microtime(true) * 1000);
        $config['upload_path'] = './images/admin/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 30000;
        $config['file_name'] = $kode;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($value)) {
            return array(false, '');
        } else {
            $fn = $this->upload->data();
            $nama = $fn['file_name'];
            return array(true, $nama);
        }

    }
    public function siswa()
    {
        $data['siswa'] = $this->m_model->get_data('siswa')->result();

        $this->load->view('page/siswa', $data);

    }
    public function akun()
    {
        $data['user'] = $this->m_model->get_by_id('admin', 'id', $this->session->userdata('id'))->result();
        $this->load->view('page/akun', $data);

    }
    public function tambah_siswa()
    {
        $data['kelas'] = $this->m_model->get_data('kelas')->result();
        $this->load->view('page/tambah_siswa', $data);

    }
    public function ubah_siswa($id_siswa)
    {
        $data['kelas'] = $this->m_model->get_data('kelas')->result();
        $data['siswa'] = $this->m_model->get_by_id('siswa', 'id_siswa', $id_siswa)->result();
        $this->load->view('page/ubah_siswa', $data);

    }
    public function hapus_siswa($id)
    {
     $siswa= $this->m_model->get_by_id('siswa','id_siswa',$id)->row();
     if($siswa){
        if($siswa->foto !== 'User.png') {
            $file_path = './images/siswa/' .$siswa->foto;
            if(file_exists($file_path)){
                if(unlink($file_path)){
                    $this->m_model->delete('siswa' ,'id_siswa',$id);
                    redirect(base_url('admin/siswa'));
                } else{
                    echo "Gagal manghapus file";
                }
            } else{
                echo "File tidak ditemukan";
            }
        } else{
            $this->m_model->delete('siswa' ,'id_siswa',$id);
            redirect(base_url('admin/siswa'));
        }
     } else{
        echo "Siswa tidak ditemukan";
     }
    }

    public function tambah_siswa_form()
    {
        $foto = $_FILES['foto']['name'];
		$foto_temp = $_FILES['foto']['tmp_name'];
        $kode = round(microtime(true) * 1000);
        $file_name = $kode . '_' . $foto;
        $upload_path = './images/siswa/' . $file_name;
        if ($foto[0] == false) {
            $data = [
                'foto' => 'User.png',
                'nama_siswa' => $this->input->post('nama_siswa'),
                'nisn' => $this->input->post('nisn'),
                'gender' => $this->input->post('gender'),
                'id_kelas' => $this->input->post('id_kelas'),
            ];

            $this->m_model->add('siswa', $data);
            redirect(base_url('admin/siswa'));
        } else {
            $data = [
                'foto' =>  $file_name,
                'nama_siswa' => $this->input->post('nama_siswa'),
                'nisn' => $this->input->post('nisn'),
                'gender' => $this->input->post('gender'),
                'id_kelas' => $this->input->post('id_kelas'),
            ];

            $this->m_model->add('siswa', $data);
            redirect(base_url('admin/siswa'));
        }

    }

    public function ubah_siswa_form()
    {
        $foto = $_FILES['foto']['name'];
		$foto_temp = $_FILES['foto']['tmp_name'];

		// Jika ada foto yang diunggah
		if ($foto) {
			$kode = round(microtime(true) * 1000);
			$file_name = $kode . '_' . $foto;
			$upload_path = './images/siswa/' . $file_name;

			if (move_uploaded_file($foto_temp, $upload_path)) {
				// Hapus foto lama jika ada
				$old_file = $this->m_model->get_siswa_foto_by_id($this->input->post('id_siswa'));
				if ($old_file && file_exists('./images/siswa/' . $old_file)) {
					unlink('./images/siswa/' . $old_file);
				}

				$data = [
					'foto' => $file_name,
					'nama_siswa' => $this->input->post('nama_siswa'),
					'nisn' => $this->input->post('nisn'),
					'gender' => $this->input->post('gender'),
					'id_kelas' => $this->input->post('id_kelas'),
				];
			} else {
				// Gagal mengunggah foto baru
				redirect(base_url('admin/ubah_siswa/' . $this->input->post('id_siswa')));
			}
		} else {
			// Jika tidak ada foto yang diunggah
			$data = [
				'nama_siswa' => $this->input->post('nama'),
				'nisn' => $this->input->post('nisn'),
				'gender' => $this->input->post('gender'),
				'id_kelas' => $this->input->post('kelas'),
			];
		}

		// Eksekusi dengan model ubah_data
		$eksekusi = $this->m_model->update('siswa', $data, array('id_siswa' => $this->input->post('id_siswa')));

		if ($eksekusi) {
			redirect(base_url('admin/siswa'));
		} else {
			redirect(base_url('admin/ubah_siswa/' . $this->input->post('id_siswa')));
		}
    }
    public function aksi_ubah_akun()
    {
        $foto = $this->upload_image_admin('foto');
        if ($foto[0] == false) {
            $password_baru = $this->input->post('password_baru');
            $konfirmasi_password = $this->input->post('konfirmasi_password');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $data = [
                 'foto' => 'User.png',
                'email' => $email,
                'username' => $username,
            ];
            if (!empty($password_baru)) {
                if ($password_baru === $konfirmasi_password) {
                    $data['password'] = md5($password_baru);
                } else {
                    $this->session->set_flashdata('message', 'Password baru dan Konfirmasi password harus sama');
                    redirect(base_url('admin/akun'));
                }
            }
            $this->session->set_userdata($data);
            $update_result = $this->m_model->update('admin', $data, array('id' => $this->session->userdata('id')));

            if ($update_result) {
                redirect(base_url('admin/akun'));
            } else {
                redirect(base_url('admin/akun'));
            }
        } else {
            $password_baru = $this->input->post('password_baru');
            $konfirmasi_password = $this->input->post('konfirmasi_password');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $data = [
                 'foto' => $foto[1],
                'email' => $email,
                'username' => $username,
            ];
            if (!empty($password_baru)) {
                if ($password_baru === $konfirmasi_password) {
                    $data['password'] = md5($password_baru);
                } else {
                    $this->session->set_flashdata('message', 'Password baru dan Konfirmasi password harus sama');
                    redirect(base_url('admin/akun'));
                }
            }
            $this->session->set_userdata($data);
            $update_result = $this->m_model->update('admin', $data, array('id' => $this->session->userdata('id')));

            if ($update_result) {
                redirect(base_url('admin/akun'));
            } else {
                redirect(base_url('admin/akun'));
            }
        }
    }
}
