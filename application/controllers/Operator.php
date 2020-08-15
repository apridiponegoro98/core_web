<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        $this->load->helper(array('url'));
    }
    public function index()
    {
        $this->load->helper("url");
        $this->load->library('pagination');
        $data['title'] = 'Dashboard Operator';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);

        $perpage = 6;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
        $total = $this->Menu_model->data_mahasiswa()->num_rows();

        if ($total > 0) {
            $config['base_url'] = base_url() . 'operator/index';
            $config['total_rows'] = $total;
            $config['per_page'] = $perpage;
            //initialize
            $this->pagination->initialize($config);
            $data['start'] = $this->uri->segment(3);
            $data['data_pbl'] = $this->Menu_model->getDataPaginationOperator($config['per_page'], $data['start'])->result_array();
            $this->load->view('operator/index', $data);
        }
        // $this->load->view('templates/footer');
        $this->load->view('templates/footer');
    }

    public function detail_opr()
    {
        $this->load->helper("url");
        $data['title'] = 'Dashboard Operator';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if (!isset($_POST['cari'])) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);

            $perpage = 6;
            $operator = 4;
            $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
            $total = $this->Menu_model->data_mahasiswa()->num_rows();

            if ($total > 0) {
                $config['base_url'] = base_url() . 'operator/detail_opr';
                $config['total_rows'] = $total;
                $config['per_page'] = $perpage;
                //initialize
                $this->pagination->initialize($config);
                $data['start'] = $this->uri->segment(3);
                $data['data_pbl'] = $this->Menu_model->getDataPaginationOperator($config['per_page'], $data['start'])->result_array();
                $this->load->view('operator/detail_opr', $data);
            }
        } else if (isset($_POST['cari'])) {
            $this->cari_Data($data);
        }
        // $this->load->view('templates/footer');
        $this->load->view('templates/footer');
    }

    private function cari_Data($dari_db)
    {
        $this->load->view('templates/header', $dari_db);
        // $this->load->view('templates_user/sidebar', $dari_db);
        $this->load->view('templates/topbar', $dari_db);
        $notif = "";
        $this->db->order_by('id', 'desc');
        $this->db->select('id');
        if ($_POST['pilih'] == "semua") {
            $notif = "data";
            $this->db->select('name');
            $this->db->select('email');
            $this->db->select('is_active');
        } else if ($_POST['pilih'] == "nama") {
            $notif = "Nama : ";
            $this->db->select('name');
        } else if ($_POST['pilih'] == "email") {
            $notif = "email : ";
            $this->db->select('email');
        } else if ($_POST['pilih'] == "is_active") {
            $notif = "active ";
        } else {
            $this->db->select('is_active');
            echo "nothing";
        }
        $sql =  $this->db->get('user');
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

        $jumlah = array_sum($total);
        $bungkus[] = $jumlah;
        $data["rekams"] = $rekam;
        $data["Run"] = $runningtime;
        $data["data"] = $total;
        $data["jum"] = $bungkus;
        $Rtime = microtime(true) - $start;
        if ($data['as'] == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">' . $notif . '" "' . $_POST['stringcari'] . '" Silahkan Cek dan Liat' . ' </div>');
            $data["key"] = $_POST['stringcari'];
            $this->load->view('operator/dapat_data_opr', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">' . $notif . '"' . $_POST['stringcari'] . '"  Silahkan Cek dan Liat </div>');
            $data["key"] = $_POST['stringcari'];
            $this->load->view('operator/dapat_data_opr', $data);
        }


        // $data["key"] = $_POST['stringcari'];
        // $this->load->view('operator/dapat_data_opr', $data);
    }

    public function add_mahasiswa()
    {
        // $new_file = null;
        // $this->load->library('upload');
        $data['title'] = 'Add mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('image', 'Image', 'required');
        $this->form_validation->set_rules('is_active', 'Is_active', 'required');

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $image = $this->input->post('image');
        $is_active = $this->input->post('is_active');
        // $keterangan = $this->input->post('keterangan');
        //cek image
        $upload_image = $_FILES['image'];

        if ($upload_image) {
            // var_dump($upload_image);
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10024';
            $config['upload_path'] = './assets/img/profile';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                echo "eror upload";
                print_r($error);
            } else {
                $new_image = $this->upload->data('file_name');
            }
            $passwors_hash = password_hash('user', PASSWORD_DEFAULT);
            $data = array(
                'name' => $name,
                'email' => $email,
                'image' => $new_image,
                'password' => $passwors_hash,
                'role_id' => 5,
                'is_active' => $is_active,
                'date_created' => date('Y-m-d H:i:s')
            );
            var_dump($data);
        }
        $this->Menu_model->add_mahasiswa($data, 'user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Mahasiswa Added</div>');
        redirect('operator/index');
    }
    public function update_mahasiswa($id)
    {
        $data['title'] = 'Edit mahasiswa';
        // $data['title'] = 'Welcome Pembibing Lapangan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where = array('id' => $id);
        $data['user'] = $this->Menu_model->update_mahasiswa($where, 'user')->result();
        // var_dump($data['data_pbl']);
        // echo json_encode($data);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('operator/update_mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $is_active = $this->input->post('is_active');
        //cek image
        $upload_image = $_FILES['image'];

        var_dump($id);
        var_dump($name);
        var_dump($email);
        var_dump($is_active);
        // var_dump($upload_image);
        // die;
        // $stok = $this->input->post('stok');
        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10024';
            $config['upload_path'] = './assets/img/profile';

            $this->load->library('upload', $config);

            $new_image = $this->upload->data('file_name');
            if (!$this->upload->do_upload('image')) {
                $old_image = $data['user']['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }
                // var_dump($new_image);
                $new_image = $this->upload->data('file_name');
                $data = array(
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    // 'image' => $new_image,
                    'is_active' => $is_active,
                    // 'date_created' => date('Y-m-d H:i:s'),
                );
                // die;
                // $this->db->set('image', $new_image);
                // var_dump($r);
                // die;
            } else {
                echo $this->upload->display_errors();
                $data = array(
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'image' => $new_image,
                    'is_active' => $is_active,
                    'date_created' => date('Y-m-d H:i:s'),
                );
            }
        }
        // var_dump($data);

        $where = array(
            'id' => $id
        );
        echo "<br>";

        //$hasil = $this->Menu_model->update_data($where, $data, 'user_sub_menu');
        $this->db->set($data);
        $this->db->where($where);
        $hasil =  $this->db->update('user');
        var_dump($hasil);


        if ($hasil) {

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Mahasiswa "' . $name . '" Berhasil Update</div>');
            redirect('operator/index');
            # code...
        } else {
            // redirect('menu/editMenu');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Update tidak berhasil</div>');
        }
    }

    public function view_mhs($id)
    {
        $data['title'] = 'Lihat Detail Mahasiswa';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where = array('id' => $id);
        // var_dump($where);
        // die;
        // $this->Menu_model->view_pbl($where, 'data_pbl');
        $data['user'] = $this->Menu_model->view_mahasiswa()($where, 'user');
        // $image['user'] = $this->db->get_where('user', ['image' => $this->session->userdata('image')])->row_array();
        // echo 'selamat datang ' . $data['user']['name'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data_pbl/view_mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function delete_mahasiswa($id)
    {
        $data['title'] = 'Delete Data Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where = array('id' => $id);
        $this->Menu_model->delete_mahasiswa($where, 'user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Succes Delete ID="' . $id . '" data PBL</div>');
        redirect('operator/index');
    }
}
