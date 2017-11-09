<?php
class Appointment_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function addAppointment($data, $type)
    {
        $data = str_replace('/', ':', $data);
        if (!$this->validateAppointment($data)) return false;

        if ($type === 'iteration') {
            $data = Array(
                "iteration_start" => $data['start_date'],
                "iteration_end" => $data['end_date'],
                "slug" => $data['slug'],
            );
        } else {
            $data = Array(
                "code_review_start" => $data['start_date'],
                "code_review_end" => $data['end_date'],
                "slug" => $data['slug'],
            );
        }
        if ( $this->db->where('slug', $data['slug'])->update('projects', $data) ) {
            return true;
        } else {
            return false;
        }
    }


    public function getTodayAppointment($data)
    {
       return $this->db->from('projects')
       ->group_start()
                    ->group_start()
                        ->where('iteration_start >=', date("Y-m-d"))
                        ->where('iteration_end <=', date("Y-m-d"))
                    ->group_end()
                    ->or_group_start()
                        ->where('code_review_start >=', date("Y-m-d"))
                        ->where('code_review_end <=', date("Y-m-d"))
                    ->group_end()
                ->group_end()
            ->get()->result();
    }

    protected function validateAppointment($data)
    {
        if ($this->db->from('projects')
            ->where('slug !=', $data['slug'])
                ->group_start()
                    ->group_start()
                        ->where('iteration_start >=', $data['start_date'])
                        ->where('iteration_end <=', $data['end_date'])
                    ->group_end()
                    ->or_group_start()
                        ->where('code_review_start >=', $data['start_date'])
                        ->where('code_review_end <=', $data['end_date'])
                    ->group_end()
                ->group_end()
            ->get()->result()) {
            return false;
        } else {
            return true;
        }
    }
}