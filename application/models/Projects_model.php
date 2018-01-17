<?php
class Projects_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get the projects
     *  
     * optional offsert int
     * 
     * @return an array of projects
     */

    public function getProjects($offset = null)
    {
        if ($this->input->get('searchParamaters')) {
            $search = '%'.$this->input->get('searchParamaters').'%';       
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
            $data = []; // standard value
            // if the query returned a project then proceed
            if (!empty($project)) {
                $project['0']->tags = $this->getAllTags($project['0']->id);

                $query = $this->db->from('tags');

                foreach ($project['0']->tags as $tag) {
                    $this->db->where('id !=', $tag->id);
                }
                           
                $project['0']->none_tags = $this->db->get()->result();

                $data = $this->filter->xssFilter($project);
            }
            return $data; // return the data
        } // end tags
        $project = $this->db->get_where('projects', array('slug' => $slug))->result();
        $data = []; // standard value
        // if the query returned a project then proceed
        if (!empty($project)) {
           $project['0']->members = $this->getAllMembers($project['0']->id);

            $query = $this->db->from('members');

            foreach ($project['0']->members as $member) {
                $this->db->where('id !=', $member->id);
            }

            $project['0']->none_members = $this->db->get()->result();

            $data = $this->filter->xssFilter($project); 
        }
        return $data; // return the data
    } // end members

    /**
     * Adds a project
     *
     * input data array
     * @return  object
     */

    public function addProject($data)
    {
        if ($this->db->insert('projects', $data)) {
            
        } else {

        }
    }


    public function addMember($slug, $name)
    {
        $project = $this->getProject($slug);

        if (!$project) {
           
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
           
            $result = false;
        }

        return $result;
    }




    // Add tags to projects
    public function addTags($slug, $name)
    {
        $project = $this->getProject($slug);

        if (!$project) {

            return false;
            exit;
        }

        $tag = $this->getTags($name);

        if ($tag) {
            if ($this->db->from('projects_tags')->where('tag_id', $tag['0']->id)->where('project_id', $project['0']->id)->get()->result()) {
               
                return false;
                exit;
            }
            $result = $this->db->insert('projects_tags', array('tag_id' => $tag['0']->id, 'project_id' => $project['0']->id)); 
        } else {
            $result = false;
        }

        return $result;
    }

    public function deleteTag($projectSlug, $tagSlug)
    {
        $project = $this->getProject($projectSlug);
        $tag = $this->db->get_where('tags', array('slug' => $tagSlug))->result();    
 
        if (!$project || !$tag) {
            return false;
            exit;
        }

        if ($this->db->where('project_id', $project['0']->id)->where('tag_id', $tag['0']->id)->delete('projects_tags')) {

        } else {

        }
       
        return $result;
    }

    public function deleteMember($projectSlug, $memberSlug)
    {
        $project = $this->getProject($projectSlug);
        $member = $this->db->get_where('members', array('slug' => $memberSlug))->result();    
 
        if (!$project || !$member) {

            return false;
            exit;
        }

        if ($this->db->where('project_id', $project['0']->id)->where('member_id', $member['0']->id)->delete('project_members')) {
           
        } else {

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

        }  else {
            
        }    
    }
}