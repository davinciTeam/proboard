<?php
class Appointment_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        //Get database class availeble
    }

    public function getProjects()
    {
        return $this->filter->xssFilter($this->db->order_by('name')->get('projects')->result());
    }

    public function getProject($slug)
    {
        return $this->filter->xssFilter($this->db->get_where('projects', array('slug' => $slug))->result());
    }

     public function addAppointment($save)
    {

        $this->db->where('slug', $save['slug'])->update('projects', array('iteration_start' => $save['iteration_start'],
            'iteration_end' => $save['iteration_end'],
            'iteration_date' => $save['iteration_date'],
            'code_date' => $save['code_date'],
            'code_start' => $save['code_start'],
            'code_end' => $save['code_end'])
        );
        // $query['project'] = $this->Appointment_model->getProject($slug);
        $this->load->helper('form');
        // $this->db->where('slug', $data['slug']);
        // $this->db->where('slug', $save['slug']);
        // // Add Appiontment into database
        // $this->db->insert('projects', $save);
    }
}