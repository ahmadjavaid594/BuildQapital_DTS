<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 
 
 
 
 * @filename : Accounting.php
 
 */

class Education extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('education_model');
    }

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        if (is_applicant_loggedin()) {
            if ($this->input->post('submit') == 'save') {
               
                $this->form_validation->set_rules('institution', translate('institution'), 'required');
                $this->form_validation->set_rules('degree', translate('degree'), 'required');
                $this->form_validation->set_rules('field_of_study', translate('field_of_study'), 'required');
                $this->form_validation->set_rules('start_date', translate('start_date'), 'required');
                $this->form_validation->set_rules('end_date', translate('end_date'), 'required');
                $this->form_validation->set_rules('total_marks', translate('total_marks'), 'required');
                $this->form_validation->set_rules('obtained_marks', translate('obtained_marks'), 'required');
                $this->form_validation->set_rules('grade', translate('grade'), 'required');
                //$this->form_validation->set_rules('image_path', translate('image_path'), 'required');
                if ($this->form_validation->run() == true) {
                
                    $post = $this->input->post();
                    $response = $this->education_model->save($post);
                
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('education'));
                } else {
                    $this->data['validation_error'] = true;
                }
            }
            $id = get_loggedin_user_id();
            $this->data['educations'] = $this->education_model->getEducationByApplicant($id);
            $this->data['title'] = 'Education';
            $this->data['sub_page'] = 'education/add';
            $this->data['main_menu'] = 'education';
            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /* branch information update here */
    public function edit($id = '')
    {
        if (is_applicant_loggedin()) {
            $data = $this->input->post();
         
            if ($this->input->post('submit') == 'update') {
                $this->form_validation->set_rules('institution', translate('institution'), 'required');
                $this->form_validation->set_rules('degree', translate('degree'), 'required');
                $this->form_validation->set_rules('field_of_study', translate('field_of_study'), 'required');
                $this->form_validation->set_rules('start_date', translate('start_date'), 'required');
                $this->form_validation->set_rules('end_date', translate('end_date'), 'required');
                $this->form_validation->set_rules('total_marks', translate('total_marks'), 'required');
                $this->form_validation->set_rules('obtained_marks', translate('obtained_marks'), 'required');
                $this->form_validation->set_rules('grade', translate('grade'), 'required');
               
              if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                   
                    $response = $this->education_model->save($post, $id);
                    if ($response) {
                        set_alert('success', translate('information_has_been_updated_successfully'));
                    }
                    redirect(base_url('education'));
                }
            }
           
            $this->data['data'] = $this->education_model->getSingle('applicant_education', $id, true);
       
            $this->data['title'] = translate('education');
            $this->data['sub_page'] = 'education/edit';
            $this->data['main_menu'] = 'education';

            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /* delete information */
    public function delete_data($id = '')
    {
        if (is_applicant_loggedin()) {
            $this->db->where('id', $id);
            $this->db->delete('applicant_education');
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
