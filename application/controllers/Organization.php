<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 
 
 
 
 * @filename : Accounting.php
 
 */

class Organization extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('organization_model');
    }

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        if (is_superadmin_loggedin()) {
            if ($this->input->post('submit') == 'save') {
               
                $this->form_validation->set_rules('name', translate('name'), 'required|callback_unique_name');
                $this->form_validation->set_rules('industry', translate('industry'), 'required');
                $this->form_validation->set_rules('website', translate('website'), 'required');
                $this->form_validation->set_rules('email', translate('email'), 'required');
                $this->form_validation->set_rules('location', translate('location'), 'required');
                $this->form_validation->set_rules('description', translate('description'), 'required');
                $this->form_validation->set_rules('company_size', translate('company_size'), 'required');
                if ($this->form_validation->run() == true) {
                
                    $post = $this->input->post();
                    $response = $this->organization_model->save($post);
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('organization'));
                } else {
                    $this->data['validation_error'] = true;
                }
            }
            $this->data['title'] = 'Organization';
            $this->data['sub_page'] = 'organization/add';
            $this->data['main_menu'] = 'organization';
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
                $this->form_validation->set_rules('industry', translate('industry'), 'required');
                $this->form_validation->set_rules('website', translate('website'), 'required');
                $this->form_validation->set_rules('email', translate('email'), 'required');
                $this->form_validation->set_rules('location', translate('location'), 'required');
                $this->form_validation->set_rules('description', translate('description'), 'required');
                $this->form_validation->set_rules('company_size', translate('company_size'), 'required');
                if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                    $response = $this->organization_model->save($post, $id);
                    if ($response) {
                        set_alert('success', translate('information_has_been_updated_successfully'));
                    }
                    redirect(base_url('organization'));
                }
            }

            $this->data['data'] = $this->organization_model->getSingle('organization', $id, true);
       
            $this->data['title'] = translate('organization');
            $this->data['sub_page'] = 'organization/edit';
            $this->data['main_menu'] = 'organization';

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
            $this->db->delete('organization');
        } else {
            redirect(base_url(), 'refresh');
        }
    }
   
    /* unique valid branch name verification is done here */
    public function unique_name($name)
    {
        $organization_id = $this->input->post('organization_id');
        if (!empty($organization_id)) {
            $this->db->where_not_in('id', $organization_id);
        }
        $this->db->where('name', $name);
        $name = $this->db->get('organization')->num_rows();
        if ($name == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        }
    }
}
