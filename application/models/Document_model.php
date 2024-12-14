<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Document_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('doc_type_model');
    }

    public function getDocumentByApplicant($applicant_id) {
        return $this->db->where('applicant_id', $applicant_id)->get('applicant_document')->result_array();
    }

    public function addDocument($data) {
        return $this->db->insert('applicant_document', $data);
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
        $docType = $this->doc_type_model->getSingle('doc_type', $data['name'], true);
        if($docType)
        {
            $docTypeName = $docType->name;
        }
        else{
            $docTypeName =  $data['name'];
        }
$detailsDoc = array(
    'applicant_id'=>$id,
    'name' => $docTypeName,
    'image_path' => $filePath
);

if (empty($data['document_id'])) {
    // Insert new job
    
    $this->db->insert('applicant_document', $detailsDoc);
    $jobId = $this->db->insert_id();
} else {
    // Update existing job
    $document_id = $data['document_id'];

    $this->db->where('id', $document_id);
    $this->db->update('applicant_document', $detailsDoc);
}
if ($this->db->affected_rows() > 0) {
    return true;
} else {
    return false;
}

    }
}
