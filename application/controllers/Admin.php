<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $image['user'] = $this->db->get_where('user', ['image' => $this->session->userdata('image')])->row_array();
        // echo 'selamat datang ' . $data['user']['name'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
        // $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Dashboard role ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $image['user'] = $this->db->get_where('user', ['image' => $this->session->userdata('image')])->row_array();
        // echo 'selamat datang ' . $data['user']['name'];
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'role' => $this->input->post('role'),

            ];

            $this->db->insert('user_role', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Sub Menu added</div>');
            redirect('admin/role');
        }
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Dashboard roleAccess ';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $image['user'] = $this->db->get_where('user', ['image' => $this->session->userdata('image')])->row_array();
        // echo 'selamat datang ' . $data['user']['name'];
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed</div>');
    }
    //menu
    public function menu()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->Menu_model->tampil_management()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahMenu()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            //jika salah
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">form salah</div>');
            redirect('menu');
        } else {
            $data = array(
                'menu' => $this->input->post('menu'),

            );
            $this->Menu_model->insert_management($data, 'user_menu');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added</div>');
            redirect('menu');
        }
    }
    public function editMenu($id)
    {
        $data['title'] = 'Edit Menu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $where = array('id' => $id);
        // $data['menu'] = $this->Menu_model->edit_management($where, 'user_menu')->result();
        // $data['menu'] = $this->Menu_model->tampil_management()->result_array();
        $data['menu'] = $this->Menu_model->edit_management($where, 'user_menu')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/edit_menu', $data);
        $this->load->view('templates/footer');
    }
    public function hapusMenu($id)
    {
        $data['title'] = 'Delete Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $where = array('id' => $id);
        $this->Menu_model->hapus_submenu($where, 'user_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Succes Delete Menu Management</div>');
        redirect('menu');
    }

    public function updateMenu()
    {
        $id = $this->input->post('id');
        $menu = $this->input->post('menu');

        $data = array(
            'menu' => $menu,
        );
        // var_dump($data);

        // $where = array(
        //     'id' => $id
        // );

        // $hasil = $this->Menu_model->update_management($where, $data, 'user_menu');
        // var_dump($hasil);

        // $this->db->where($where);
        // $this->db->update($table, $data);

        $this->db->set('menu', $menu);
        $this->db->where('id', $id);
        $hasil =  $this->db->update('user_menu');
        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Sub Menu Update</div>');
            redirect('menu');
        } else {
            var_dump($hasil);
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed Sub Menu Update</div>');
        }
    }
    // /sub menu 
    public function submenu()
    {
        $data['title'] = 'Sub Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // data['barang'] = $this->model_barang->tampil_data()->result();

        // load model db ci
        // $data['subMenu'] = $this->db->get('user_menu')->result_array();
        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        // $data['subMenu'] = $this->load->model('Menu_model', 'menu');
        // $data['user_menu'] = $this->menu->tampil_data()->result_array();
        $data['menu'] =  $this->menu->tampil_data()->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');


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
                'is_active' => $this->input->post('is_active'),
            ];

            $this->db->insert('user_sub_menu', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Sub Menu added</div>');
            redirect('menu/submenu');
        }
        // $data['subMenu'] = $this->db->get('user_sub_menu')->result_array();

    }

    public function editSubmenu($id)
    {
        $data['title'] = 'Sub Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $where = array('id' => $id);
        $data['menu'] =  $this->Menu_model->tampil_data()->result();
        // var_dump($data['menu']);
        // die;
        // $query = $this->Menu_model->tampil_data($id);
        // if ($query->num_rows()>0) {
        //     $menu_id[null] = '-selected';
        //     foreach($data['menu']->result() as $unit){
        //         $unit[$unit->$menu_id] = $unit->menu;
        //     }
        // }
        // $this->


        $data['subMenu'] = $this->Menu_model->edit_barang($where, 'user_sub_menu')->result();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/edit_submenu', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $menu_id = $this->input->post('menu_id');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');
        // $stok = $this->input->post('stok');

        $data = array(
            'title' => $title,
            'menu_id' => $menu_id,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active

        );
        var_dump($data);

        $where = array(
            'id' => $id
        );
        echo "<br>";

        //$hasil = $this->Menu_model->update_data($where, $data, 'user_sub_menu');
        $this->db->set($data);
        $this->db->where($where);
        $hasil =  $this->db->update('user_sub_menu');
        var_dump($hasil);


        if ($hasil) {

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Sub Menu Update</div>');
            redirect('menu/submenu');
            # code...
        } else {
            // redirect('menu/editMenu');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed Sub Menu Update</div>');
        }
    }

    public function hapusSubmenu($id)
    {
        $data['title'] = 'Delete Sub Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $where = array('id' => $id);
        $this->Menu_model->hapus_submenu($where, 'user_sub_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Succes Delete User Sub Menu</div>');
        redirect('menu/submenu');
    }
}
