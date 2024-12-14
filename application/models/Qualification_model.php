<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Qualification_model extends MY_Model
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
        if (!isset($data['qualification_id'])) {
            $this->db->insert('qualification', $arrayOrg);
        } else {
            $this->db->where('id', $data['qualification_id']);
            $this->db->update('qualification', $arrayOrg);
        }
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
