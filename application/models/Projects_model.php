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

       	return $this->filter->xssFilter($queryResult);
    }

    public function getProject($slug)
    {
        $project = $this->db->get_where('projects', array('slug' => $slug))->result();
        $project['0']->members = $this->getAllMembers($project['0']->id);

        $query = $this->db->from('members');

        foreach ($project['0']->members as $member) {
            $this->db->where('id !=', $member->id);
        }

        $project['0']->none_members = $this->db->get()->result();

        return $this->filter->xssFilter($project);
    }

    public function addProject($data)
    {
        if ($this->db->insert('projects', $data)) {
            addFeeback(array('Succesvol project aangemaakt'));
        } else {
            addFeeback(array('Er is een onbekende fout opgetreden', 'negative'));
        }
    }


    public function addMember($slug, $name)
    {
        $project = $this->getProject($slug);

        if (!$project) {
            addFeeback(array('Geen project gevonden', 'negative'));
            return false;
            exit;
        }

        $member = $this->getMember($name);

        if ($member) {
            if ($this->db->from('project_members')->where('member_id', $member['0']->id)->where('project_id', $project['0']->id)->get()->result()) {
                addFeeback(array('Student al aanwezig in project', 'negative'));
                return false;
                exit;
            }

            $result = $this->db->insert('project_members', 
                array('member_id' => $member['0']->id, 'project_id' => $project['0']->id));
            addFeeback(array('Student succesvol toegevoegd'));
        } else {
            addFeeback(array('Er is een onbekende fout opgetreden', 'negative'));
            $result = false;
        }

        return $result;
    }


    public function deleteMember($slug, $name)
    {
        $project = $this->getProject($slug);
        $member = $this->getMember($name);    
 
        if (!$project || !$member) {
            if (!$project) addFeeback(array('Geen project gevonden', 'negative'));
            if (!$member) addFeeback(array('Student niet gevonden', 'negative'));
            return false;
            exit;
        }
        
        $result = $this->db->where('project_id', $project['0']->id)->where('member_id', $member['0']->id)->delete('project_members');

        if ($result) {
            addFeeback(array('Student succesvol van project gehaald'));
        } else {
            addFeeback(array('Er is een onbekende fout opgetreden', 'negative'));
        }
        
        return $result;
    }

    protected function getMember($name)
    {
        return $this->db->get_where('members', array('name' => $name))->result();
    }

    protected function getAllMembers($id)
    {
        return $this->db->order_by('name')->from('project_members')->where('project_id', $id)->join('members', 'members.id = project_members.member_id', 'inner')->get()->result();
    }


    public function editProject($data)
    {
        $this->db->where('slug', $data['slug']);
        if ($this->db->update('projects', array('name' => $data['name'],
            'client' => $data['client'],
            'teacher' => $data['teacher'],
            'description' => $data['description'])
        )) {
            addFeeback(array('Project succesvol bewerkt'));
        }  else {
            addFeeback(array('Er is een onbekende fout opgetreden', 'negative'));
        }    
    }
}