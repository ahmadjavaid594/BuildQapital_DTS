<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Test_Schedule_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Get all test schedules
    public function getAllSchedules()
    {
        $this->db->select('test_schedule.*, test_centers.name as test_center_name, designation.name as job_title');
        $this->db->from('test_schedule');
        $this->db->join('test_centers', 'test_centers.id = test_schedule.test_center_id');
        $this->db->join('job', 'job.id = test_schedule.job_id');
        $this->db->join('designation', 'designation.id = job.designation_id');
        $this->db->order_by('test_schedule.date', 'ASC');
        return $this->db->get()->result_array();
    }

    // Get schedules by test center ID
    public function getSchedulesByTestCenter($test_center_id)
    {
        $this->db->select('test_schedule.*, job.title as job_title');
        $this->db->from('test_schedule');
        $this->db->where('test_schedule.test_center_id', $test_center_id);
        $this->db->join('job', 'job.id = test_schedule.job_id');
        $this->db->order_by('test_schedule.date', 'ASC');
        return $this->db->get()->result_array();
    }

    // Get a single test schedule
    public function getSingleSchedule($id)
    {
        $this->db->select('test_schedule.*, test_centers.name as test_center_name, job.title as job_title');
        $this->db->from('test_schedule');
        $this->db->where('test_schedule.id', $id);
        $this->db->join('test_centers', 'test_centers.id = test_schedule.test_center_id');
        $this->db->join('job', 'job.id = test_schedule.job_id');
        return $this->db->get()->row_array();
    }

    // Save or update a test schedule
    public function save($data, $id = null)
    {
       
        $testScheduleData = array(
            'test_center_id' => $data['test_center_id'],
            'job_id' => $data['job_id'],
            'name' => $data['test_name'],
            'date' => $data['test_date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'seats_available' => $data['seats_available'],
        );

        if (is_null($id)) {
            // Insert new test schedule
            $this->db->insert('test_schedule', $testScheduleData);
        } else {
            // Update existing test schedule
            $this->db->where('id', $id);
            $this->db->update('test_schedule', $testScheduleData);
        }

        return $this->db->affected_rows() > 0;
    }

    // Delete a test schedule
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('test_schedule');
        return $this->db->affected_rows() > 0;
    }
}
