<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 
 
 
 
 * @filename : Accounting.php
 
 */

class Job_type extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('job_type_model');
    }

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        if (!is_applicant_loggedin()) {
            if ($this->input->post('submit') == 'save' && is_superadmin_loggedin()) {
               
                $this->form_validation->set_rules('name', translate('name'), 'required|callback_unique_name');
                $this->form_validation->set_rules('description', translate('description'), 'required');
                if ($this->form_validation->run() == true) {
                
                    $post = $this->input->post();
                    $response = $this->job_type_model->save($post);
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('job_type'));
                } else {
                    $this->data['validation_error'] = true;
                }
            }
            $this->data['title'] = 'Job Type';
            $this->data['sub_page'] = 'job_type/add';
            $this->data['main_menu'] = 'job_type';
            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /* branch information update here */
    public function edit($id = '')
    {
        if (is_superadmin_loggedin()) {
            if ($this->input->post('submit') == 'save') {
                $this->form_validation->set_rules('name', translate('name'), 'required|callback_unique_name');
                $this->form_validation->set_rules('description', translate('description'), 'required');
              if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                    $response = $this->job_type_model->save($post, $id);
                    if ($response) {
                        set_alert('success', translate('information_has_been_updated_successfully'));
                    }
                    redirect(base_url('job_type'));
                }
            }

            $this->data['data'] = $this->job_type_model->getSingle('job_type', $id, true);
       
            $this->data['title'] = translate('job_type');
            $this->data['sub_page'] = 'job_type/edit';
            $this->data['main_menu'] = 'job_type';

            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /* delete information */
    public function delete_data($id = '')
    {
        if (is_superadmin_loggedin()) {
            $this->db->where('id', $id);
            $this->db->delete('job_type');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    /* unique valid branch name verification is done here */
    public function unique_name($name)
    {
        $job_type_id = $this->input->post('job_type_id');
        if (!empty($job_type_id)) {
            $this->db->where_not_in('id', $job_type_id);
        }
        $this->db->where('name', $name);
        $name = $this->db->get('job_type')->num_rows();
        if ($name == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        }
    }
}
