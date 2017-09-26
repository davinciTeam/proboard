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
        $queryResult = $this->db->get()->result();

        foreach ($queryResult as $result) {
            $result->members = $this->getAllMembers($result->id);
        }

       	return $queryResult;
    }


    public function getProject($slug)
    {
        $project = $this->db->get_where('projects', array('slug' => $slug))->result();
        $project['0']->members = $this->getAllMembers($project['0']->id);
        $project['0']->none_members = $this->db->from('members')->get()->result();

        return $project;
    }

    public function addProject($data)
    {
        $this->db->insert('projects', $data);
    }

    public function addMember($slug, $name)
    {
        $project = $this->getProject($slug);

        if (!$project ) {
            return false;
            exit;
        }

        $member = $this->getMember($name);

        if ($member) {
            if ($this->db->from('project_members')->where('member_id', $member['0']->id)->where('project_id', $project['0']->id)->get()->result()) {
                return false;
                exit;
            }

            $result = $this->db->insert('project_members', 
                array('member_id' => $member['0']->id, 'project_id' => $project['0']->id));
        } else {
            $this->db->insert('members', array('name' => $name));
            $result = $this->db->insert('project_members', 
                array('member_id' => $this->db->insert_id(), 'project_id' => $project['0']->id));
        }

        return $result;
    }

    public function editMember($slug, $oldMember, $newMember)
    {

        $project = $this->getProject($slug);

        $oldMember = $this->getMember($oldMember);
        $newMember = $this->getMember($newMember);

        if (!$project || !$oldMember || !$newMember || $this->db->from('project_members')->where('member_id', $newMember['0']->id)->where('project_id', $project['0']->id)->get()->result()) {
            return false;
            exit;
        }
        

        $result = $this->db->where('member_id', $oldMember['0']->id)->where('project_id', $project['0']->id)->update('project_members', array('member_id' => $newMember['0']->id));
        
        return $result;
    }

    public function deleteMember($slug, $name)
    {
        $project = $this->getProject($slug);
        $member = $this->getMember($name);    
        
        if (!$project || !$member) {
            return false;
            exit;
        }
        
        $result = $this->db->where('project_id', $project['0']->id)->where('member_id', $member['0']->id)->delete('project_members');
        
        return $result;
    }

    protected function getMember($name)
    {
        return $this->db->get_where('members', array('name' => $name))->result();
    }

    protected function getAllMembers($id)
    {
        return $this->db->select('name')->from('project_members')->where('project_id', $id)->join('members', 'members.id = project_members.member_id', 'inner')->get()->result();
    }

}