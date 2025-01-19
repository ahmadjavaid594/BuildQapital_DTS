<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Job_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function getSelectList($table) {
        // Generic method to retrieve list from a table
        $this->db->select('name,id');
        $query = $this->db->get($table);
        return $query->result_array();
    }
    public function getOrganizations() {
        return $this->getSelectList('organization');
    }

    public function getQoutas() {
        return $this->getSelectList('qouta');
    }

    public function getDesignations() {
        return $this->getSelectList('designation');
    }

    public function getJobTypes() {
        return $this->getSelectList('job_type');
    }
    public function getQualifications() {
        return $this->getSelectList('qualification');
    }


public function validateTransaction($data)
{
    $sql = "SELECT *
FROM
    job_applicants j
WHERE j.transaction_id = ?
GROUP BY j.id";

$isExist  = $this->db->query($sql, [$data['pp_TxnRefNo']])->row_array();
return $isExist;
}   

public function getReceiptDetail($applicationId) {
    $applicant_id = get_loggedin_user_id();
    $sql = "SELECT
                 j.id,q.name as qouta, o.name as organization, o.industry, l.name as location,
                d.name as designation, jt.name as job_type,  CASE j.is_active WHEN 1 THEN 'Active' ELSE 'Inactive' END as status,
                 ja.application_date,ja.applicant_id,
                 ss.name as job_status,ja.unique_id,ja.status_id, ja.payment_date, ja.amount, ja.transaction_id,ja.bank_name, ja.application_date,ja.payment_mode,j.challan_amount, ja.payment_response
            FROM
                job j
            INNER JOIN qouta q ON j.qouta_id = q.id
            INNER JOIN organization o ON j.organization_id = o.id
            INNER JOIN designation d ON j.designation_id = d.id
            INNER JOIN job_type jt ON j.job_type_id = jt.id
            INNER JOIN location l ON l.id = j.location_id
            INNER JOIN job_qualification jq ON j.id = jq.job_id
            INNER JOIN qualification qf ON jq.qualification_id = qf.id
            INNER JOIN job_applicants ja ON ja.job_id = j.id AND ja.applicant_id = $applicant_id
            INNER JOIN status ss ON ja.status_id = ss.id
            WHERE ja.unique_id='$applicationId'";

    return $this->db->query($sql)->row_array();
}
public function validateTransaction1($transactionNo)
{
    $sql = "SELECT *
FROM
    job_applicants j
WHERE j.transaction_id = ?
GROUP BY j.id";

$isExist  = $this->db->query($sql, $transactionNo)->row_array();
return $isExist;
}  
public function updatePaymentIPN($data)
{
    $sql = "SELECT *
FROM
    job_applicants j
WHERE j.transaction_id = ?
GROUP BY j.id";

$isExist  = $this->db->query($sql, [$data['pp_TxnRefNo']])->row_array();
        
if($isExist)
{
    $insert_data = array(
        'ipn_payment_date' => $data['ipn_payment_date'],
        'ipn_pp_TxnType' => $data['ipn_pp_TxnType'],
        'ipn_pp_responseCode' => $data['ipn_pp_responseCode'],
        'ipn_pp_responseMessage' => $data['ipn_pp_responseMessage'],
        'ipn_pp_response' =>  $data['ipn_pp_response'],
        'status_id' => $data['status_id']
    );
    $this->db->where('transaction_id', $data['pp_TxnRefNo']);
    $this->db->update('job_applicants', $insert_data);
}     
return  $data['pp_TxnRefNo'];


      
      
}
public function getJobDetails($job_id) {
    $sql = "SELECT
                j.*, q.name as qouta, o.name as organization, o.industry, l.name as location,
                d.name as designation, jt.name as job_type, GROUP_CONCAT(qf.name SEPARATOR ', ') as qualifications,  CASE j.is_active WHEN 1 THEN 'Active' ELSE 'Inactive' END as status, j.identifier
            FROM
                job j
            INNER JOIN qouta q ON j.qouta_id = q.id
            INNER JOIN organization o ON j.organization_id = o.id
            INNER JOIN designation d ON j.designation_id = d.id
            INNER JOIN job_type jt ON j.job_type_id = jt.id
            INNER JOIN location l ON l.id = j.location_id
            INNER JOIN job_qualification jq ON j.id = jq.job_id
            INNER JOIN qualification qf ON jq.qualification_id = qf.id
            WHERE j.id = ?
            GROUP BY j.id order by j.is_active desc,j.id asc ";

    return $this->db->query($sql, [$job_id])->row_array();
}
public function getAllJobsList() {
    $sql = "SELECT
                j.id,d.name as designation
            FROM
                job j
            INNER JOIN qouta q ON j.qouta_id = q.id
            INNER JOIN organization o ON j.organization_id = o.id
            INNER JOIN designation d ON j.designation_id = d.id";
    return $this->db->query($sql)->result_array();
}
public function getJobDetailsUser($job_id) {
    $applicant_id = get_loggedin_user_id();
    $sql = "SELECT
                j.*, q.name as qouta, o.name as organization, o.industry, l.name as location,
                d.name as designation, jt.name as job_type, GROUP_CONCAT(qf.name SEPARATOR ', ') as qualifications,  CASE j.is_active WHEN 1 THEN 'Active' ELSE 'Inactive' END as status,
                 ja.application_date,
                 ss.name as job_status,ja.unique_id,ja.status_id,j.identifier,j.challan_amount
            FROM
                job j
            INNER JOIN qouta q ON j.qouta_id = q.id
            INNER JOIN organization o ON j.organization_id = o.id
            INNER JOIN designation d ON j.designation_id = d.id
            INNER JOIN job_type jt ON j.job_type_id = jt.id
            INNER JOIN location l ON l.id = j.location_id
            INNER JOIN job_qualification jq ON j.id = jq.job_id
            INNER JOIN qualification qf ON jq.qualification_id = qf.id
            LEFT JOIN job_applicants ja ON ja.job_id = j.id AND ja.applicant_id = $applicant_id
            LEFT JOIN status ss ON ja.status_id = ss.id 
            WHERE j.id = ?
            GROUP BY j.id order by j.is_active desc,j.id asc";

    return $this->db->query($sql, [$job_id])->row_array();
}


