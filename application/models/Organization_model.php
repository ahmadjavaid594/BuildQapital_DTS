<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Organization_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getList()
    {
        return $this->organization_model->findAll();
    }
    public function save($data)
    {
        $arrayOrg = array(
            'name' => $data['name'],
            'industry' => $data['industry'],
            'website' => $data['website'],
            'email' => $data['email'],
            'company_size' => $data['company_size'],
            'location' => $data['location'],
            'description' => $data['description']
        );
        if (!isset($data['organization_id'])) {
            $this->db->insert('organization', $arrayOrg);
        } else {
            $this->db->where('id', $data['organization_id']);
            $this->db->update('organization', $arrayOrg);
        }

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
