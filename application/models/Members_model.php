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
        return $this->filter->xssFilter($this->db->get('members')->result());
    }

    public function getMember($slug)
    {
        return $this->filter->xssFilter($this->db->get_where('members', array('slug' => $slug))->result());
    }

    public function addMember($data)
    {
        // Add member into database
        $this->db->insert('members', $data);
    }

    public function editMember($data)
    {


        //Set where clause for update query
        $this->db->where('slug', $data['slug']);
        $this->db->update('members', array('name' => $data['name'],
            'insertion' => $data['insertion'],
            'lastname' => $data['lastname'],
            'active' => $data['active'],
            'ovnumber' => $data['ovnumber'])
        );        
    }

    public function import()
    {
        $this->load->helper('url_helper');

        $config['upload_path']          =  realpath(APPPATH . '../uploads/');
        $config['file_name']            = 'import.csv';
        $config['allowed_types']        = 'csv';
        $config['max_size']             = 100;
        
        $this->load->library('upload', $config);
        
        $data = array('file' => $this->upload->data());

        if ($this->upload->do_upload('userfile')) {
            $data = array('upload_data' => $this->upload->data());
            $file_data = explode(';', preg_replace('/\n/', ';', file_get_contents($data['upload_data']['full_path'], false)));
            unlink($data['upload_data']['full_path']);
            for ($i = 4; $i < count($file_data); $i+=4) {
                $importData = Array(
                    "ovnumber" => $file_data[$i],
                    "name" => $file_data[$i+1],
                    "insertion" => $file_data[$i+2],
                    "lastname" => $file_data[$i+3]
                );
                $this->addMember($importData);
            } 
        }  
        return false;
    }
}