public function getChallans() {
    $applicant_id = get_loggedin_user_id();
    $sql = "SELECT
                j.*, q.name as qouta, o.name as organization, o.industry, l.name as location,
                d.name as designation, jt.name as job_type,  CASE j.is_active WHEN 1 THEN 'Active' ELSE 'Inactive' END as status,
                 ja.application_date,
                 ss.name as job_status,ja.unique_id,ja.status_id, ja.payment_date, ja.amount, ja.transaction_id,ja.bank_name, ja.application_date, ja.remarks,ja.payment_mode
            FROM
                job j
            INNER JOIN qouta q ON j.qouta_id = q.id
            INNER JOIN organization o ON j.organization_id = o.id
            INNER JOIN designation d ON j.designation_id = d.id
            INNER JOIN job_type jt ON j.job_type_id = jt.id
            INNER JOIN location l ON l.id = j.location_id
            INNER JOIN job_applicants ja ON ja.job_id = j.id AND ja.applicant_id = $applicant_id
            INNER JOIN status ss ON ja.status_id = ss.id 
            WHERE ja.status_id in (9,16)";

    return $this->db->query($sql)->result_array();
}

public function getResults() {
    $applicant_id = get_loggedin_user_id();
    $sql = "SELECT
                j.*, q.name as qouta, o.name as organization, o.industry, l.name as location,
                d.name as designation, jt.name as job_type,  CASE j.is_active WHEN 1 THEN 'Active' ELSE 'Inactive' END as status,
                 ja.application_date,
                 ss.name as job_status,ja.unique_id,ja.status_id, ja.payment_date, ja.amount, ja.transaction_id,ja.bank_name, ja.application_date, ja.remarks,ja.payment_mode, trs.marks_obtained,trs.total_marks, trs.status as test_status, trs.remarks as test_remarks
            FROM
                job j
            INNER JOIN qouta q ON j.qouta_id = q.id
            INNER JOIN organization o ON j.organization_id = o.id
            INNER JOIN designation d ON j.designation_id = d.id
            INNER JOIN job_type jt ON j.job_type_id = jt.id
            INNER JOIN location l ON l.id = j.location_id
            INNER JOIN job_applicants ja ON ja.job_id = j.id AND ja.applicant_id = $applicant_id
            INNER JOIN status ss ON ja.status_id = ss.id 
            LEFT Join test_result_records trs ON ja.unique_id = trs.roll_no
            WHERE ja.status_id in (14)";

    return $this->db->query($sql)->result_array();
}


