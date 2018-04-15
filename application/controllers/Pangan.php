<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pangan extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Pangan_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');

        $this->render['page_title'] = 'Makanan';
        $this->render['menus'] = 'pangan';
    }

    public function index(){
        $this->render['content']= $this->load->view('pangan/pangan_list', array(), TRUE);
        $this->load->view('template', $this->render);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Pangan_model->json();
    }

    public function getJenisAutoComplate(){
        $this->load->model('Jenis_pangan_model');
        if (isset($_GET['term'])) {
            $result = $this->Jenis_pangan_model->autocomplate($_GET['term']);
            if (count($result) > 0) {
                //echo json_encode($result);
                foreach ($result as $row)
                $data[] = array(
                    'label' => $row->nama,
                    'value' => $row->id
                );
                echo json_encode($data);
            }
        }
        
    }

    public function read($id) {
        $row = $this->Pangan_model->get_by_id($id);
        if ($row) {
            $data = array(
            'id' => $row->id,
            'nama' => $row->nama,
            'jenis_pangan_id' => $row->id_jenis,
            'jenis_pangan' => $row->jenis_pangan
        );
            $this->render['content']= $this->load->view('pangan/pangan_read', $data, TRUE);
            $this->load->view('template', $this->render);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pangan'));
        }
    }

    public function create(){
        $data = array(
            'button' => 'Create',
            'action' => site_url('pangan/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'jenis_pangan_id' => set_value('jenis_pangan_id'),
            'jenis_pangan' => set_value('jenis_pangan'),
        );
        $this->render['content']= $this->load->view('pangan/pangan_form', $data, TRUE);
        $this->load->view('template', $this->render);
    }
    
    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
            'nama' => $this->input->post('nama',TRUE),
            'jenis_pangan_id' => $this->input->post('jenis_pangan_id',TRUE),
            );

            $this->Pangan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pangan'));
        }
    }
    
    public function update($id) {
        $row = $this->Pangan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pangan/update_action'),
                'id' => set_value('id', $row->id),
                'nama' => set_value('nama', $row->nama),
                'jenis_pangan_id' => set_value('jenis_pangan_id', $row->id_jenis),
                'jenis_pangan' => $row->jenis_pangan
            );
            $this->render['content']= $this->load->view('pangan/pangan_form', $data, TRUE);
            $this->load->view('template', $this->render);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pangan'));
        }
    }
    
    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'jenis_pangan_id' => $this->input->post('jenis_pangan_id',TRUE),
	    );

            $this->Pangan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pangan'));
        }
    }
    
    public function delete($id) {
        $row = $this->Pangan_model->get_by_id($id);

        if ($row) {
            $this->Pangan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pangan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pangan'));
        }
    }

    public function _rules() {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('jenis_pangan_id', 'jenis pangan id', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel(){
        $this->load->helper('exportexcel');
        $namaFile = "pangan.xls";
        $judul = "pangan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Pangan Id");

	foreach ($this->Pangan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jenis_pangan_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Pangan.php */
/* Location: ./application/controllers/Pangan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-15 10:06:14 */
/* http://harviacode.com */