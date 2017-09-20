<?php
class Projects_model extends CI_Model {

        public function __construct(){
                $this->load->database();
        }

//         public function get_projects($slug = FALSE){
//         // if ($slug === FALSE){
//         //         $query = $this->db->get('projects');
//         //         return $query->result_array();
//         // }
//         $this->db->query('SELECT * FROM projects');

//         // $query = $this->db->get_where('projects', array('slug' => $slug));
//         // return $query->row_array();
// }
}