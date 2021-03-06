<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembanding_model extends CI_Model
{

    public $table = 'pembanding';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    function get_allmap($limit, $start = 0, $q = NULL)
    {
        $return = array();
        $this->db->select('*');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->like('alamat', $q);
        $this->db->like('kategoriharga', $q);
        $this->db->like('harga', $q);
        $this->db->like('jenisdata', $q);
        $this->db->like('tahundata', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
        //$query = $this->db->get($this->table);
        //if ($query->num_rows()>0) {
        //    foreach ($query->result() as $row) {
        //        array_push($return, $row);
        //    }
        //}
        //return $return;

    }
    function get_allmapcount($tahundata=NULL,$jenisdata = NULL, $kategoriharga = NULL, $q = NULL)
    {
        $this->db->cache_delete_all();
        $this->db->order_by($this->id, $this->order); 
        // $where = "lat IS NOT NULL";
        // $this->db->where($where);
        $this->db->like('tahundata', $tahundata);
        $this->db->like('kategoriharga', $kategoriharga);
        $this->db->like('jenisdata', $jenisdata);
        $this->db->like('alamat', $q);  $this->db->from($this->table);

        return $this->db->count_all_results();
    }
    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
	}

    // mengambil data pembanding berdasarkan nomor laporan penilaian
    function get_by_kode($code)
    {
        $this->db->where('nolaporan', $code);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    // get total rows
    function total_rows($tahundata=NULL,$jenisdata = NULL, $kategoriharga = NULL,$propinsi = 0, $q = NULL) {
	//$this->db->cache_delete_all();
    $this->db->order_by($this->id, $this->order);
    if($propinsi != ''){$this->db->where('lokasipropinsi', $propinsi);}
    $this->db->like('tahundata', $tahundata);
    $this->db->like('kategoriharga', $kategoriharga);
    $this->db->like('jenisdata', $jenisdata);
    $this->db->like('nolaporan',$q);
    //$this->db->like('alamat', $q);
    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $tahundata = NULL,$jenisdata = NULL, $kategoriharga = NULL, $propinsi = 0, $q = NULL) {
	//$this->db->cache_delete_all();
    if($propinsi != ''){$this->db->where('lokasipropinsi', $propinsi);}
    $this->db->like('tahundata', $tahundata);
    $this->db->like('kategoriharga', $kategoriharga);
    $this->db->like('jenisdata', $jenisdata);
    $this->db->like('nolaporan',$q);
    //$this->db->like('alamat', $q);
    $this->db->order_by('id','DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get('pembanding');
    return $query->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Pembanding_model.php */
/* Location: ./application/models/Pembanding_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-01-09 06:08:28 */
/* http://harviacode.com */