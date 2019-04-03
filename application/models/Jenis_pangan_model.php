<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_pangan_model extends CI_Model
{

    public $table = 'jenis_pangan';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,nama');
        $this->datatables->from('jenis_pangan');
        //add this line for join
        //$this->datatables->join('table2', 'jenis_pangan.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('jenis_pangan/update/$1'),'Perbarui')." | ".anchor(site_url('jenis_pangan/Hapus/$1'),'Delete','onclick="javasciprt: return confirm(\'Apakah Anda Yakin ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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
    function autocomplate($nama){
        $this->db->like('nama', $nama , 'both');
        $this->db->order_by($this->id, $this->order);
        $this->db->limit(10);
        return $this->db->get($this->table)->result();
    }

}

/* End of file Jenis_pangan_model.php */
/* Location: ./application/models/Jenis_pangan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-15 10:06:14 */
/* http://harviacode.com */