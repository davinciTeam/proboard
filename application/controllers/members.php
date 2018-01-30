<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Members extends CI_Controller {

	private static $_validationRules = array(
		array(
			'field' => 'name', 
			'label' => 'Voornaam',
            'rules' => 'required|max_length[100]|regex_match[/^[\w öóáäéýúíÄËÿüïöÖÜǧğ]*$/]',
            'errors' => array(
				'required' => 'U moet een voornaam invullen',
				'max_length' => 'De naam mag maximaal 100 karakters lang zijn',
				'regex_match' => 'Alleen de letters a-z, en spaties zijn toegestaan(niet hoofdlettergevoelig)'
			)
		),
		array(
			'field' => 'insertion', 
			'label' => 'Tussenvoegsel',
            'rules' => 'max_length[100]|regex_match[/^[\w öóáäéýúíÄËÿüïöÖÜǧğ]*$/]',
            'errors' => array(
				'max_length' => 'Het tussenvoegsel mag maximaal 100 karakters lang zijn',
				'regex_match' => 'Alleen de letters a-z, en spaties zijn toegestaan(niet hoofdlettergevoelig)'
			)
		),
		array(
			'field' => 'lastname', 
			'label' => 'Achternaam',
            'rules' => 'max_length[100]|regex_match[/^[\w öóáäéýúíÄËÿüïöÖÜǧğ]*$/]',
            'errors' => array(
				'max_length' => 'De achternaam mag maximaal 100 karakters lang zijn',
				'regex_match' => 'Alleen de letters a-z, en spaties zijn toegestaan(niet hoofdlettergevoelig)'
			)
		),
		array(
			'field' => 'ovnumber', 
			'label' => 'Ovnummer',
            'rules' => 'required|greater_than[1]|exact_length[8]|is_numeric',
            'errors' => array(
				'required' => 'U moet een ovnummer invullen',
				'exact_length' => 'Vul een geldig ov-nummer in',
				'is_numeric' => 'Vul een geldig ov-nummer in',
				'greater_than' => 'Vul een geldig ov-nummer in'
			)
		)
	);


	public function __construct()
	{
		parent::__construct();
		$this->load->library('Auth');		
		$this->load->model('members_model');
	}
	
	public function index()
	{
		//Get data and return it
		$data['members'] = $this->members_model->getMembers();
		//echo json
		echo_json($data);
	}

	public function addMember()
	{
		$data['data'] = $this->members_model->getMembers();
	}

	/*NewMemberAction 
	$saveData 
	OVnumber = ovnumber of the new member
	name = name of the new member
	slug = name of the member to create a link
	insertion = Insertion of the new member
	Lastname = lastname of the new member
	*/

	public function NewMemberAction()
	{
		// $this->load->library('form_validation');

		// $this->form_validation->set_rules(self::$_validationRules);
		$data = get_input_params();

		// if ($this->form_validation->run()) {

			$saveData = Array(
				"ovnumber" => $data['ovnumber'],
				"name" => $data['name'],
				"insertion" => $data['insertion'],
				"lastname" => $data['lastname']
			);
			$this->members_model->addMember($saveData);
			
		// } else {

		// }
		
	}
	public function editMember($slug = null)
	{
		$query['member'] = $this->members_model->getMember($slug);
	}

	public function editMemberAction($slug)
	{
		// $this->load->library('form_validation');

		// $this->form_validation->set_rules(self::$_validationRules);
		// $this->form_validation->set_rules('slug', '', 'required',
		// array('required' => 'Er is een onbekende fout opgetreden'));
		$this->slug = $slug;
		$data = get_input_params();


		// if ($this->form_validation->run()) {

			$updateData = Array(
				"ovnumber" => $data['ovnumber'],
				"name" => $data['name'],
				"insertion" => $data['insertion'],
				"slug" => $data['slug'],
				"lastname" => $data['lastname']
				// "active" => $this->input->post('active'),
			);		
			$this->members_model->editMember($updateData, $slug);
		// } else if ($this->input->post('slug')) {

		// }
	}

	public function import($fileData)
	{
		$this->load->helper('url_helper');

        $config['upload_path']          = realpath(APPPATH . '../uploads/');
        $config['file_name']            = 'import.csv';
        $config['allowed_types']        = 'csv';
        $config['max_size']             = 100;

        $this->load->library('upload', $config);
        
        $data = array('file' => $this->upload->data());

        if ($this->upload->do_upload('userfile')) {
            $data = array('upload_data' => $this->upload->data());

            $fileData = str_replace(array("\r\n", "\n", "\r"), '', file($data['upload_data']['full_path']));
            $fileData = preg_replace('/[\x00-\x1F\x7F]/u', '', explode(';', implode($fileData, '')));

            unlink($data['upload_data']['full_path']);
      
            $errors = [];
            $counter = count($fileData)-1;
            for ($i = 4; $i < $counter; $i+=4) {
                if (!isset($fileData[$i]) || 1 > $fileData[$i] || strlen($fileData[$i]) !== 8 || !is_numeric($fileData[$i])) {
                    $errors[] = "Ongeldig Ov nummer regelnummer ".((string)$i/4+1);
                } 
                if (!isset($fileData[$i+1])|| strlen($fileData[$i+1]) >= 100 || !preg_match("/^[\w öóáäéýúíÄËÿüïöÖÜǧğ]*$/",     $fileData[$i+1])) {
                    $errors[] = "Ongeldig naam regelnummer ".((string)$i/4+1) ;
                } 
                if (!isset($fileData[$i+2]) || strlen($fileData[$i+2]) >= 100 || !preg_match("/^[\w öóáäéýúíÄËÿüïöÖÜǧğ]*$/",     $fileData[$i+2])) {
                    $errors[] = "Ongeldig tussenvoegsel regelnummer ".((string)$i/4+1) ;
                } 
                if (!isset($fileData[$i+3]) || strlen($fileData[$i+3]) >= 100 || !preg_match("/^[\w öóáäéýúíÄËÿüïöÖÜǧğ]*$/",     $fileData[$i+3])) {
                    $errors[] = "Ongeldig achternaam regelnummer ".((string)$i/4+1) ;
                }
            } 
           
            if (!empty($errors)) {
                
                return false;
            }
            $this->members_model->import($fileData);
        } else {

        }

	}
}
