<?php
class Tags_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        //Get database class availeble
    }


    public function getTags($offset = null)
    {
        if (is_numeric($offset) && $offset > 0) {
            $this->db->limit(10, $offset)->order_by('name');
        } else {
            $this->db->limit(10)->order_by('name');
        }
        
        return $this->filter->xssFilter($this->db->get('tags')->result());
    }

    public function getTag($slug)
    {
        return $this->filter->xssFilter($this->db->get_where('tags', array('slug' => $slug))->result());
    }

    public function addTag($data)
    {
        // Add tag into database
        if ($this->db->insert('tags', $data)) {
            addFeeback(array('Nieuwe tag aangemaakt'));
        } else {
            addFeeback(array('Er is een onbekende fout opgetreden'), 'negative');
        }
    }

    public function editTag($data)
    {
        //Set where clause for update query
        if ($this->db->where('slug', $data['slug'])->update('tags', array('name' => $data['name'],
            'active' => $data['active'],
            'description' => $data['description'])
        )) {
            addFeeback(array('Tag succesvol bewerkt'));
        } else {
            addFeeback(array('Er is een onbekende fout opgetreden'), 'negative');
        }       
    }

    public function AmountOfTags()
    {
        return $this->db->count_all('tags');
    }
}