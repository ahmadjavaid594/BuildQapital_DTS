<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Applicants_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // moderator employee all information
    public function save($data, $role = null, $id = null)
    {
        $uploadPath = './uploads/profile_pics/';
        
        // Check if the directory exists; if not, create it with proper permissions
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true); // 0777 grants full permissions; 'true' allows recursive directory creation
        }
        
        $config['upload_path']   = $uploadPath; // Define your upload path
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp'; // Allow only PNG files
        $config['max_size']      = 1024; // Maximum file size in KB (1 MB)
        
        $this->upload->initialize($config);
        
        if (isset($_FILES['user_photo']) && $_FILES['user_photo']['name'] != '') {
            if (!$this->upload->do_upload('user_photo')) {
                // Handle upload error
                $error = $this->upload->display_errors();
                return array('status' => false, 'error' => $error);
            } else {
                // Get the uploaded file's data
                $fileData = $this->upload->data();
                $filePath = '/uploads/profile_pics/' . $fileData['file_name'];
            }
        } else {
            $filePath = isset($data['existing_file_path']) ? $data['existing_file_path'] : null; // Use existing path if no new file is uploaded
        }
        $inser_data1 = array(
            
            'name' => $data['name'],
            'sex' => $data['sex'],
            'religion' => $data['religion'],
            'blood_group' => $data['blood_group'],
            'birthday' => $data["birthday"],
            'mobileno' => $data['mobile_no'],
            'present_address' => $data['present_address'],
            'permanent_address' => $data['permanent_address'],
            'photo' => $filePath,
            'cnic' =>$data['cnic'],
            'email' => $data['email'],
            'degree' => $data['degree'],
            'father_name' => $data['father_name'],
            'city' => $data['city'],
            'province' => $data['province'],
            'district' => $data['district']

        );

        $inser_data2 = array(
            'username' => $data["email"],
            'username1' => $data["cnic"],
            'role' => 10,
        );


            // RANDOM STAFF ID GENERATE
            //$inser_data1['staff_id'] = substr(app_generate_hash(), 3, 7);
            // SAVE EMPLOYEE INFORMATION IN THE DATABASE
            $this->db->insert('applicants', $inser_data1);
            $applicantID = $this->db->insert_id();

            // SAVE EMPLOYEE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
            $inser_data2['active'] = 1;
            $inser_data2['user_id'] = $applicantID;
            $inser_data2['password'] = $this->app_lib->pass_hashed($data["password"]);
            $this->db->insert('login_credential', $inser_data2);

            // SAVE USER BANK INFORMATION IN THE DATABASE
            $this->load->model('email_model');
                $arrayData = array(
                    'username' => $data["email"], 
                    'name' => $data['name'], 
                    'login_url' => base_url('authentication'), 
                    'email' => $data['email'], 
                );
              
                $this->email_model->sentSuccessRegister($arrayData);
            return $applicantID;
     
    }


    // GET SINGLE EMPLOYEE DETAILS
    public function getSingleApplicant($id = '')
    {
      
        $this->db->select('applicants.*');
        $this->db->from('applicants');
        $this->db->where('id', $id);
     
        $query = $this->db->get();
       
        if ($query->num_rows() == 0) {
            show_404();
        }
        return $query->row_array();
    }
    public function getApplicantEducation($id = '')
    {
        $this->db->select('applicant_education.*');
        $this->db->from('applicant_education');
        $this->db->where('applicant_education.applicant_id', $id);
       
        $query = $this->db->get();
        return $query->row_array();
    }
    public function isAlreadyApplied($id, $job_id)
    {
        $this->db->select('job_applicants.*');
        $this->db->from('job_applicants');
        $this->db->where('job_applicants.applicant_id', $id);
        $this->db->where('job_applicants.job_id', $job_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    

    // get staff all list
    public function getStaffList($branchID = '', $role_id, $active = 1)
    {
        $this->db->select('staff.*,staff_designation.name as designation_name,staff_department.name as department_name,login_credential.role as role_id, roles.name as role');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != "6" and login_credential.role != "7"', 'inner');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
        if ($branchID != "") {
            $this->db->where('staff.branch_id', $branchID);
        }
        $this->db->where('login_credential.role', $role_id);
        $this->db->where('login_credential.active', $active);
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }

    public function get_schedule_by_id($id)
    {
        $this->db->select('timetable_class.*,subject.name as subject_name,class.name as class_name,section.name as section_name');
        $this->db->from('timetable_class');
        $this->db->join('subject', 'subject.id = timetable_class.subject_id', 'inner');
        $this->db->join('class', 'class.id = timetable_class.class_id', 'inner');
        $this->db->join('section', 'section.id = timetable_class.section_id', 'inner');
        $this->db->where('timetable_class.teacher_id', $id);
        $this->db->where('timetable_class.session_id', get_session_id());
        return $this->db->get();
    }

    public function applyNow($data)
    {
        $applicant_id = get_loggedin_user_id();
        $insert_data = array(
            'applicant_id' => $applicant_id,
            'job_id' => $data['job_id'],
            'status_id' => 9,
            'unique_id' =>$data['job_identifier'].rand(10000,999990)
        );
        if (isset($data['job_applicant_id'])) {
            $this->db->where('id', $data['job_id']);
            $this->db->update('job_applicants', $insert_data);
        } else {
            $this->db->insert('job_applicants', $insert_data);
            $jobApplicantId = $this->db->insert_id();
            return $jobApplicantId;
        } 
      
    }
    public function updateChallan($data)
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
      

        $applicant_id = get_loggedin_user_id();
        $applicant = $this->getSingleApplicant($applicant_id);
       
        $insert_data = array(
            'payment_date' => $data['payment_date'],
            'amount' => $data['amount'],
            'transaction_id' => $data['amount'],
            'bank_name' => $data['bank_name'],
            'status_id' => 16,
            'image_path' =>$filePath
        );
        if (isset($data['job_application_id'])) {
            $this->db->where('unique_id', $data['job_application_id']);
            $this->db->update('job_applicants', $insert_data);
            $this->load->model('email_model');
              $arrayData = array(
                'username' => $applicant['name'],
                'job_position' => $data["job_position"], 
                'company_name' => $data["company_name"],
                'institute_name' => "Domestic Testing Services",
                'email' => $applicant['email'],
                'login_url' => base_url('authentication')
            );
              
            $this->email_model->sendChallanUpdate($arrayData);
            return  $data['job_application_id'];
        } 
      
    }
    public function updateJobApplication($data)
    {
       
        
        $insert_data = array(
            'status_id' => $data['status_id'], // Always required
            'remarks' => $data['remarks'],     // Always required
            'test_schedule_id' => !empty($data['test_schedule_id']) ? $data['test_schedule_id'] : null // Handle null case
        );
        
        if (isset($data['job_application_id'])) {
            $this->db->where('unique_id', $data['job_application_id']);
            $this->db->update('job_applicants', $insert_data);
            $this->load->model('email_model');
            $arrayData = array(
                'username' => $data["name"],
                'job_position' => $data["job_position"], 
                'company_name' => $data["company_name"],
                'institute_name' => "Domestic Testing Services",
                'application_status' => $data["application_status"], 
                'email' => $data["email"], 
                'custom_message' => $data['remarks'], 
                'login_url' => base_url('authentication')
            );
           
            $this->email_model->sendJobStatusUpdate($arrayData);
            return  $data['job_application_id'];
        } 
      
    }
    public function updatePayment($data)
    {
       
        $applicant_id = get_loggedin_user_id();
    //    print_r($applicant_id);
         // $this->data['data'] = $this->status_model->getSingle('status', $id, true);
       $applicant = $this->getSingleApplicant($applicant_id);
        $insert_data = array(
            'payment_date' => $data['payment_date'],
            'amount' => $data['amount'],
            'transaction_id' => $data['transaction_id'],
            'bank_name' => $data['bank_name'],
            'status_id' => $data['status_id'],
            'image_path' =>$filePath,
            'payment_mode' =>$data['payment_mode'],
            'payment_response' =>$data['payment_response'],
            'payment_response_code'=>$data['payment_response_code']
        );

        if (isset($data['job_application_id'])) {
             

            $this->db->where('unique_id', $data['job_application_id']);
            $this->db->update('job_applicants', $insert_data);
            if($data['status_id']==16)
            {
                 $this->load->model('email_model');
                $arrayData = array(
                'username' => $applicant['name'],
                'job_position' => $data["job_position"], 
                'company_name' => $data["company_name"],
                'institute_name' => "Domestic Testing Services",
                'email' => $applicant['email'],
                'login_url' => base_url('authentication')
            );
              
            $this->email_model->sendChallanUpdate($arrayData);
            }
           
            return  $data['job_application_id'];
        } 
      
    }
    public function csvImport($row, $branchID, $userRole, $designationID, $departmentID)
    {
        $inser_data1 = array(
            'name' => $row['Name'],
            'sex' => $row['Gender'],
            'religion' => $row['Religion'],
            'blood_group' => $row['BloodGroup'],
            'birthday' => date("Y-m-d", strtotime($row['DateOfBirth'])),
            'joining_date' => date("Y-m-d", strtotime($row['JoiningDate'])),
            'qualification' => $row['Qualification'],
            'mobileno' => $row['MobileNo'],
            'present_address' => $row['PresentAddress'],
            'permanent_address' => $row['PermanentAddress'],
            'email' => $row['Email'],
            'designation' => $designationID,
            'department' => $departmentID,
            'branch_id' => $branchID,
            'photo' => 'defualt.png',
        );

        $inser_data2 = array(
            'username' => $row["Email"],
            'role' => $userRole,
        );

        // RANDOM STAFF ID GENERATE
        $inser_data1['staff_id'] = substr(app_generate_hash(), 3, 7);
        // SAVE EMPLOYEE INFORMATION IN THE DATABASE
        $this->db->insert('staff', $inser_data1);
        $employeeID = $this->db->insert_id();

        // SAVE EMPLOYEE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
        $inser_data2['active'] = 1;
        $inser_data2['user_id'] = $employeeID;
        $inser_data2['password'] = $this->app_lib->pass_hashed($row["Password"]);
        $this->db->insert('login_credential', $inser_data2);
        return true;
    }
}
