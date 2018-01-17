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

        if (is_numeric($offset) && $offset > 0) {
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

        } else {

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

        } else {
            
        }       
    }


    public function import()
    {
        $this->load->library('Slug');
            
        $ovNumbers = $this->db->from('members')->select('ovnumber, slug')->get()->result_array();
        $slugs = array_column($ovNumbers, 'slug');
        $ovNumbers = array_column($ovNumbers, 'ovnumber');

        for ($i = 4; $i < $counter; $i+=4) {
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
      
        return true;
    }

    public function AmountOfMembers()
    {
        return $this->db->count_all('members');
    }
}