<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
    }

    public function index()
    {
        // $data['title'] = 'My Profile';

        $this->load->helper("url");
        $this->load->library('pagination');
        $data['title'] = 'Welcome mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);

        $perpage = 5;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
        $total = $this->Menu_model->detail_pbl()->num_rows();

        if ($total > 0) {


            // $data['data_pbl'] = $this->Menu_model->getDataPagination($perpage, $page * $perpage)->result_array();
            $config['base_url'] = base_url() . 'mahasiswa/index';
            $config['total_rows'] = $total;
            $config['per_page'] = $perpage;
            //initialize
            $this->pagination->initialize($config);
            $data['start'] = $this->uri->segment(3);
            $data['data_pbl'] = $this->Menu_model->getDataPagination($config['per_page'], $data['start'])->result_array();
            $this->load->view('mahasiswa/index', $data);
        }
        $this->load->view('templates/footer');
        // $this->load->view('templates/footer');
    }
    public function detail_pbl_mhs($offset = NULL)
    {
        $data['title'] = 'Detail PBL Mahasiswa';
        // $image['user'] = $this->db->get_where('user', ['image' => $this->session->userdata('image')])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['data_pbl'] = $this->Menu_model->detail_pbl()->result_array();
        // $data['data_pbl'] = $this->Menu_model->getDataPagination($perpage, $page * $perpage)->result_array();
        if (!isset($_POST['cari'])) {
            // echo "no cari";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            // $this->load->view('data_pbl/detail_pbl', $data);

            $perpage = 5;
            $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
            $total = $this->Menu_model->detail_pbl()->num_rows();
            // $config['total'] = $total;

            if ($total > 0) {


                $data['data_pbl'] = $this->Menu_model->getDataPagination($perpage, $page * $perpage)->result_array();
                $config['base_url'] = base_url() . 'mahasiswa/index';
                $config['total_rows'] = $total;
                $config['per_page'] = $perpage;
                $config['uri_segment'] = 3;

                //paging configuration
                $config['num_links'] = 3;
                $config['use_page_numbers'] = TRUE;
                $config['reuse_query_string'] = TRUE;

                //bootstrap pagination 
                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';
                $config['first_link'] = '&laquo; First <br>';
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $config['last_link'] = 'Last &raquo <br>';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';
                $config['next_link'] = 'Next <br>';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '<li>';
                $config['prev_link'] = 'Prev <br>';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '<li>';
                $config['cur_tag_open'] = '<li class="active"><a href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';

                $this->pagination->initialize($config);

                $params['links'] = $this->pagination->create_links();
                // $offset = $this->uri->segment(3);
                // $data["links"] = $this->pagination->initialize($config);

                // die;
                $this->load->view('mahasiswa/detail_pbl_mhs', $data);
            }
            // var_dump($total);
            $this->load->view('templates/footer');
            // $this->highlightKeywords($text, $keyword);
        } else if (isset($_POST['cari'])) {
            $this->cari_Data($data);
        }
    }
    private function cari_Data($dari_db)
    {
        $this->load->view('templates_user/header', $dari_db);
        // $this->load->view('templates_user/sidebar', $dari_db);
        $this->load->view('templates_user/topbar', $dari_db);
        $notif = "";
        if ($_POST['pilih'] == "semua") {
            $notif = "data";
            $this->db->order_by('id_pbl', 'desc');
            $this->db->select('id_pbl');
            $this->db->select('nama_kelompok');
            $this->db->select('judul_pbl');
            $this->db->select('desa');
            $this->db->select('kecamatan');
            $this->db->select('kabupaten');
            $this->db->select('tahun');
            $this->db->select('keterangan');
            $sql =  $this->db->get('data_pbl');
        } else if ($_POST['pilih'] == "nama_kelompok") {
            $notif = "Nama : ";
            $this->db->order_by('id_pbl', 'desc');
            $this->db->select('id_pbl');
            $this->db->select('nama_kelompok');
            $sql =  $this->db->get('data_pbl');
        } else if ($_POST['pilih'] == "judul") {
            $notif = "Judul : ";
            $this->db->select('id_pbl');
            $this->db->select('judul_pbl');
            $sql =  $this->db->get('data_pbl');
        } else if ($_POST['pilih'] == "desa") {
            $notif = "Desa/ Kelurahan : ";
            $this->db->select('id_pbl');
            $this->db->select('desa');
            $sql =  $this->db->get('data_pbl');
        } else if ($_POST['pilih'] == "kecamatan") {
            $notif = "Kecamatan ";
            $this->db->select('id_pbl');
            $this->db->select('kecamatan');
            $sql =  $this->db->get('data_pbl');
        } else if ($_POST['pilih'] == "kabupaten") {
            $notif = "Kabupaten : ";
            $this->db->select('id_pbl');
            $this->db->select('kabupaten');
            $sql =  $this->db->get('data_pbl');
        } else if ($_POST['pilih'] == "tahun") {
            $notif = "Tahun : ";
            $this->db->select('id_pbl');
            $this->db->select('tahun');
            $sql =  $this->db->get('data_pbl');
        } else if ($_POST['pilih'] == "keterangan") {
            $notif = "Pencarian";
            $this->db->select('id_pbl');
            $this->db->select('keterangan');
            $sql =  $this->db->get('data_pbl');
        }

        // die;
        // $query = $this->db->query("SELECT * FROM data_pbl WHERE " . implode(" OR ", $b)); //Untuk kesalahan kedua
        $start = microtime(true);
        $data['as'] = array();
        $dataR = null;
        new raita;
        $rekam = [];
        $runningtime = [];
        $total = [];
        $bungkus = [];
        $i = 0;
        $jumlah = 0;
        foreach ($sql->result_array() as $as) {
            // $countR = count($as);
            $dataH = array("");
            $dataR = array("");
            $i = 0;    //memulai hitungan waktu untuk raita   
            $j = 0;    //memulai hitungan waktu untuk raita   
            //deklarasi untuk running time  
            $Htime = 0;
            $Tkata = 0;
            $Rtime = 0;
            //deklarasi untuk jumlah data  
            $countH = 0;
            $countR = 0;
            $convert_string = implode(" ", $as);
            $Tkata = Strlen($convert_string);
            // echo json_encode($totalString);

            $wordsCount = count($convert_string);
            $raita = new raita;
            $result = $raita->search(strtolower($convert_string), strtolower(trim($_POST['stringcari'])));
            $rekam[] = $result;
            // var_dump($raita->search(strtolower($convert_string), strtolower(trim($_POST['stringcari']))));
            if ($raita->report() == 1) {
                $Htime = microtime(true) - $start;
                $runningtime[] = $Htime;
                $total[] = $Tkata;
                $dataR[$i] = $as;
                array_push($data['as'], $as);
                // var_dump($total);
            }
            $i++;
        }
        $jumlah = array_sum($as);
        $bungkus[] = $jumlah;
        $data["rekams"] = $rekam;
        $data["Run"] = $runningtime;
        $data["data"] = $total;
        $data["jum"] = $bungkus;
        //        die;

        $Rtime = microtime(true) - $start;

        $data["key"] = $_POST['stringcari'];
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">' . $notif . '"' . $_POST['stringcari'] . '"  Silahkan Cek dan Liat </div>');
        // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $notif . ' "' . $_POST['stringcari'] . '" Tidak ditemukan</div>');
        // redirect('mahasiswa/index');
        $this->load->view('mahasiswa/dapat_pbl_mhs', $data);
    }
    public function view_pbl_mhs($id_pbl)
    {
        $data['title'] = 'View PBL';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where = array('id_pbl' => $id_pbl);

        $data['data_pbl'] = $this->Menu_model->view_pbl($where, 'data_pbl');

        $this->load->view('templates_user/header', $data);
        $this->load->view('templates_user/sidebar', $data);
        $this->load->view('templates_user/topbar', $data);
        $this->load->view('mahasiswa/view_pbl_mhs', $data);
        $this->load->view('templates_user/footer');
    }

    public function download($id)
    {
        $this->load->helper('download');
        // var_dump($this->load->helper('download'));
        // die;
        $fileinfo = $this->Menu_model->download($id);
        $file = 'assets/data_pbl/' . $fileinfo['file'];

        var_dump($fileinfo);
        var_dump($file);
        force_download($file, null);
        // redirect('pembimbing_lapangan/detail_pbl');
    }
}
