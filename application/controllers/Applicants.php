<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 
 
 
 
 * @filename : Accounting.php
 
 */

class Applicants extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('applicants_model');
        $this->load->model('profile_model');
    }

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        if (!is_applicant_loggedin()) {
            
            $this->data['title'] = 'Users';
            $this->data['sub_page'] = 'applicants/add';
            $this->data['main_menu'] = 'users';
            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /* branch information update here */
    public function edit($id = '')
    {
        $userID = get_loggedin_user_id();
        

        $loggedinRoleID = loggedin_role_id();
        if (is_superadmin_loggedin()) {
            $userID = $id;
        }
     
           
            if ($_POST) {
               
                $this->form_validation->set_rules('name', translate('name'), 'trim|required');
                $this->form_validation->set_rules('mobile_no', translate('mobile_no'), 'trim|required');
                $this->form_validation->set_rules('present_address', translate('present_address'), 'trim|required');
                $this->form_validation->set_rules('cnic', translate('cnic'), 'trim|required');
                $this->form_validation->set_rules('father_name', translate('father_name'), 'trim|required');            
                $this->form_validation->set_rules('city', translate('city'), 'trim|required');
                $this->form_validation->set_rules('province', translate('province'), 'trim|required');
                $this->form_validation->set_rules('district', translate('district'), 'trim|required');
                //$this->form_validation->set_rules('permanent_address', translate('present_address'), 'trim|required');         
                // $this->form_validation->set_rules('email', translate('email'), 'trim|required|valid_email|callback_unique_username');
                $this->form_validation->set_rules('user_photo', 'profile_picture',array(array('handle_upload', array($this->application_model, 'profilePicUpload'))));
                $data = $this->input->post();
                //print_r($data);
               // 
                if ($this->form_validation->run() == true) {
                 
                    $data = $this->input->post();
                  
                    $this->profile_model->staffUpdate($data,$userID);
                    set_alert('success', translate('information_has_been_updated_successfully'));
                    redirect(base_url('applicants/edit/'.$userID));
                }
            }
          
            $this->data['applicant'] = $this->applicants_model->getSingleApplicant($userID);
          //  print_r($this->data);
           // die;
            $this->data['sub_page'] = 'applicants/edit';
        

        $this->data['title'] = translate('profile') . " " . translate('edit');
        $this->data['main_menu'] = 'profile';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'vendor/dropify/js/dropify.min.js',
            ),
        );

        $this->load->view('layout/index', $this->data);
    }

   
    /* delete information */
    public function delete_data($id = '')
    {
        if (is_superadmin_loggedin()) {
            $this->db->where('id', $id);
            $this->db->delete('designation');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    /* unique valid branch name verification is done here */
    public function unique_name($name)
    {
        $branch_id = $this->input->post('branch_id');
        if (!empty($branch_id)) {
            $this->db->where_not_in('id', $branch_id);
        }
        $this->db->where('name', $name);
        $name = $this->db->get('branch')->num_rows();
        if ($name == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        }
    }
}
