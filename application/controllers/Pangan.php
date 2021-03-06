<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('acl');
        
        $data = $this->session->userdata('auth');
        $status = $data['status'];
        if (! $this->acl->is_public('pangan'))
        {
            if (! $this->acl->is_allowed('pangan', $status))
            {
                redirect('auth/logout','refresh');
            }
        }
        $this->load->model('Pangan_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
        $this->render['page_title'] = 'Pangan';
        $this->render['menus'] = 'pangan';
        
    }

    public function index()
    {
        $this->render['content']= $this->load->view('pangan/pangan_list',array(), TRUE);
        $this->load->view('template', $this->render);
    } 
    public function get_autocomplate(){
        if (isset($_GET['term'])) {
            $result = $this->Pangan_model->get_by_name($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label' => $row->nama,
                        'id'   => $row->id,
                 );
                    echo json_encode($arr_result);
            }
        }
    }
    
    public function json() {
        header('Content-Type: application/json');
        if ($this->session->userdata('auth')['status'] == 1) {
            echo $this->Pangan_model->json();   
        }else{
            echo $this->Pangan_model->json_penyuluh();
        }
    }

    public function read($id) 
    {
        $row = $this->Pangan_model->get_by_id($id);
        if ($row) {
            $data = array(
            'id' => $row->id,
            'nama' => $row->nama,
            'takaran' => $row->takaran,
            'urt' => $row->urt,
            'gram' => $row->gram,
            'kalori' => $row->kalori,
            'lemak' => $row->lemak,
            'karbohidrat' => $row->karbohidrat,
            'protein' => $row->protein,
            'jenis_pangan' => $row->jenis_pangan,
            );
            $this->render['content']= $this->load->view('pangan/pangan_read', $data, TRUE);
            $this->load->view('template', $this->render);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pangan'));
        }
    }

    public function create() 
    {
        $this->load->model('Jenis_pangan_model');
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('pangan/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'takaran' => set_value('takaran'),
            'urt' => set_value('urt'),
            'gram' => set_value('gram'),
            'kalori' => set_value('kalori'),
            'lemak' => set_value('lemak'),
            'karbohidrat' => set_value('karbohidrat'),
            'protein' => set_value('protein'),
            'jenis_pangan_id' => set_value('jenis_pangan_id'),
        );
        
        $data['jenis'] = $this->Jenis_pangan_model->get_all();
        $this->render['content']= $this->load->view('pangan/pangan_form', $data, TRUE);
        $this->load->view('template', $this->render);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
            'nama' => $this->input->post('nama',TRUE),
            'takaran' => $this->input->post('takaran',TRUE),
            'urt' => $this->input->post('urt',TRUE),
            'gram' => $this->input->post('gram',TRUE),
            'kalori' => $this->input->post('kalori',TRUE),
            'lemak' => $this->input->post('lemak',TRUE),
            'karbohidrat' => $this->input->post('karbohidrat',TRUE),
            'protein' => $this->input->post('protein',TRUE),
            'jenis_pangan_id' => $this->input->post('jenis_pangan_id',TRUE),
            );

            $this->Pangan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pangan'));
        }
    }
    
    public function update($id) 
    {
        $this->load->model('Jenis_pangan_model');
        $row = $this->Pangan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Perbarui',
                'action' => site_url('pangan/update_action'),
                'id' => set_value('id', $row->id),
                'nama' => set_value('nama', $row->nama),
                'takaran' => set_value('takaran', $row->takaran),
                'urt' => set_value('urt', $row->urt),
                'gram' => set_value('gram', $row->gram),
                'kalori' => set_value('kalori', $row->kalori),
                'lemak' => set_value('lemak', $row->lemak),
                'karbohidrat' => set_value('karbohidrat', $row->karbohidrat),
                'protein' => set_value('protein', $row->protein),
                'jenis_pangan_id' => set_value('jenis_pangan_id', $row->jenis_pangan_id),
                );
            
            $data['jenis'] = $this->Jenis_pangan_model->get_all();
            $this->render['content']= $this->load->view('pangan/pangan_form', $data, TRUE);
            $this->load->view('template', $this->render);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pangan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'takaran' => $this->input->post('takaran',TRUE),
		'urt' => $this->input->post('urt',TRUE),
		'gram' => $this->input->post('gram',TRUE),
		'kalori' => $this->input->post('kalori',TRUE),
		'lemak' => $this->input->post('lemak',TRUE),
		'karbohidrat' => $this->input->post('karbohidrat',TRUE),
		'protein' => $this->input->post('protein',TRUE),
		'jenis_pangan_id' => $this->input->post('jenis_pangan_id',TRUE),
	    );

            $this->Pangan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pangan'));
        }
    }
    
    public function delete($id) 
    {
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

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('takaran', 'takaran', 'trim|required');
	$this->form_validation->set_rules('urt', 'urt', 'trim|required|numeric');
	$this->form_validation->set_rules('gram', 'gram', 'trim|required|numeric');
	$this->form_validation->set_rules('kalori', 'kalori', 'trim|required|numeric');
	$this->form_validation->set_rules('lemak', 'lemak', 'trim|required|numeric');
	$this->form_validation->set_rules('karbohidrat', 'karbohidrat', 'trim|required|numeric');
	$this->form_validation->set_rules('protein', 'protein', 'trim|required|numeric');
	$this->form_validation->set_rules('jenis_pangan_id', 'jenis pangan id', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
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
        xlsWriteLabel($tablehead, $kolomhead++, "Takaran");
        xlsWriteLabel($tablehead, $kolomhead++, "Urt");
        xlsWriteLabel($tablehead, $kolomhead++, "Gram");
        xlsWriteLabel($tablehead, $kolomhead++, "Kalori");
        xlsWriteLabel($tablehead, $kolomhead++, "Lemak");
        xlsWriteLabel($tablehead, $kolomhead++, "Karbohidrat");
        xlsWriteLabel($tablehead, $kolomhead++, "Protein");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Pangan Id");

        foreach ($this->Pangan_model->get_all() as $data) {
                $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->takaran);
            xlsWriteNumber($tablebody, $kolombody++, $data->urt);
            xlsWriteNumber($tablebody, $kolombody++, $data->gram);
            xlsWriteNumber($tablebody, $kolombody++, $data->kalori);
            xlsWriteNumber($tablebody, $kolombody++, $data->lemak);
            xlsWriteNumber($tablebody, $kolombody++, $data->karbohidrat);
            xlsWriteNumber($tablebody, $kolombody++, $data->protein);
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
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-27 07:43:32 */
/* http://harviacode.com */