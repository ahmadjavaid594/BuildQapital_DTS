<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Job_type_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data)
    {
        $arrayOrg = array(
            'name' => $data['name'],
            'description' => $data['description']
        );
        if (!isset($data['job_type_id'])) {
            $this->db->insert('job_type', $arrayOrg);
        } else {
            $this->db->where('id', $data['job_type_id']);
            $this->db->update('job_type', $arrayOrg);
        }
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
