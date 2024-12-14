<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 
 
 
 
 * @filename : Accounting.php
 
 */

class Declaration extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('applicants_model');
    }

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        //if (is_superadmin_loggedin()) {
          /*  if ($this->input->post('submit') == 'save') {
               
                $this->form_validation->set_rules('name', translate('name'), 'required|callback_unique_name');
                $this->form_validation->set_rules('description', translate('description'), 'required');
                if ($this->form_validation->run() == true) {
                
                    $post = $this->input->post();
                    $response = $this->status_model->save($post);
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('status'));
                } else {
                    $this->data['validation_error'] = true;
                }
            }*/
            $userID = get_loggedin_user_id();
            $this->data['applicant'] = $this->applicants_model->getSingleApplicant($userID);
            $this->data['title'] = 'Declaration';
            $this->data['sub_page'] = 'declaration/add';
            $this->data['main_menu'] = 'declaration';
            $this->load->view('layout/index', $this->data);
        /*} else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }*/
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
                    $response = $this->status_model->save($post, $id);
                    if ($response) {
                        set_alert('success', translate('information_has_been_updated_successfully'));
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