public function getJobsSyllabus() {
    $applicant_id = get_loggedin_user_id();
    $sql = "SELECT
                j.syllabus_file_path, o.name as organization,
                d.name as designation
            FROM
                job j
            INNER JOIN qouta q ON j.qouta_id = q.id
            INNER JOIN organization o ON j.organization_id = o.id
            INNER JOIN designation d ON j.designation_id = d.id
            INNER JOIN job_type jt ON j.job_type_id = jt.id
            INNER JOIN location l ON l.id = j.location_id
            INNER JOIN job_applicants ja ON ja.job_id = j.id AND ja.applicant_id = $applicant_id
            INNER JOIN status ss ON ja.status_id = ss.id 
            WHERE ja.status_id in (9,16)";

    return $this->db->query($sql)->result_array();
}
public function getRollnoSlips() {
    $applicant_id = get_loggedin_user_id();
    $sql = "SELECT
                j.*, q.name as qouta, o.name as organization, o.industry, l.name as location,
                d.name as designation, jt.name as job_type,  CASE j.is_active WHEN 1 THEN 'Active' ELSE 'Inactive' END as status,
                 ja.application_date,
                 ss.name as job_status,ja.unique_id,ja.status_id, ja.payment_date, ja.amount, ja.transaction_id,ja.bank_name, ja.application_date, ja.remarks,ts.name as schedule_name,tc.name as center,ts.date,ts.start_time,ts.end_time
            FROM
                job j
            INNER JOIN qouta q ON j.qouta_id = q.id
            INNER JOIN organization o ON j.organization_id = o.id
            INNER JOIN designation d ON j.designation_id = d.id
            INNER JOIN job_type jt ON j.job_type_id = jt.id
            INNER JOIN location l ON l.id = j.location_id
            INNER JOIN job_applicants ja ON ja.job_id = j.id AND ja.applicant_id = $applicant_id
            INNER JOIN status ss ON ja.status_id = ss.id 
            INNER JOIN test_schedule ts ON ja.test_schedule_id = ts.id
            INNER JOIN test_centers tc on ts.test_center_id = tc.id
            WHERE ja.status_id in (12)";

    return $this->db->query($sql)->result_array();
}

public function getApplications() {

    $sql = "SELECT
                j.*, q.name as qouta, o.name as organization, o.industry, l.name as location,
                d.name as designation, jt.name as job_type,  CASE j.is_active WHEN 1 THEN 'Active' ELSE 'Inactive' END as status,
                 ja.application_date,
                 ss.name as job_status,ja.unique_id,ja.status_id, ja.payment_date, ja.amount, ja.transaction_id,ja.bank_name, ja.application_date,
                 a.name as applicant_name, a.cnic, a.mobileno, a.birthday, a.sex,a.email,ja.remarks,ja.image_path
            FROM
                job j
            INNER JOIN qouta q ON j.qouta_id = q.id
            INNER JOIN organization o ON j.organization_id = o.id
            INNER JOIN designation d ON j.designation_id = d.id
            INNER JOIN job_type jt ON j.job_type_id = jt.id
            INNER JOIN location l ON l.id = j.location_id
            INNER JOIN job_qualification jq ON j.id = jq.job_id
            INNER JOIN qualification qf ON jq.qualification_id = qf.id
            INNER JOIN job_applicants ja ON ja.job_id = j.id
            INNER JOIN status ss ON ja.status_id = ss.id
            INNER JOIN applicants a on ja.applicant_id = a.id";

    return $this->db->query($sql)->result_array();
}
public function getApplicationDetail($applicationId) {

    $sql = "SELECT
                 a.*,q.name as qouta, o.name as organization, o.industry, l.name as location,
                d.name as designation, jt.name as job_type,  CASE j.is_active WHEN 1 THEN 'Active' ELSE 'Inactive' END as status,
                 ja.application_date,ja.image_path,
                 ss.name as job_status,ja.unique_id,ja.status_id, ja.payment_date, ja.amount, ja.transaction_id,ja.bank_name, ja.application_date, j.challan_amount,ts.name as schedule_name,tc.name as center,ts.date,ts.start_time,ts.end_time
            FROM
                job j
            INNER JOIN qouta q ON j.qouta_id = q.id
            INNER JOIN organization o ON j.organization_id = o.id
            INNER JOIN designation d ON j.designation_id = d.id
            INNER JOIN job_type jt ON j.job_type_id = jt.id
            INNER JOIN location l ON l.id = j.location_id
            INNER JOIN job_qualification jq ON j.id = jq.job_id
            INNER JOIN qualification qf ON jq.qualification_id = qf.id
            INNER JOIN job_applicants ja ON ja.job_id = j.id
            INNER JOIN applicants a on ja.applicant_id = a.id
            INNER JOIN status ss ON ja.status_id = ss.id
            LEFT JOIN test_schedule ts ON ja.test_schedule_id = ts.id
            LEFT JOIN test_centers tc on ts.test_center_id = tc.id
            WHERE ja.unique_id='$applicationId'";

    return $this->db->query($sql)->row_array();
}

