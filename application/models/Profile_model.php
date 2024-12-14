<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Profile_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // moderator staff all information
    public function staffUpdate($data,$userID="")
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

        if (!is_superadmin_loggedin()) {
            $userID = get_loggedin_user_id();
        }
        $update_data = array(
            'name' => $data['name'],
            'sex' => $data['sex'],
            'religion' => $data['religion'],
            'blood_group' => $data['blood_group'],
            'birthday' => $data["birthday"],
            'mobileno' => $data['mobile_no'],
            'present_address' => $data['present_address'],
            'permanent_address' => $data['permanent_address'],
            'cnic'=>$data['cnic'],
            'email'=>$data['email'],
            'photo' => $filePath,
            'father_name' => $data['father_name'],
            'city'=>$data['city'],
            'district'=>$data['district'],
            'province' => $data['province']
        );
        
        // UPDATE ALL INFORMATION IN THE DATABASE
        $this->db->where('id', $userID);
        $this->db->update('applicants', $update_data);

        // UPDATE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
        if(isset($data['password']))
        {
            $logins = array(
                'username'=>$data['email'],
                'password'=> $this->app_lib->pass_hashed($data['password']));
        }
        else{
            $logins = array(
                'username'=>$data['email']);
        }
        
        
        // update login credential information in the database
        $this->db->where('user_id', $userID);
        $this->db->where('role', 10);
        $this->db->update('login_credential', $logins);
    }


   

    // moderator staff all information
    public function parentUpdate($data)
    {
        $update_data = array(
            'name' => $data['name'],
            'relation' => $data['relation'],
            'father_name' => $data['father_name'],
            'mother_name' => $data['mother_name'],
            'occupation' => $data['occupation'],
            'income' => $data['income'],
            'education' => $data['education'],
            'email' => $data['email'],
            'mobileno' => $data['mobileno'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'photo' => $this->uploadImage('parent'),
            'facebook_url' => $data['facebook'],
            'linkedin_url' => $data['linkedin'],
            'twitter_url' => $data['twitter'],
        );

        // UPDATE ALL INFORMATION IN THE DATABASE
        $this->db->where('id', get_loggedin_user_id());
        $this->db->update('parent', $update_data);

        // UPDATE LOGIN CREDENTIAL INFORMATION IN THE DATABASE

        $this->db->where('user_id', get_loggedin_user_id());
        $this->db->where('role', 6);
        $this->db->update('login_credential', array('username' => $data['email']));
    }
}
