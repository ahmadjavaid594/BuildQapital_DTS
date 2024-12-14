<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Test_Centers_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Get all test centers
    public function getList()
    {
        return $this->db->get('test_centers')->result_array();
    }

    // Save or update a test center
    public function save($data, $id = null)
    {
        $testCenterData = array(
            'name' => $data['name'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'email' => $data['email'],
            'capacity' => $data['capacity'],
            'postal_code'=>$data['postal_code'],
            'contact_number'=>$data['contact_number'],
            'operating_hours'=>$data['operating_hours'],

        );

        if (is_null($id)) {
            // Insert new test center
            $this->db->insert('test_centers', $testCenterData);
        } else {
            // Update existing test center
            $this->db->where('id', $id);
            $this->db->update('test_centers', $testCenterData);
        }

        return $this->db->affected_rows() > 0;
    }
}
