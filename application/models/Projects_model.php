<?php
class Projects_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        //Get database class availeble
    }


    public function getProjects($offset = null, $sort = false)
    {
        $search = $this->input->post('searchParamaters');
        if (!empty($search)) {

            $search = '%'.$search.'%';       
            foreach($this->db->list_fields('projects') as $fieldName) {
                if ($fieldName === 'id' || $fieldName === 'active') continue;
                $this->db->or_where($fieldName. ' LIKE', $search);
            }
        }

        if (is_numeric($offset) && $offset > 0) {
            $this->db->limit(10, $offset);
        } else {
            $this->db->limit(10);
        }

        if ($sort) {
            $this->db->order_by('iteration_start', 'DESC');
            $this->db->order_by('code_review_start', 'DESC');
        }

        $queryResult = $this->db->from('projects')->get()->result();

        foreach ($queryResult as $result) {
            $result->members = $this->getAllMembers($result->id);
            $result->tags = $this->getAllTags($result->id);
        }

       	return $this->filter->xssFilter($queryResult);
    }

    public function getProject($slug)
    {
        $check_url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

        if (strpos($check_url,'tags') or strpos($check_url,'Tags') !== false) {
            $project = $this->db->get_where('projects', array('slug' => $slug))->result();
            $project['0']->tags = $this->getAllTags($project['0']->id);

            $query = $this->db->from('tags');

            foreach ($project['0']->tags as $tag) {
                $this->db->where('id !=', $tag->id);
            }
                       
            $project['0']->none_tags = $this->db->get()->result();

            return $this->filter->xssFilter($project);
        }
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
            addFeeback(array('Er is een onbekende fout opgetreden'), 'negative');
        }
    }


    public function addMember($slug, $name)
    {
        $project = $this->getProject($slug);

        if (!$project) {
            addFeeback(array('Geen project gevonden'), 'negative');
            return false;
            exit;
        }

        $member = $this->getMember($name);

        if ($member) {
            if ($this->db->from('project_members')->where('member_id', $member['0']->id)->where('project_id', $project['0']->id)->get()->result()) {
                addFeeback(array('Student al aanwezig in project'), 'negative');
                return false;
                exit;
            }

            $result = $this->db->insert('project_members', 
            array('member_id' => $member['0']->id, 'project_id' => $project['0']->id));
            addFeeback(array('Student succesvol toegevoegd'));
        } else {
            addFeeback(array('Er is een onbekende fout opgetreden'), 'negative');
            $result = false;
        }

        return $result;
    }




    // Add tags to projects
    public function addTags($slug, $name)
    {
        $project = $this->getProject($slug);

        if (!$project) {
            addFeeback(array('Geen project gevonden'), 'negative');
            return false;
            exit;
        }

        $tag = $this->getTags($name);

        if ($tag) {
            if ($this->db->from('projects_tags')->where('tag_id', $tag['0']->id)->where('project_id', $project['0']->id)->get()->result()) {
                addFeeback(array('Tag al toegewezen aan project'), 'negative');
                return false;
                exit;
            }

            $result = $this->db->insert('projects_tags', 
                array('tag_id' => $tag['0']->id, 'project_id' => $project['0']->id));
            addFeeback(array('Tag succesvol toegewezen'));
        } else {
            addFeeback(array('Er is een onbekende fout opgetreden'), 'negative');
            $result = false;
        }

        return $result;
    }

    public function deleteTag($projectSlug, $tagSlug)
    {
        $project = $this->getProject($projectSlug);
        $tag = $this->db->get_where('tags', array('slug' => $tagSlug))->result();    
 
        if (!$project || !$tag) {
            if (!$project) addFeeback(array('Geen project gevonden'), 'negative');
            if (!$tag) addFeeback(array('Tag niet gevonden'), 'negative');
            return false;
            exit;
        }

        if ($this->db->where('project_id', $project['0']->id)->where('tag_id', $tag['0']->id)->delete('projects_tags')) {
            addFeeback(array('Tag '. $tag['0']->name.' succesvol van project gehaald'));
        } else {
            addFeeback(array('Er is een onbekende fout opgetreden'), 'negative');
        }
       
        return $result;
    }

    public function deleteMember($projectSlug, $memberSlug)
    {
        $project = $this->getProject($projectSlug);
        $member = $this->db->get_where('members', array('slug' => $memberSlug))->result();    
 
        if (!$project || !$member) {
            if (!$project) addFeeback(array('Geen project gevonden'), 'negative');
            if (!$member) addFeeback(array('Student niet gevonden'), 'negative');
            return false;
            exit;
        }

        if ($this->db->where('project_id', $project['0']->id)->where('member_id', $member['0']->id)->delete('project_members')) {
            addFeeback(array('Student '. $member['0']->name." ".$member['0']->insertion." ".$member['0']->lastname.' succesvol van project gehaald'));
        } else {
            addFeeback(array('Er is een onbekende fout opgetreden'), 'negative');
        }
       
        return $result;
    }

    protected function getMember($name)
    {
        return $this->db->get_where('members', array('slug' => $name))->result();
    }

    protected function getAllMembers($id)
    {
        return $this->db->order_by('name')->from('project_members')->where('project_id', $id)->join('members', 'members.id = project_members.member_id', 'inner')->get()->result();
    }
    // 
    protected function getTags($name)
    {
        return $this->db->get_where('tags', array('slug' => $name))->result();
    }

    protected function getAllTags($id)
    {
        return $this->db->order_by('name')->from('projects_tags')->where('project_id', $id)->join('tags', 'tags.id = projects_tags.tag_id', 'inner')->get()->result();
    }

    public function AmountOfProjects()
    {
        return $this->db->count_all('projects');
    }


    public function editProject($data)
    {
        $this->db->where('slug', $data['slug']);
        if ($this->db->update('projects', array('name' => $data['name'],
            'client' => $data['client'],
            'teacher' => $data['teacher'],
            'git_url' => $data['git_url'],
            "active" => $data['active'],
            'bug_url' => $data['bug_url'],
            'project_url' => $data['project_url'],
            'trello_url' => $data['trello_url'],
            'description' => $data['description'])
        )) {
            addFeeback(array('Project succesvol bewerkt'));
        }  else {
            addFeeback(array('Er is een onbekende fout opgetreden'), 'negative');
        }    
    }
}