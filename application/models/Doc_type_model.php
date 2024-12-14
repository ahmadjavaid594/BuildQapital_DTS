<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Doc_type_model extends MY_Model
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
        if (!isset($data['doc_type_id'])) {
            $this->db->insert('doc_type', $arrayOrg);
        } else {
            $this->db->where('id', $data['doc_type_id']);
            $this->db->update('doc_type', $arrayOrg);
        }

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
