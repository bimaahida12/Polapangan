<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pangan_keluarga_model extends CI_Model
{

    public $table = 'pangan_keluarga';
    public $id = 'pangan_keluarga.id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($id) {
        $this->datatables->select('id,nama,DATE_FORMAT(tgl, "%a %D %M %Y") as tgl,keterangan,jumlah_pemakan,keluarga_id');
        $this->datatables->from('pangan_keluarga');
        $this->datatables->where('keluarga_id',$id);
        //add this line for join
        //$this->datatables->join('table2', 'pangan_keluarga.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('detail_pangan_keluarga/detail_pangan/$1/'.$id),'Detail Pangan')." | ".anchor(site_url('pangan_keluarga/update/$1/'.$id),'Ubah')." | ".anchor(site_url('pangan_keluarga/delete/$1/'.$id),'Hapus','onclick="javasciprt: return confirm(\'Apakah anda yakin ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all($keluarga)
    {
        $this->db->select('tgl,keterangan,pangan_keluarga.nama as makanan,pangan.nama as jenis,detail_pangan_keluarga.urt,berat,asal,jumlah_pemakan,rata_rata_berat');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('keluarga_id',$keluarga);
        $this->db->join('detail_pangan_keluarga','pangan_keluarga.id = detail_pangan_keluarga.pangan_keluarga_id');
        $this->db->join('pangan','detail_pangan_keluarga.pangan_id = pangan.id');
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
	$this->db->or_like('tgl', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('jumlah_pemakan', $q);
	$this->db->or_like('keluarga_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('tgl', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('jumlah_pemakan', $q);
	$this->db->or_like('keluarga_id', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
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

/* End of file Pangan_keluarga_model.php */
/* Location: ./application/models/Pangan_keluarga_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-15 13:24:39 */
/* http://harviacode.com */