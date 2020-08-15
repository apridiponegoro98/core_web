<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembimbing_lapangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        $this->load->helper(array('form', 'url'));
        // $raita = new raita;
        new raita();
        $dictionary = array("");
        $nama = false;
    }
    public function detail_pbl($offset = NULL)
    {
        $dictionary = array("");  //deklarasi untuk running time  
        $Rtime = 0;  //deklarasi untuk jumlah data  
        $Htime = 0;
        $countH = 0;
        $countR = 0;
        $data['title'] = 'Detail PBL';
        // $image['user'] = $this->db->get_where('user', ['image' => $this->session->userdata('image')])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_pbl'] = $this->Menu_model->detail_pbl()->result_array();

        // $data['data_pbl'] = $this->Menu_model->getDataPagination($perpage, $page * $perpage)->result_array();
        if (!isset($_POST['cari'])) {
            // echo "no cari";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $perpage = 6;
            $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
            $total = $this->Menu_model->detail_pbl()->num_rows();
            // $config['total'] = $total;

            if ($total > 0) {
                $this->load->library('pagination');
                $config['base_url'] = base_url() . 'pembimbing_lapangan/detail_pbl';
                $config['total_rows'] = $total;
                $config['per_page'] = $perpage;
                //initialize
                $this->pagination->initialize($config);
                $data['start'] = $this->uri->segment(3);
                $data['data_pbl'] = $this->Menu_model->getDataPagination($config['per_page'], $data['start'])->result_array();
                $this->load->view('data_pbl/detail_pbl', $data);
            }
            // var_dump($total);
            $this->load->view('templates/footer');
        } else if (isset($_POST['cari'])) {
            // $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required|xss_clean');

            $cari = $_POST['stringcari'];
            $data_cari = $this->form_validation->set_rules($cari, 'Judul_pbl', 'trim|required|xss_clean');
            var_dump($cari);
            var_dump($data_cari);
            die;
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

        $cari = $_POST['stringcari'];

        $data_cari = $this->form_validation->set_rules($cari, 'Judul_pbl', 'trim|required|xss_clean');
        var_dump($cari);
        var_dump($data_cari);
        die;


        $start = microtime(true);
        $data['as'] = array();
        $dataR = null;
        new raita;
        $rekam = [];
        $runningtime = [];
        $total = [];
        $bungkus = [];
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

            // $tes = implode(" ", $as);
            // $str = trim($tes, "\t\n\r\x0B\0");
            // $convert_string = preg_replace('/[\W]/', '', $str);

            // var_dump($str);
            // die;
            // die;
            $Tkata = Strlen($convert_string);
            // echo json_encode($totalString);
            $wordsCount = count($convert_string);
            $raita = new raita;

            $result = $raita->search(strtolower(trim($convert_string)), strtolower($data_cari));
            $rekam[] = $result;
            // var_dump($raita->search(strtolower($convert_string), strtolower(trim($_POST['stringcari']))));
            if ($raita->report() == 1) {
                $i = 0;
                $Htime = microtime(true) - $start;
                $runningtime[] = $Htime;
                $total[] = $Tkata;
                $dataR[$i] = $as;
                // $dataR[$as] = $i;
                // var_dump($total);
                // die;
                array_push($data['as'], $as);
            } else {
                // array_push($data['as'], null);
            }
            // $i++;
        }

        $jumlah = array_sum($total);
        $bungkus[] = $jumlah;
        $data["rekams"] = $rekam;
        $data["Run"] = $runningtime;
        $data["data"] = $total;
        $data["jum"] = $bungkus;
        // $data['as'] = array();
        // var_dump($data["Run"]);
        // die;

        $Rtime = microtime(true) - $start;
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">' . $notif . '" "' . $cari . '"yuhhuuu Silahkan Cek dan Liat' . ' </div>');
        $data["key"] = $_POST['stringcari'];
        // redirect('pembimbing_lapangan/detail_pbl');
        $this->load->view('data_pbl/dapat_data', $data);
    }
    public function index()
    {
        $this->load->helper("url");
        $this->load->library('pagination');
        $data['title'] = 'Dashboard Pembimbing Lapangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);

        $perpage = 3;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
        $total = $this->Menu_model->detail_pbl()->num_rows();

        if ($total > 0) {
            $config['base_url'] = base_url() . 'pembimbing_lapangan/index';
            $config['total_rows'] = $total;
            $config['per_page'] = $perpage;
            //initialize
            $this->pagination->initialize($config);
            $data['start'] = $this->uri->segment(3);
            $data['data_pbl'] = $this->Menu_model->getDataPagination($config['per_page'], $data['start'])->result_array();
            $this->load->view('data_pbl/index', $data);
        }
        $this->load->view('templates/footer');
        // $this->load->view('templates/footer');
    }

    public function add_pbl()
    {

        $data['title'] = 'Add PBL';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['menu'] = $this->db->get('user_menu')->result_array();
        // $this->form_validation->set_rules('id_pbl', 'Id_pbl', 'required|trim');
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $new_file = null;
        $this->form_validation->set_rules('nama_kelompok', 'nama_kelompok', 'trim|required|xss_clean');
        // var_dump($this->form_validation->set_rules('nama_kelompok', 'Nama_kelompok', 'trim|required|'));
        // die;
        $this->form_validation->set_rules('judul_pbl', 'Judul_pbl', 'trim|required|xss_clean');
        $this->form_validation->set_rules('desa', 'Desa', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'trim|required|xss_clean');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('berkas', 'Berkas', 'trim|required');

        // var_dump($this->form_validation->run());
        // die;

        if ($this->form_validation->run() == true) {
            $nama_kelompok = $this->input->post('nama_kelompok');
            $judul_pbl = $this->input->post('judul_pbl');
            $desa = $this->input->post('desa');
            $kecamatan = $this->input->post('kecamatan');
            $kabupaten = $this->input->post('kabupaten');
            $tahun = $this->input->post('tahun');
            $keterangan = $this->input->post('keterangan');
            $berkas = $this->input->post('berkas');
            // $upload_file = $_FILES['berkas'];
            var_dump($berkas);
            // die;

            $config['upload_path'] = './assets/data_pbl';
            $config['allowed_types'] = 'pdf|csv|docs';
            $config['max_size'] = '0';
            $config['berkas'] = "upload";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('berkas')) {
                $error = $this->upload->display_errors();
                // menampilkan pesan error
                echo "eror upload";
                print_r($error);
            } else {
                $new_file = $this->upload->data('file_name');
                // $result = $this->db->set('image', $new_file);
                echo "berhasil <br>";
                echo "<pre>";
                var_dump($new_file);
                // die;

                $data = array(
                    'nama_kelompok' => $nama_kelompok,
                    'judul_pbl' => $judul_pbl,
                    'desa' => $desa,
                    'kecamatan' => $kecamatan,
                    'kabupaten' => $kabupaten,
                    'tahun' => $tahun,
                    'keterangan' => $keterangan,
                    'file' => $new_file,
                );
                // var_dump($data);
            }
            $this->Menu_model->add_pbl($data, 'data_pbl');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data PBL dengan Desa <strong>' . $desa . '</strong> Berhasil Ditambahkan</div>');
            redirect('pembimbing_lapangan/detail_pbl');
            // } else {
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data PBL dengan <strong>Gagal</strong>  Ditambahkan</div>');
            redirect('pembimbing_lapangan/detail_pbl');
        }
        // }
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

    public function update_pbl($id_pbl)
    {
        $data['title'] = 'Edit PBL';
        // $data['title'] = 'Welcome Pembibing Lapangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $where = array('id_pbl' => $id_pbl);
        $data['data_pbl'] = $this->Menu_model->update_pbl($where, 'data_pbl')->result();
        // var_dump($data['data_pbl']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_pbl/update_pbl', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id_pbl = $this->input->post('id_pbl');
        // var_dump($id_pbl);
        $this->form_validation->set_rules('nama_kelompok', 'nama_kelompok', 'trim|required|xss_clean');
        // var_dump($this->form_validation->set_rules('nama_kelompok', 'Nama_kelompok', 'trim|required|xss_clean|'));
        // die;
        $this->form_validation->set_rules('judul_pbl', 'Judul_pbl', 'trim|required|xss_clean');
        $this->form_validation->set_rules('desa', 'Desa', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'trim|required|xss_clean');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('berkas', 'Berkas', 'trim|required');

        // var_dump($this->form_validation->run());
        // die;

        if ($this->form_validation->run() == true) {


            $nama_kelompok = $this->input->post('nama_kelompok');
            $judul_pbl = $this->input->post('judul_pbl');
            $desa = $this->input->post('desa');
            $kecamatan = $this->input->post('kecamatan');
            $kabupaten = $this->input->post('kabupaten');
            $tahun = $this->input->post('tahun');
            $keterangan = $this->input->post('keterangan');

            $upload_file = $_FILES['file'];
            if ($upload_file) {
                $config['upload_path'] = './assets/data_pbl';
                $config['allowed_types'] = 'pdf|csv';
                $config['max_size'] = '0';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    $error = $this->upload->display_errors();
                    // menampilkan pesan error
                    echo "eror upload";
                    print_r($error);
                    $data = array(
                        'nama_kelompok' => $nama_kelompok,
                        'judul_pbl' => $judul_pbl,
                        'desa' => $desa,
                        'kecamatan' => $kecamatan,
                        'kabupaten' => $kabupaten,
                        'tahun' => $tahun,
                        'keterangan' => $keterangan,
                        // 'file' => $new_file,
                    );
                } else {

                    $new_file = $this->upload->data('file_name');
                    // var_dump($new_file);
                    // die;
                    $data = array(
                        'nama_kelompok' => $nama_kelompok,
                        'judul_pbl' => $judul_pbl,
                        'desa' => $desa,
                        'kecamatan' => $kecamatan,
                        'kabupaten' => $kabupaten,
                        'tahun' => $tahun,
                        'keterangan' => $keterangan,
                        'file' => $new_file,
                    );
                }
            }

            $this->db->where('id_pbl', $id_pbl);
            $hasil = $this->db->update('data_pbl', $data);

            if ($hasil) {
                # code...
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Desa <strong>' . $desa . '</strong> PBL Succes</div>');
                redirect('pembimbing_lapangan/detail_pbl');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Update Desa <strong>' . $desa . '</strong> PBL FAILED</div>');
                redirect('pembimbing_lapangan/detail_pbl');
            }
            # code...
        } else {
            // redirect('menu/editMenu');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed Update Data PBL</div>');
            redirect('pembimbing_lapangan/detail_pbl');
        }
    }

    public function delete_pbl($id_pbl)
    {
        $data['title'] = 'Delete Data PBL';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where = array('id_pbl' => $id_pbl);
        $this->Menu_model->delete_pbl($where, 'data_pbl');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Succes Delete 1 data PBL</div>');
        redirect('pembimbing_lapangan/detail_pbl');
    }

    public function view_pbl($id_pbl)
    {
        // $data['title'] = 'View Data PBL';
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Succes Delete User Sub Menu</div>');
        // redirect('pembimbing_lapangan/view_pbl');
        $data['title'] = 'View PBL';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where = array('id_pbl' => $id_pbl);
        $data['data_pbl'] = $this->Menu_model->view_pbl($where, 'data_pbl');
        // $image['user'] = $this->db->get_where('user', ['image' => $this->session->userdata('image')])->row_array();
        // echo 'selamat datang ' . $data['user']['name'];
        $this->load->view('templates_user/header', $data);
        $this->load->view('templates_user/sidebar', $data);
        $this->load->view('templates_user/topbar', $data);
        $this->load->view('data_pbl/view_pbl', $data);
        $this->load->view('templates_user/footer');
    }
}
