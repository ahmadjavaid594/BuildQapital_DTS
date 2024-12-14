<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Status_model extends MY_Model
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
        if (!isset($data['status_id'])) {
            $this->db->insert('status', $arrayOrg);
        } else {
            $this->db->where('id', $data['status_id']);
            $this->db->update('status', $arrayOrg);
        }

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
