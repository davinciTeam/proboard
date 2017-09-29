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

    // function slug_exists($slug)
    // {
    //     $string = 1;
    //     while($this->db->where('slug', $slug)->get('members')->result())
    //     {
    //         $slug .= (string)$string;
    //         $string++;
    //     }
    //     return $slug;
            
    // }    
}