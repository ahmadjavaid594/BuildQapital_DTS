<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Province_model extends MY_Model
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
        if (!isset($data['province_id'])) {
            $this->db->insert('provinces', $arrayOrg);
        } else {
            $this->db->where('id', $data['province_id']);
            $this->db->update('provinces', $arrayOrg);
        }

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
