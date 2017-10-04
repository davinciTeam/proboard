<?php
class Members_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        //Get database class availeble
    }


    public function getMembers()
    {
        return $this->filter->xssFilter($this->db->order_by('name')->get('members')->result());
    }

    public function getMember($slug)
    {
        return $this->filter->xssFilter($this->db->get_where('members', array('slug' => $slug))->result());
    }

    public function addMember($data)
    {
        // Add member into database
        if ($this->db->insert('members', $data)) {
            addFeeback(array('Nieuwe student aangemaakt'));
        } else {
            addFeeback(array('Er is een onbekende fout opgetreden'), 'negative');
        }
    }

    public function editMember($data)
    {
        //Set where clause for update query
        if ($this->db->where('slug', $data['slug'])->db->update('members', array('name' => $data['name'],
            'insertion' => $data['insertion'],
            'lastname' => $data['lastname'],
            'active' => $data['active'],
            'ovnumber' => $data['ovnumber'])
        )) {
            addFeeback(array('Student succesvol bewerkt'));
        } else {
            addFeeback(array('Er is een onbekende fout opgetreden'), 'negative');
        }       
    }

    public function import()
    {
        $this->load->helper('url_helper');
        $this->load->library('Slug');

        $config['upload_path']          = realpath(APPPATH . '../uploads/');
        $config['file_name']            = 'import.csv';
        $config['allowed_types']        = 'csv';
        $config['max_size']             = 100;
        
        $this->load->library('upload', $config);
        
        $data = array('file' => $this->upload->data());

        if ($this->upload->do_upload('userfile')) {
            $data = array('upload_data' => $this->upload->data());
            $fileData = explode(';', file_get_contents($data['upload_data']['full_path'], false));
            unlink($data['upload_data']['full_path']);
            for ($i = 4; $i < count($fileData)-1; $i+=4) {
                $importData = Array(
                    "ovnumber" => $fileData[$i],
                    "name" => $fileData[$i+1],
                    "slug" => $this->slug->slug_exists($fileData[$i+1]),
                    "insertion" => $fileData[$i+2],
                    "lastname" => $fileData[$i+3]
                );
                $this->addMember($importData);
            } 
            addFeeback(array('Import gelukt'));
            return true;
        }  
        addFeeback(array($this->upload->display_errors()), 'negative');
        return false;
    }
}