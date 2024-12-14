<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Location_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data)
    {
        $arrayOrg = array(
            'name' => $data['name'],
            'city' => $data['city']
        );
        if (!isset($data['location_id'])) {
            $this->db->insert('location', $arrayOrg);
        } else {
            $this->db->where('id', $data['location_id']);
            $this->db->update('location', $arrayOrg);
        }
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
