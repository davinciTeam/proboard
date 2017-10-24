<?php
class Appointment_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function addAppointment($data)
    {
        if (!$this->validateAppointment($data)) return false;

        $this->db->where('slug', $data['slug'])->update('projects', array(
            'iteration_start' => $data['iteration_start'],
            'iteration_end' => $data['iteration_end'],
            'iteration_date' => $data['iteration_date'],
            'code_date' => $data['code_date'],
            'code_start' => $data['code_start'],
            'code_end' => $data['code_end'])
        );
    }

    protected function validateAppointment($data)
    {
        return true;
    }
}