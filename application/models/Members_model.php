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

    public function addMember($data)
    {
        $this->db->insert('members', $data);
    }
}