public function getChallanDetail($applicationId) {
    $applicant_id = get_loggedin_user_id();
    $sql = "SELECT
                j.*, q.name as qouta, o.name as organization, o.industry, l.name as location,
                d.name as designation, jt.name as job_type,  CASE j.is_active WHEN 1 THEN 'Active' ELSE 'Inactive' END as status,
                 ja.application_date,
                 ss.name as job_status,ja.unique_id,ja.status_id, ja.payment_date, ja.amount, ja.transaction_id,ja.bank_name, ja.application_date,ja.payment_mode,j.challan_amount
            FROM
                job j
            INNER JOIN qouta q ON j.qouta_id = q.id
            INNER JOIN organization o ON j.organization_id = o.id
            INNER JOIN designation d ON j.designation_id = d.id
            INNER JOIN job_type jt ON j.job_type_id = jt.id
            INNER JOIN location l ON l.id = j.location_id
            INNER JOIN job_applicants ja ON ja.job_id = j.id AND ja.applicant_id = $applicant_id
            INNER JOIN status ss ON ja.status_id = ss.id
            WHERE ja.status_id in (9,16) and ja.unique_id='$applicationId'";

    return $this->db->query($sql)->row_array();
}
    public function getJobsList($filter = [], $limit = 1000, $offset = 0) {
        // Base SQL query
        $sql = "SELECT
            q.name as qouta,
            o.name as organization,
            o.industry,
            l.name as location,
            j.description,
            j.no_of_positions,
            d.name as designation,
            j.job_start_date,
            j.job_end_date,
            j.age_limit_start,
            j.age_limit_end,
            jt.name as job_type,
            j.unique_id as job_id,
            j.id,
            j.job_file_path,
            CASE j.is_active WHEN 1 THEN 'Active' ELSE 'Inactive' END as status,
            GROUP_CONCAT(qf.name SEPARATOR ', ') as qualifications
        FROM
            job j
        INNER JOIN qouta q ON j.qouta_id = q.id
        INNER JOIN organization o ON j.organization_id = o.id
        INNER JOIN designation d ON j.designation_id = d.id
        INNER JOIN job_type jt ON j.job_type_id = jt.id
        INNER JOIN location l ON l.id = j.location_id
        INNER JOIN job_qualification jq ON j.id = jq.job_id
        INNER JOIN qualification qf ON jq.qualification_id = qf.id
        WHERE 1=1";  // Start with a generic condition for filtering
        
        // Adding dynamic filters
        if (isset($filter['status'])) {
            if($filter['status']=='active')
            {
                $sql .= " AND ifnull(j.is_active,0) = 1" ;
            }
            else{
                $sql .= " AND ifnull(j.is_active,0) = 0";
            }
            
        }
 
        if (!empty($filter['location'])) {
            $sql .= " AND l.name LIKE " . $this->db->escapeLike('%' . $filter['location'] . '%');
        }
    
        if (!empty($filter['organization'])) {
            $sql .= " AND o.id = " . (int)$filter['organization'];
        }
    
        if (!empty($filter['qouta'])) {
            $sql .= " AND q.id = " . (int)$filter['qouta'];
        }
    
        if (!empty($filter['designation'])) {
            $sql .= " AND d.id = " . (int)$filter['designation'];
        }
    
        if (!empty($filter['job_type'])) {
            $sql .= " AND jt.id = " . (int)$filter['job_type'];
        }
    
        if (!empty($filter['qualification'])) {
            $sql .= " AND qf.id = " . (int)$filter['qualification'];
        }
    
        // Grouping and limiting the results
        $sql .= " GROUP BY j.id order by j.is_active desc,j.id asc";
        $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
    
        // Execute the query and return the results
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function getResultsList() {
        // Base SQL query
        $sql = "SELECT
            distinct j.id,o.name as organization, d.name as designation
        FROM
            job j
        INNER JOIN organization o ON j.organization_id = o.id
        INNER JOIN designation d ON j.designation_id = d.id
        INNER JOIN test_result_records x ON x.job_id = j.id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function getJobsListUser($filter = [], $limit = 1000, $offset = 0) {
        $applicant_id = get_loggedin_user_id();
        // Base SQL query
        $sql = "SELECT
            q.name as qouta,
            o.name as organization,
            o.industry,
            l.name as location,
            j.description,
            j.no_of_positions,
            d.name as designation,
            j.job_start_date,
            j.job_end_date,
            j.age_limit_start,
            j.age_limit_end,
            jt.name as job_type,
            j.unique_id as job_id,
            j.id,
            j.job_file_path,
            CASE j.is_active WHEN 1 THEN 'Active' ELSE 'Inactive' END as status,
            GROUP_CONCAT(qf.name SEPARATOR ', ') as qualifications,
            ja.application_date,
            ss.name as job_status,
            ja.unique_id,
            ja.status_id,
            j.identifier,
            j.challan_amount

        FROM
            job j
        INNER JOIN qouta q ON j.qouta_id = q.id
        INNER JOIN organization o ON j.organization_id = o.id
        INNER JOIN designation d ON j.designation_id = d.id
        INNER JOIN job_type jt ON j.job_type_id = jt.id
        INNER JOIN location l ON l.id = j.location_id
        INNER JOIN job_qualification jq ON j.id = jq.job_id
        INNER JOIN qualification qf ON jq.qualification_id = qf.id
        LEFT JOIN job_applicants ja ON ja.job_id = j.id AND ja.applicant_id = $applicant_id
        LEFT JOIN status ss ON ja.status_id = ss.id 
        WHERE 1=1";  // Start with a generic condition for filtering
        
        // Adding dynamic filters
        if (isset($filter['status'])) {
            if($filter['status']=='active')
            {
                $sql .= " AND ifnull(j.is_active,0) = 1" ;
            }
            else{
                $sql .= " AND ifnull(j.is_active,0) = 0";
            }
            
        }
 
        if (!empty($filter['location'])) {
            $sql .= " AND l.name LIKE " . $this->db->escapeLike('%' . $filter['location'] . '%');
        }
    
        if (!empty($filter['organization'])) {
            $sql .= " AND o.id = " . (int)$filter['organization'];
        }
    
        if (!empty($filter['qouta'])) {
            $sql .= " AND q.id = " . (int)$filter['qouta'];
        }
    
        if (!empty($filter['designation'])) {
            $sql .= " AND d.id = " . (int)$filter['designation'];
        }
    
        if (!empty($filter['job_type'])) {
            $sql .= " AND jt.id = " . (int)$filter['job_type'];
        }
    
        if (!empty($filter['qualification'])) {
            $sql .= " AND qf.id = " . (int)$filter['qualification'];
        }
    
        // Grouping and limiting the results
        $sql .= " GROUP BY j.id order by j.is_active desc,j.id asc";
        $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
    
        // Execute the query and return the results
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getTotalJobsCount($filter = []) {
        // Base SQL query
        $sql = "SELECT COUNT(DISTINCT j.id) as total_jobs
            FROM job j
        INNER JOIN qouta q ON j.qouta_id = q.id
        INNER JOIN organization o ON j.organization_id = o.id
        INNER JOIN designation d ON j.designation_id = d.id
        INNER JOIN job_type jt ON j.job_type_id = jt.id
        INNER JOIN location l ON l.id = j.location_id
        INNER JOIN job_qualification jq ON j.id = jq.job_id
        INNER JOIN qualification qf ON jq.qualification_id = qf.id
        WHERE 1=1";  // Start with a generic condition for filtering
        
        // Adding dynamic filters
        if (isset($filter['status'])) {
            if($filter['status']=='active')
            {
                $sql .= " AND ifnull(j.is_active,0) = 1" ;
            }
            else{
                $sql .= " AND ifnull(j.is_active,0) = 0";
            }
            
        }

        if (!empty($filter['location'])) {
            $sql .= " AND l.name LIKE " . $this->db->escapeLike('%' . $filter['location'] . '%');
        }
    
        if (!empty($filter['organization'])) {
            $sql .= " AND o.id = " . (int)$filter['organization'];
        }
    
        if (!empty($filter['qouta'])) {
            $sql .= " AND q.id = " . (int)$filter['qouta'];
        }
    
        if (!empty($filter['designation'])) {
            $sql .= " AND d.id = " . (int)$filter['designation'];
        }
    
        if (!empty($filter['job_type'])) {
            $sql .= " AND jt.id = " . (int)$filter['job_type'];
        }
    
        if (!empty($filter['qualification'])) {
            $sql .= " AND qf.id = " . (int)$filter['qualification'];
        }
    
        // Execute the query to get total count
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result['total_jobs'];
    }
    
    
    public function save($data)
    {
$config['upload_path']   = './uploads/job_files/'; // Define your upload path
$config['allowed_types'] = 'pdf'; // Allow only PDF files
$config['max_size']      = 1024; // Maximum file size in KB (1 MB)

$this->upload->initialize($config);

if (isset($_FILES['add_file']) && $_FILES['add_file']['name'] != '') {
    if (!$this->upload->do_upload('add_file')) {
        // Handle upload error
        $error = $this->upload->display_errors();
        return array('status' => false, 'error' => $error);
    } else {
        // Get the uploaded file's data
        $fileData = $this->upload->data();
        $filePath = 'uploads/job_files/' . $fileData['file_name'];
    }
} else {
    $filePath = isset($data['existing_file_path']) ? $data['existing_file_path'] : null; // Use existing path if no new file is uploaded
}
$config['upload_path']   = './uploads/job_files/'; // Define your upload path
$config['allowed_types'] = 'jpg|jpeg|png|gif|webp'; // Allow only PNG files
$config['max_size']      = 1024; // Maximum file size in KB (1 MB)

$this->upload->initialize($config);

if (isset($_FILES['syllabus_file']) && $_FILES['syllabus_file']['name'] != '') {
    if (!$this->upload->do_upload('syllabus_file')) {
        // Handle upload error
        $error = $this->upload->display_errors();
        return array('status' => false, 'error' => $error);
    } else {
        // Get the uploaded file's data
        $fileData1 = $this->upload->data();
        $filePath1 = 'uploads/job_files/' . $fileData1['file_name'];
    }
} else {
    $filePath1 = isset($data['existing_file_path']) ? $data['existing_file_path'] : null; // Use existing path if no new file is uploaded
}

$is_active = !empty($data['is_active']) ? 1 : 0;

$addUniqueId = "O".$data['organization_id']."-"."Q".$data['qouta_id']."J".$data['job_type_id']."N".rand(0,1000);

$detailsJob = array(
    'organization_id' => $data['organization_id'],
    'qouta_id' => $data['qouta_id'],
    'job_type_id' => $data['job_type_id'],
    'designation_id' => $data['designation_id'],
    'location_id' => $data['location_id'],
    'description' => $data['description'],
    'job_start_date' => $data['start_date'],
    'job_end_date' => $data['end_date'],
    'no_of_positions' => $data['no_of_positions'],
    'age_limit_start' => $data['age_limit_start'],
    'age_limit_end' => $data['age_limit_end'],
    'challan_amount' => $data['challan_amount'],
    'job_file_path' => $filePath,
    'syllabus_file_path'=>$filePath1,
    'unique_id' => $addUniqueId,
    'is_active' => $is_active
);

if (empty($data['job_id'])) {
    // Insert new job
    $this->db->insert('job', $detailsJob);
    $jobId = $this->db->insert_id();
} else {
    // Update existing job
    $jobId = $data['job_id'];
    $this->db->where('id', $jobId);
    $this->db->update('job', $detailsJob);
}

// Update qualifications
$this->db->where('job_id', $jobId);
$this->db->delete('job_qualification'); // Remove existing qualifications

foreach ($data['qualifications'] as $qual) {
    $qualificationData = array('job_id' => $jobId, 'qualification_id' => $qual);
    $this->db->insert('job_qualification', $qualificationData);
}

if ($this->db->affected_rows() > 0) {
    return true;
} else {
    return false;
}

    }
}
