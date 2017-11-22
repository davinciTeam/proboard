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
       $queryResult = $this->db->from('projects')->where('iteration_start >=', date("Y-m-d"))->or_where('code_review_start >=', date("Y-m-d"))
                   
            ->get()->result();
            
            foreach ($queryResult as $result) {
                $result->members = $this->getAllMembers($result->id);
            }

        return $this->filter->xssFilter($queryResult);
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

    protected function getAllMembers($id)
    {
        return $this->db->order_by('name')->from('project_members')->where('project_id', $id)->join('members', 'members.id = project_members.member_id', 'inner')->get()->result();
    }
}