<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Contact_us_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('applicants_model');
    }

    public function save($data)
    {

        $userID = get_loggedin_user_id();
        $user= $this->applicants_model->getSingleApplicant($userID);
       
        $arrayOrg = array(
            'name' => $user['name'],
            'cnic' => $user['cnic'],
            'mobile' => $user['mobileno'],
            'position' => $data['position'],
            'query' => $data['query']
        );
       
        $this->db->insert('contact_us', $arrayOrg);
       
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
