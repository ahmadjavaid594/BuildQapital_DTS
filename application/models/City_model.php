<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class City_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data)
    {
        $arrayOrg = array(
            'name' => $data['name']
        );
        if (!isset($data['city_id'])) {
            $this->db->insert('cities', $arrayOrg);
        } else {
            $this->db->where('id', $data['city_id']);
            $this->db->update('cities', $arrayOrg);
        }

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
