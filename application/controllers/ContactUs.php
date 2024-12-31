<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 
 
 
 
 * @filename : Accounting.php
 
 */

class ContactUs extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('contact_us_model');
        $this->load->model('Job_model');
    }

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        if (is_applicant_loggedin()||is_superadmin_loggedin()) {
            if ($this->input->post('submit') == 'save') {
                $this->form_validation->set_rules('position', translate('position'), 'required');
                $this->form_validation->set_rules('query', translate('query'), 'required');
              
                if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                    $response = $this->contact_us_model->save($post, $id);
                    if ($response) {
                        set_alert('success', 'Thanks for reaching out, we will get back to you as soon as possible');
                    }
                    redirect(base_url('contactUs'));
                }
            }
            $userID = get_loggedin_user_id();
            $this->data['title'] = 'Queries';
            $this->data['jobs'] = $this->Job_model->getAllJobsList('job');
            $this->data['sub_page'] = 'contactus/add';
            $this->data['main_menu'] = 'contactUs';
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
                $this->form_validation->set_rules('name', translate('name'), 'required');
                $this->form_validation->set_rules('cnic', translate('cnic'), 'required');
                $this->form_validation->set_rules('mobile', translate('mobile'), 'required');
                $this->form_validation->set_rules('position', translate('position'), 'required');
                $this->form_validation->set_rules('query', translate('query'), 'required');
              
                if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                    $response = $this->status_model->save($post, $id);
                    if ($response) {
                        set_alert('success', 'Thanks for reaching out, we will get back to you as soon as possible');
                    }
                    redirect(base_url('status'));
                }
            }

            $this->data['data'] = $this->status_model->getSingle('status', $id, true);
       
            $this->data['title'] = 'Status';
            $this->data['sub_page'] = 'status/edit';
            $this->data['main_menu'] = 'status';

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
            $this->db->delete('status');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    /* unique valid branch name verification is done here */
    public function unique_name($name)
    {
        $status_id = $this->input->post('status_id');
        if (!empty($status_id)) {
            $this->db->where_not_in('id', $status_id);
        }
        $this->db->where('name', $name);
        $name = $this->db->get('status')->num_rows();
        if ($name == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        }
    }
}
