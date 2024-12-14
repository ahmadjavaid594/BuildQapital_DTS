<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 
 
 
 
 * @filename : Accounting.php
 
 */

class Experience extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('experience_model');
    }

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        if (is_applicant_loggedin()) {
            if ($this->input->post('submit') == 'save') {
               
                $this->form_validation->set_rules('company', translate('company'), 'required');
                $this->form_validation->set_rules('job_title', translate('job_title'), 'required');
                $this->form_validation->set_rules('start_date', translate('start_date'), 'required');
                $this->form_validation->set_rules('end_date', translate('end_date'), 'required');
                $this->form_validation->set_rules('responsibilities', translate('responsibilities'), 'required');
                //$this->form_validation->set_rules('image_path', translate('image_path'), 'required');
                if ($this->form_validation->run() == true) {
                 
                    $post = $this->input->post();
                    $response = $this->experience_model->save($post);
                
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('experience'));
                } else {
                    $this->data['validation_error'] = true;
                }
            }
            $id = get_loggedin_user_id();
            $this->data['experiences'] = $this->experience_model->getExperienceByApplicant($id);
            $this->data['title'] = 'Experience';
            $this->data['sub_page'] = 'experience/add';
            $this->data['main_menu'] = 'experience';
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
                $this->form_validation->set_rules('company', translate('company'), 'required');
                $this->form_validation->set_rules('job_title', translate('job_title'), 'required');
                $this->form_validation->set_rules('start_date', translate('start_date'), 'required');
                $this->form_validation->set_rules('end_date', translate('end_date'), 'required');
                $this->form_validation->set_rules('responsibilities', translate('grade'), 'required');
               
              if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                   
                    $response = $this->experience_model->save($post, $id);
                    if ($response) {
                        set_alert('success', translate('information_has_been_updated_successfully'));
                    }
                    redirect(base_url('experience'));
                }
            }
           
            $this->data['data'] = $this->experience_model->getSingle('applicant_experience', $id, true);
       
            $this->data['title'] = 'Experience';
            $this->data['sub_page'] = 'experience/edit';
            $this->data['main_menu'] = 'experience';

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
            $this->db->delete('applicant_experience');
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
