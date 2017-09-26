<?php
class Projects_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        //Get database class availeble
    }


    public function getProjects()
    {
        //get all projects
        $this->db->from('projects');
        $query = $this->db->get();

        $queryResult = $query->result();

        foreach ($queryResult as $result) {
            $result->members = $this->db->select('name')->from('project_members')->where('project_id', $result->id)->join('members', 'members.id = project_members.member_id', 'inner')->get()->result();
        }

       	return $queryResult;
    }


    public function getProject($slug)
    {
        return $this->db->get_where('projects', array('slug' => $slug))->result();
    }

    public function addProject($data)
    {
        $this->db->insert('projects', $data);
    }

    public function editProject($data)
    {
        extract($data);
        $this->db->where('slug', $data['slug']);
        $this->db->update('projects', array('name' => $name,
            'client' => $client,
            'teacher' => $teacher,
            'description' => $description));        
    }
}
