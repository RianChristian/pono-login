<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Management Menu';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Menu wajib diisi!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Menu Baru Ditambahkan!</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Management Submenu';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_Model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required', [
            'required' => 'Title wajib diisi!',
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', [
            'required' => 'Menu wajib diisi!',
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required', [
            'required' => 'Url wajib diisi!',
        ]);
        $this->form_validation->set_rules('icon', 'icon', 'required', [
            'required' => 'Icon wajib diisi!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">SubMenu Baru Ditambahkan!</div>');
            redirect('menu/submenu');
        }
    }

    // public function ubahmenu($id)
    // {
    //     $data['title'] = 'Ubah Menu';
    //     $data['user'] = $this->db->get_where('user', ['email' =>
    //     $this->session->userdata('email')])->row_array();
    //     $data['ubahmenu'] = $this->Menu_Model->edit_data($id);

    //     $this->form_validation->set_rules('menu', 'Menu', 'required', [
    //         'required' => 'Menu wajib diisi!'
    //     ]);

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('menu/ubahmenu', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $this->Menu_Model->ubahDataMenu();
    //         $this->session->set_flashdata('message', '<div class="alert 
    //         alert-success" role="alert">Menu Diubah!</div>');
    //         redirect('menu');
    //     }
    // }
}
