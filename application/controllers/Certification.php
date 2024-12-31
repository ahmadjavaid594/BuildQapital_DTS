<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 
 
 
 
 * @filename : Accounting.php
 
 */

class Certification extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('certification_model');
    }

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        if (is_applicant_loggedin()) {
            if ($this->input->post('submit') == 'save') {
               
                $this->form_validation->set_rules('certification_name', translate('certification_name'), 'required');
                $this->form_validation->set_rules('issued_by', translate('issued_by'), 'required');
                $this->form_validation->set_rules('issue_date', translate('issue_date'), 'required');
                $this->form_validation->set_rules('expiration_date', translate('expiration_date'), 'required');
                $this->form_validation->set_rules('credential_id', translate('credential_id'), 'required');
                //$this->form_validation->set_rules('image_path', translate('image_path'), 'required');
                if ($this->form_validation->run() == true) {
                 
                    $post = $this->input->post();
                    $response = $this->certification_model->save($post);
                
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('certification'));
                } else {
                    $this->data['validation_error'] = true;
                }
            }
            $id = get_loggedin_user_id();
            
            $this->data['certifications'] = $this->certification_model->getCertificationsByApplicant($id);
            $this->data['title'] = 'Certification';
            $this->data['sub_page'] = 'certifications/add';
            $this->data['main_menu'] = 'certification';
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
                $this->form_validation->set_rules('certification_name', translate('certification_name'), 'required');
                $this->form_validation->set_rules('issued_by', translate('issued_by'), 'required');
                $this->form_validation->set_rules('issue_date', translate('issue_date'), 'required');
                $this->form_validation->set_rules('expiration_date', translate('expiration_date'), 'required');
                $this->form_validation->set_rules('credential_id', translate('credential_id'), 'required');
               
              if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                   
                    $response = $this->certification_model->save($post, $id);
                    if ($response) {
                        set_alert('success', translate('information_has_been_updated_successfully'));
                    }
                    redirect(base_url('certification'));
                }
            }
           
            $this->data['data'] = $this->certification_model->getSingle('applicant_certifications', $id, true);
       
            $this->data['title'] = 'Certification';
            $this->data['sub_page'] = 'certifications/edit';
            $this->data['main_menu'] = 'certification';

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
            $this->db->delete('applicant_certifications');
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
