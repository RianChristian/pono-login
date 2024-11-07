<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Profile Saya';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama Lengkap Wajib diisi!',
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];


            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/profile';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('user');


            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Profile Anda Berhasil di Perbaharui!</div>');
            redirect('user');
        }
    }

    public function gantiPassword()
    {
        $data['title'] = 'Ganti Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('password_saat_ini', 'Password Saat Ini', 'required|trim', [
            'required' => 'Password Saat Ini Wajib diisi!'
        ]);
        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[3]|matches[password_baru2]', [
            'required' => 'Password Baru Wajib diisi!',
            'matches' => 'Password Tidak Sama!',
            'min_length' => 'Panjang bidang Password Baru minimal harus 3 karakter!'
        ]);
        $this->form_validation->set_rules('password_baru2', 'Konfirmasi Password Baru', 'required|trim|min_length[3]|matches[password_baru1]', [
            'required' => 'Konfirmasi Password wajib diisi!',
            'matches' => 'Password Tidak Sama!',
            'min_length' => 'Panjang bidang Konfirmasi Password Baru minimal harus 3 karakter!'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/gantipassword', $data);
            $this->load->view('templates/footer');
        } else {
            $password_saat_ini = $this->input->post('password_saat_ini');
            $password_baru = $this->input->post('password_baru1');

            if (!password_verify($password_saat_ini, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Password saat ini salah!</div>');
                redirect('user/gantipassword');
            } else {
                if ($password_saat_ini == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert 
                    alert-danger" role="alert">Kata sandi baru tidak boleh sama dengan kata sandi lama!</div>');
                    redirect('user/gantipassword');
                } else {
                    //passwordnya sudah ok
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert 
                    alert-success" role="alert">Password Berhasil Diganti!</div>');
                    redirect('user/gantipassword');
                }
            }
        }
    }


    public function daftarpengaduan()
    {
        $data['title'] = 'Bantuan & Pengaduan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/daftarpengaduan', $data);
        $this->load->view('templates/footer');
    }

    public function kebijakan()
    {
        $data['title'] = 'Kebijakan Aplikasi';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/kebijakan', $data);
        $this->load->view('templates/footer');
    }

    public function kritiksaran()
    {
        $data['title'] = 'Kritik & Saran';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['kritikSaran'] = $this->db->get('pengaduan')->result_array();

        $this->form_validation->set_rules('kritiksaran', 'Kritik & Saran', 'required', [
            'required' => 'Masukkan Kritik & Saran Terlebih Dahulu!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/kritiksaran', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('pengaduan', ['kritiksaran' => $this->input->post('kritiksaran')]);
            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Kritik dan Saran dari Anda Telah Terkirim!</div>');
            redirect('user/kritiksaran');
        }
    }

    public function pengingat()
    {
        $data['title'] = 'Pengingat Saya';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama_obat', 'Nama', 'required', [
            'required' => 'Nama wajib diisi!',
        ]);
        $this->form_validation->set_rules('jenis_obat', 'Jenis', 'required', [
            'required' => 'Jenis wajib diisi!',
        ]);
        $this->form_validation->set_rules('aturan', 'Aturan', 'required', [
            'required' => 'Aturan wajib diisi!',
        ]);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', [
            'required' => 'Keterangan wajib diisi!',
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required', [
            'required' => 'Status wajib diisi!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/indexalarm', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_obat' => $this->input->post('nama_obat'),
                'jenis_obat' => $this->input->post('jenis_obat'),
                'aturan' => $this->input->post('aturan'),
                'keterangan' => $this->input->post('keterangan'),
                'status' => $this->input->post('status')
            ];
            $this->db->insert('history', $data);
            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Pengingat Baru Ditambahkan!</div>');
            redirect('user/indexalarm');
        }
    }

    public function history()
    {
        $data['title'] = 'Riwayat Pengingat Minum Obat';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['history'] = $this->db->get('history')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/history', $data);
        $this->load->view('templates/footer');
    }
}
