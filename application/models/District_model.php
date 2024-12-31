<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class District_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data)
    {
        $arrayOrg = array(
            'name' => $data['name'],
            'province_name' => $data['province_name']
        );
        if (!isset($data['district_id'])) {
            $this->db->insert('districts', $arrayOrg);
        } else {
            $this->db->where('id', $data['district_id']);
            $this->db->update('districts', $arrayOrg);
        }

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
