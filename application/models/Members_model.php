<?php
class Members_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        //Get database class availeble
    }


    public function getMembers($offset = null)
    {
       
        if (!empty($this->input->post('search') && !empty($this->input->post('field') ))) {
            $this->db->order_by($this->input->post('field'), $this->input->post('search'));
        } 

        if (is_numeric($offset)) {
            $this->db->limit(10, $offset)->order_by('name');
        } else {
            $this->db->limit(10)->order_by('name');
        }
        
        return $this->filter->xssFilter($this->db->get('members')->result());
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
        if ($this->db->where('slug', $data['slug'])->update('members', array('name' => $data['name'],
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

            $fileData = str_getcsv(str_replace("\n", '', file_get_contents($data['upload_data']['full_path'], false)), ';');
            $fileData = preg_replace('/[\x00-\x1F\x7F]/u', '', $fileData);//remove any none utf-8 charachers
            unlink($data['upload_data']['full_path']);
      
            $errors = [];
            $counter = count($fileData)-1;
            for ($i = 4; $i < $counter; $i+=4) {
                if (!isset($fileData[$i]) || 1 > $fileData[$i] || strlen($fileData[$i]) !== 8 || !is_numeric($fileData[$i])) {
                    $errors[] = "Ongeldig Ov nummer regelnummer ".((string)$i/4+1) ;
                } 
                if (!isset($fileData[$i+1])|| strlen($fileData[$i+1]) >= 100 || !preg_match("/^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$/",     $fileData[$i+1])) {
                    $errors[] = "Ongeldig naam regelnummer ".((string)$i/4+1) ;
                } 
                if (!isset($fileData[$i+2]) || strlen($fileData[$i+2]) >= 100 || !preg_match("/^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$/",     $fileData[$i+2])) {
                    $errors[] = "Ongeldig tussenvoegsel regelnummer ".((string)$i/4+1) ;
                } 
                if (!isset($fileData[$i+3]) || strlen($fileData[$i+3]) >= 100 || !preg_match("/^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$/",     $fileData[$i+3])) {
                    $errors[] = "Ongeldig achternaam regelnummer ".((string)$i/4+1) ;
                }
            } 
           
            if (!empty($errors)) {
                addFeeback($errors, 'negative');
                return false;
            }
            
            $ovNumbers = $this->db->from('members')->select('ovnumber, slug')->get()->result_array();
            $slugs = array_column($ovNumbers, 'slug');
            $ovNumbers = array_column($ovNumbers, 'ovnumber');

            for ($i = 4; $i < count($fileData)-1; $i+=4) {
                $importData = Array(
                    "ovnumber" => $fileData[$i],
                    "name" => $fileData[$i+1],
                    "insertion" => $fileData[$i+2],
                    "lastname" => $fileData[$i+3]
                );
                if (in_array($importData['ovnumber'], $ovNumbers)) {
                    $importData["active"] = 1;
                    $importData["slug"] = $slugs[$i/4-1];
                    $this->editMember($importData);
                } else {
                    $importData["slug"] = $this->slug->slug_exists($fileData[$i+1]);
                    $this->addMember($importData);
                }
            }
            
            addFeeback(array('Import gelukt'));
            
            return true;
        }  
        addFeeback(array($this->upload->display_errors()), 'negative');
        return false;
    }

    public function AmountOfMembers()
    {
        return $this->db->count_all('members');
    }
}