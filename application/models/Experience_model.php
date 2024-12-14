<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Experience_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getExperienceByApplicant($applicant_id) {
        return $this->db->where('applicant_id', $applicant_id)->get('applicant_experience')->result_array();
    }

    public function addExperience($data) {
        return $this->db->insert('applicant_experience', $data);
    }
    public function save($data)
    {
        $id = get_loggedin_user_id();
        $uploadPath = './uploads/' . $id . '/docs/';
        
        // Check if the directory exists; if not, create it with proper permissions
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true); // 0777 grants full permissions; 'true' allows recursive directory creation
        }
        
        $config['upload_path']   = $uploadPath; // Define your upload path
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp'; // Allow only PNG files
        $config['max_size']      = 1024; // Maximum file size in KB (1 MB)
        
        $this->upload->initialize($config);
        
        if (isset($_FILES['image_path']) && $_FILES['image_path']['name'] != '') {
            if (!$this->upload->do_upload('image_path')) {
                // Handle upload error
                $error = $this->upload->display_errors();
                return array('status' => false, 'error' => $error);
            } else {
                // Get the uploaded file's data
                $fileData = $this->upload->data();
                $filePath = '/uploads/' . $id . '/docs/' . $fileData['file_name'];
            }
        } else {
            $filePath = isset($data['existing_file_path']) ? $data['existing_file_path'] : null; // Use existing path if no new file is uploaded
        }
        
$detailsExp = array(
    'applicant_id'=>$id,
    'company' => $data['company'],
    'job_title' => $data['job_title'],
    'start_date' => $data['start_date'],
    'end_date' => $data['end_date'],
    'responsibilities' => $data['responsibilities'],
    'image_path' => $filePath
);

if (empty($data['experience_id'])) {
    // Insert new job
   
    $this->db->insert('applicant_experience', $detailsExp);
    $jobId = $this->db->insert_id();
  
} else {
    // Update existing job
    $experience_id = $data['experience_id'];

    $this->db->where('id', $experience_id);
    $this->db->update('applicant_experience', $detailsExp);
}
if ($this->db->affected_rows() > 0) {
    return true;
} else {
    return false;
}

    }
}
