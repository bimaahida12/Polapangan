<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keluarga_model extends CI_Model
{

    public $table = 'keluarga';
    public $id = 'keluarga.id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,no_keluarga,kepala_keluarga,alamat,provinsi,kab,kec,desa,rt,rw,kode_pos,latitude,longitude');
        $this->datatables->from('keluarga');
        //add this line for join
        //$this->datatables->join('table2', 'keluarga.field = table2.field');
        $this->datatables->add_column('action', anchor(base_url('pangan_keluarga/data_pangan/$1'),'Pangan')." | ".anchor(base_url('user_keluarga/index/$1'),'Anggota Keluarga')." | ".anchor(base_url('keluarga/read/$1'),'Detail')." | ".anchor(site_url('keluarga/update/$1'),'Ubah')." | ".anchor(site_url('keluarga/delete/$1'),'Hapus','onclick="javasciprt: return confirm(\'Apakah anda yakin ?\')"'), 'id');
        return $this->datatables->generate();
    }
    function json_penyuluh($penyuluh) {
        $this->datatables->select('id,no_keluarga,kepala_keluarga,alamat,provinsi,kab,kecamatan.kec_nama as kec,desa.nama_desa as desa,rt,rw,kode_pos,latitude,longitude');
        $this->datatables->from('keluarga');
        $this->datatables->where('penyuluh_id',$penyuluh);
        //add this line for join
        $this->datatables->join('kecamatan', 'keluarga.kec = kecamatan.kec_id');
        $this->datatables->join('desa', 'keluarga.desa = desa.id_desa');
        $this->datatables->add_column('action', anchor(base_url('pangan_keluarga/data_pangan/$1'),'Pangan')." | ".anchor(base_url('user_keluarga/index/$1'),'Anggota Keluarga')." | ".anchor(base_url('keluarga/read/$1'),'Detail')." | ".anchor(site_url('keluarga/update/$1'),'Ubah')." | ".anchor(site_url('keluarga/delete/$1'),'Hapus','onclick="javasciprt: return confirm(\'Apakah anda yakin ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_desa($penyuluh){
        $this->db->select('desa');
        $this->db->distinct();
        $this->db->where('penyuluh_id',$penyuluh);
        $this->db->order_by('desa', $this->order);
        return $this->db->get($this->table)->result();
    }
    
    function autocomplate($params){
        $this->db->like('kepala_keluarga', $params , 'both');
        $this->db->order_by($this->id, $this->order);
        $this->db->limit(10);
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
	$this->db->or_like('no_keluarga', $q);
	$this->db->or_like('kepala_keluarga', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('provinsi', $q);
	$this->db->or_like('kab', $q);
	$this->db->or_like('kec', $q);
	$this->db->or_like('desa', $q);
	$this->db->or_like('rt', $q);
	$this->db->or_like('rw', $q);
	$this->db->or_like('kode_pos', $q);
	$this->db->or_like('latitude', $q);
	$this->db->or_like('longitude', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('no_keluarga', $q);
	$this->db->or_like('kepala_keluarga', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('provinsi', $q);
	$this->db->or_like('kab', $q);
	$this->db->or_like('kec', $q);
	$this->db->or_like('desa', $q);
	$this->db->or_like('rt', $q);
	$this->db->or_like('rw', $q);
	$this->db->or_like('kode_pos', $q);
	$this->db->or_like('latitude', $q);
	$this->db->or_like('longitude', $q);
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

}

/* End of file Keluarga_model.php */
/* Location: ./application/models/Keluarga_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-16 16:10:52 */
/* http://harviacode.com */