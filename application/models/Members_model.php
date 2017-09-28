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
        //Get database class availeble
        $this->load->database();
        //get all members
        $query = $this->db->get('members');
        return $query->result();
    }

    public function getMember($slug)
    {
        return $this->db->get_where('members', array('slug' => $slug))->result();
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
}