<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_informasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper(array('url'));
        $this->load->model('Menu_model');
        $this->load->library('upload');
    }


    public function index()
    {
        $data['title'] = 'Data Informasi PBL';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data'] = $this->Menu_model->get_all_tulisan()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('view_data_info/index', $data);
        $this->load->view('templates/footer');
    }


    function buat_berita()
    {
        $data['title'] = 'Tambah Informasi PBL';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data'] = $this->Menu_model->get_all_kategori()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('view_data_info/buat_berita.php', $data);
        $this->load->view('templates/footer');
    }

    function simpan_tulisan()
    {
        $judul = $this->input->post('judul');
        $isi = $this->input->post('isi');
        // $pilih = $this->input->post('pilih');
        $image = $this->input->post('image');
        $data['title'] = 'Simpan Informasi PBL';
        // $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $config['upload_path'] = './assets/images/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('image')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            echo "eror upload";
            print_r($error);
        } else {
            echo "berhasil";
            $new_file = $this->upload->data();
            //Compress Image
            // $gbr = $this->upload->data();
            //Compress Image
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/images/' . $new_file['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 710;
            $config['height'] = 460;
            $config['new_image'] = './assets/images/' . $new_file['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $gambar = $new_file['file_name'];
            // $result = $this->db->set('image', $new_file);
            echo "berhasil <br>";
            echo "<pre>";
            $kategori_id = strip_tags($this->input->post('pilih'));
            $id_kategori = $this->db->query("select * from tbl_kategori where kategori_id='$kategori_id'");
            $q = $id_kategori->row_array();

            $kategori_nama = $q['kategori_nama'];
            //ambil data user
            $id = $this->session->userdata('id');
            $user = $this->db->query("SELECT * FROM user where id='$id'");
            $p = $user->row_array();
            $user_id = $p['id'];
            $user_nama = $p['name'];
            $data = array(
                'tulisan_judul' => $judul,
                'tulisan_isi' => $isi,
                'tulisan_kategori_id' => $kategori_id,
                'tulisan_kategori_nama' => $kategori_nama,
                'tulisan_views' => '0',
                'tulisan_pengguna_id' => $user_id,
                'tulisan_author' => $user_nama,
                'tulisan_img_slider' => $gambar,
                'tulisan_slug' => strtolower(str_replace(" ", "-", $isi)),
            );
            // var_dump($data);
            // die;
        }
        $cek = $this->Menu_model->simpan_tulisan($data, 'tbl_tulisan');

        if ($cek) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berita <strong>Berhasil</strong> Ditambahkan</div>');
            redirect('data_informasi');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data berita <strong>TIDAK Berhasil</strong> Ditambahkan</div>');
            redirect('data_informasi/buat_berita');
        }
    }



    public function edit_tulisan()
    {
        $data['title'] = 'Tambah Informasi PBL';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $this->uri->segment(3);
        $data['data'] = $this->Menu_model->get_tulisan_by_kode($id)->result_array();
        $data['Datakategori'] = $this->Menu_model->get_all_kategori()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('view_data_info/edit_tulisan', $data);
        $this->load->view('templates/footer', $data);
    }


    function update_tulisan()
    {

        $config['upload_path'] = './assets/images/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $this->upload->initialize($config);
        if (!empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('filefoto')) {
                echo "data ada";
                // $gbr = $this->upload->data();
                //Compress Image
                // $config['image_library'] = 'gd2';
                // $config['source_image'] = './assets/images/' . $gbr['file_name'];
                // $config['create_thumb'] = FALSE;
                // $config['maintain_ratio'] = FALSE;
                // $config['quality'] = '60%';
                // $config['width'] = 710;
                // $config['height'] = 460;
                // $config['new_image'] = './assets/images/' . $gbr['file_name'];
                // $this->load->library('image_lib', $config);
                // $this->image_lib->resize();

                // $gambar = $gbr['file_name'];
                // $tulisan_id = $this->input->post('kode');
                // $judul = strip_tags($this->input->post('xjudul'));
                // $isi = $this->input->post('xisi');
                // $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $judul);
                // $trim     = trim($string);
                // $slug     = strtolower(str_replace(" ", "-", $trim));
                // $kategori_id = strip_tags($this->input->post('xkategori'));
                // $data = $this->m_kategori->get_kategori_byid($kategori_id);
                // $q = $data->row_array();
                // $kategori_nama = $q['kategori_nama'];
                // //$imgslider=$this->input->post('ximgslider');
                // $imgslider = '0';
                // $kode = $this->session->userdata('idadmin');
                // $user = $this->m_pengguna->get_pengguna_login($kode);
                // $p = $user->row_array();
                // $user_id = $p['pengguna_id'];
                // $user_nama = $p['pengguna_nama'];
                // $this->m_tulisan->update_tulisan($tulisan_id, $judul, $isi, $kategori_id, $kategori_nama, $imgslider, $user_id, $user_nama, $gambar, $slug);
                // echo $this->session->set_flashdata('msg', 'info');
                // redirect('admin/tulisan');
            } else {
                echo "data tidak ada yang mau diupload";
                // echo $this->session->set_flashdata('msg', 'warning');
                // redirect('admin/pengguna');
            }
        } else {
            echo "data kosong";
            // $tulisan_id = $this->input->post('kode');
            // $judul = strip_tags($this->input->post('xjudul'));
            // $isi = $this->input->post('xisi');
            // $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $judul);
            // $trim     = trim($string);
            // $slug     = strtolower(str_replace(" ", "-", $trim));
            // $kategori_id = strip_tags($this->input->post('xkategori'));
            // $data = $this->m_kategori->get_kategori_byid($kategori_id);
            // $q = $data->row_array();
            // $kategori_nama = $q['kategori_nama'];
            // //$imgslider=$this->input->post('ximgslider');
            // $imgslider = '0';
            // $kode = $this->session->userdata('idadmin');
            // $user = $this->m_pengguna->get_pengguna_login($kode);
            // $p = $user->row_array();
            // $user_id = $p['pengguna_id'];
            // $user_nama = $p['pengguna_nama'];
            // $this->m_tulisan->update_tulisan_tanpa_img($tulisan_id, $judul, $isi, $kategori_id, $kategori_nama, $imgslider, $user_id, $user_nama, $slug);
            // echo $this->session->set_flashdata('msg', 'info');
            // redirect('admin/tulisan');
        }
    }


    function hapus_tulisan()
    {
        $kode = $this->input->post('kode');
        $gambar = $this->input->post('gambar');
        $path = './assets/images/' . $gambar;
        unlink($path);
        $this->m_tulisan->hapus_tulisan($kode);
        echo $this->session->set_flashdata('msg', 'success-hapus');
        redirect('admin/tulisan');
    }
}
