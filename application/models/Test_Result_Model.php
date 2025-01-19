<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Test_Result_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Load necessary libraries
        $this->load->library('upload');
        $this->load->library('csvimport');
    }

    public function upload_test_results($job_id, $file)
    {
        // Validate the file
        if (empty($file['name'])) {
            return ['error' => 'CSV file is required.'];
        }

        // Set upload configuration
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['file_name'] = 'test_results_' . time();

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('csv_file')) {
            return ['error' => $this->upload->display_errors()];
        }

        // Get file data
        $fileData = $this->upload->data();
        $filePath = './uploads/' . $fileData['file_name'];

        // Parse the CSV file
        $csvArray = $this->csvimport->get_array($filePath);

        if ($csvArray) {
          
            // Process each row
            foreach ($csvArray as $row) {
              
                if (isset($row['Roll No'], $row['Marks Obtained'], $row['Total Marks'])) {
                    $data = [
                        'job_id' => $job_id,
                        'roll_no' => $row['Roll No'],
                        'marks_obtained' => $row['Marks Obtained'],
                        'total_marks' => $row['Total Marks'],
                        'status' => isset($row['Status']) ? $row['Status'] : '',
                        'remarks' => isset($row['Remarks']) ? $row['Remarks'] : '',
                        'cnic' => isset($row['CNIC']) ? $row['CNIC'] : ''
                    ];

                    // Insert or update the result
                    $this->save_or_update_result($data);
                }
            }

            return ['success' => 'Test results have been uploaded successfully.'];
        } else {
            return ['error' => 'Error parsing CSV file.'];
        }
    }

    private function save_or_update_result($data)
    {
       
       
        $sql = "SELECT
                        j.id
                    FROM
                        job_applicants j
                    INNER JOIN applicants q ON j.applicant_id = q.id 
                    WHERE j.unique_id = '".$data['roll_no']."' and q.cnic = '".$data['cnic']."'";
        
        $record = $this->db->query($sql)->row_array();
        $data['record_updated'] = 0;
        if($record)
        {
            $this->db->where('id', $record['id']);
            $this->db->update('job_applicants', ['status_id'=>14]);
            $data['record_updated'] = 1;
        }
     
        // Insert or update logic for saving the result in the database
        $this->db->where('job_id', $data['job_id']);
        $this->db->where('roll_no', $data['roll_no']);
        $existingRecord = $this->db->get('test_result_records')->row();

        if ($existingRecord) {
            // Update existing record
            $this->db->where('id', $existingRecord->id);
            $this->db->update('test_result_records', $data);
        } else {
            // Insert new record
            $this->db->insert('test_result_records', $data);
        }
    }
    public function get_result_by_roll_no($roll_no,$job_id) {
        $sql = "SELECT
            x.*
        FROM
            job j
        INNER JOIN test_result_records x ON x.job_id = j.id where x.job_id = ".$job_id." and (x.cnic = '".$roll_no."' or x.roll_no = '".$roll_no."')";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('test_result_records');
        return $this->db->affected_rows() > 0;
    }
}
