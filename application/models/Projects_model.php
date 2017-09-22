<?php
class Projects_model extends CI_Model {

    public function getProjects(){
        $this->load->database();
        //Get database class availeble
        //get al projects
        $query = $this->db->get('projects');
       	return $query->result_array();
    }

    public function add_project($data){
        $this->load->database();
        $this->db->insert('projects',$data);
        // var_dump($count);
        // exit;
    }


}