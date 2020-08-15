<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        // $data['title'] = 'Welcome Pembibing Lapangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $image['user'] = $this->db->get_where('user', ['image' => $this->session->userdata('image')])->row_array();
        // echo 'selamat datang ' . $data['user']['name'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $image['user'] = $this->db->get_where('user', ['image' => $this->session->userdata('image')])->row_array();
        // echo 'selamat datang ' . $data['user']['name'];

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek image
            $upload_image = $_FILES['image'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10024';
                $config['upload_path'] = './assets/img/profile';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }


                    $new_image = $this->upload->data('file_name');
                    // var_dump($new_image);
                    // die;
                    $this->db->set('image', $new_image);
                    // var_dump($r);
                    // die;
                } else {
                    echo $this->upload->display_errors();
                }
            }
            // var_dump($upload_image);
            // die;    

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your Profil has been updated</div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $image['user'] = $this->db->get_where('user', ['image' => $this->session->userdata('image')])->row_array();
        // echo 'selamat datang ' . $data['user']['name'];

        $this->form_validation->set_rules('current_password', 'Current_password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            //kalau data salah
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            //apabila form pengisian terisi
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) { //pengecekan password sebelumnya
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password</div>');
                redirect('user/changepassword');
            } else { //apabila password tidak sama
                if ($current_password == $new_password) {
                    //apabila password yang baru sama dengan password yang akan diganti
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password cannot be the same as curretn password</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah oke
                    $passwors_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $passwors_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Change</div>');
                    redirect('user');
                }
            }
        }
    }
    // public function detail_pbl()
    // {
    //     $data['title'] = 'Detail PBL';
    //     // $data['title'] = 'Welcome Pembibing Lapangan';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     // $image['user'] = $this->db->get_where('user', ['image' => $this->session->userdata('image')])->row_array();
    //     // echo 'selamat datang ' . $data['user']['name'];
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates_user/topbar', $data);
    //     $this->load->view('data_pbl/detail_pbl', $data);
    //     $this->load->view('templates_user/footer');
    // }
}

// class Mahasiswa extends CI_Controller
// {
//     public function editMHS()
//     {
//         $data['title'] = 'Edit Profile';
//         $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
//     }
//     public function TambahMHS()
//     {
//         $data['title'] = 'Tambah data';
//     }
//     public function HapusMHS()
//     {
//         $data['title'] = 'Hapus data';

//     }
//     public function changePassword()
//     {
//         $data['title'] = 'Ganti Password';
//     }
// }
