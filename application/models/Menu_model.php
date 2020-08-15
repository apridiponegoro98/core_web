<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT user_sub_menu.*, user_menu.menu 
                FROM user_sub_menu JOIN user_menu
                ON user_sub_menu.menu_id = user_menu.id
                ";

        return $this->db->query($query)->result_array();
    }
    public function count_all()
    {
        return $this->db->count_all('siswa'); // Untuk menghitung semua data siswa
    }

    //paginatiom
    public function getDataPagination($limit, $offset)
    {
        $this->db->select('*');
        $this->db->from('data_pbl');
        $this->db->order_by('id_pbl', 'DESC');
        $this->db->limit($limit, $offset);

        return $this->db->get();
    }
    public function getDataPaginationInformasi($limit, $offset)
    {
        $this->db->select('*');
        $this->db->from('data_info');
        $this->db->order_by('id_info', 'DESC');
        $this->db->limit($limit, $offset);

        return $this->db->get();
    }

    public function detail_info()
    {
        $this->db->order_by('id_info', 'desc');
        // return $this->db->get('product')->result();

        return $this->db->get('data_info');
    }


    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('data_pbl');
        $this->db->order_by('id_pbl', 'ASC');

        return $this->db->get();
    }

    //menu management
    public function tampil_management()
    {
        return $this->db->get('user_menu');
    }
    public function insert_management($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function edit_management($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function update_management($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);


        // $this->db->set('$data', $data);
        // $this->db->where('id', $id);
        // $hasil =  $this->db->update('user_menu');
    }


    // menu sub management
    public function tampil_data()
    {
        // $this->load->model('Menu_model', 'menu');
        // $this->menu->getSubMenu('subMenu');
        // $this->db->get('user_menu');
        return $this->db->get('user_menu');
    }
    public function edit_barang($where, $table)
    {
        $this->Menu_model->getSubMenu('menu');
        return $this->db->get_where($table, $where);
    }
    public function update_data($where, $data, $table)
    {
        // $this->db->where($where);
        $this->db->update('data_pbl', $data, $where);
        // return $this->db->get_where($table, $where);
    }

    public function hapus_submenu($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    //MENU PBL
    public function detail_pbl()
    {
        $this->db->order_by('id_pbl', 'desc');
        // return $this->db->get('product')->result();

        return $this->db->get('data_pbl');
    }
    public function update_pbl($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function add_pbl($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function delete_pbl($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function view_pbl($where, $table)
    {
        // $this->db->where($where);
        return $this->db->get_where($table, $where)->result_array();

        // $this->db->order_by('id_pbl', 'desc');
        // // // return $this->db->get('product')->result();

        // return $this->db->get('data_pbl');
    }

    //cari data
    public function cari_pbl()
    {
        $this->db->order_by('id_pbl', 'desc');
        // return $this->db->get('product')->result();

        return $this->db->get('data_pbl');
    }

    //download file
    public function download($id)
    {
        $query = $this->db->get_where('data_pbl', array('id_pbl' => $id));
        return $query->row_array();
    }

    //OPERATOR

    public function getDataPaginationOperator($limit, $offset)
    {
        $this->db->select('id');
        $this->db->select('name');
        $this->db->select('email');
        $this->db->select('image');
        $this->db->select('is_active');
        $this->db->select('date_created');
        // $this->db->select('password');
        $this->db->from('user');
        $this->db->where('role_id', 5);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);

        return $this->db->get();
    }

    public function data_mahasiswa()
    {
        $this->db->order_by('id', 'desc');
        $this->db->select('name');
        $this->db->select('date_created');
        $this->db->where('role_id', 5);
        // return $this->db->get('product')->result();

        return $this->db->get('user');
    }
    public function add_mahasiswa($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function update_mahasiswa($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function view_mahasiswa($where, $table)
    {
        // $this->db->where($where);
        return $this->db->get_where($table, $where)->result_array();

        // $this->db->order_by('id_pbl', 'desc');
        // // // return $this->db->get('product')->result();

        // return $this->db->get('data_pbl');
    }
    public function delete_mahasiswa($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    //membuat berita
    public function get_all_tulisan()
    {
        return $this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan ORDER BY tulisan_id DESC");
    }
    public function simpan_tulisan($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function get_tulisan_by_kode($kode)
    {
        return $this->db->query("SELECT tbl_tulisan.*,DATE_FORMAT(tulisan_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_tulisan where tulisan_id='$kode'");
    }

    //membuat kategori
    function get_all_kategori()
    {
        return $this->db->query("select * from tbl_kategori");
    }
}
