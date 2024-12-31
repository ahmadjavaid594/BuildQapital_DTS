<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 
 
 
 
 * @filename : Accounting.php
 
 */

class Qouta extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('qouta_model');
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
                    $response = $this->qouta_model->save($post);
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('qouta'));
                } else {
                    $this->data['validation_error'] = true;
                }
            }
            $this->data['title'] = 'Qouta';
            $this->data['sub_page'] = 'qouta/add';
            $this->data['main_menu'] = 'qouta';
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
                    $response = $this->qouta_model->save($post, $id);
                    if ($response) {
                        set_alert('success', translate('information_has_been_updated_successfully'));
                    }
                    redirect(base_url('qouta'));
                }
            }

            $this->data['data'] = $this->qouta_model->getSingle('qouta', $id, true);
       
            $this->data['title'] = 'Qouta';
            $this->data['sub_page'] = 'qouta/edit';
            $this->data['main_menu'] = 'qouta';

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
            $this->db->delete('qouta');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    /* unique valid branch name verification is done here */
    public function unique_name($name)
    {
        $qouta_id = $this->input->post('qouta_id');
        if (!empty($qouta_id)) {
            $this->db->where_not_in('id', $qouta_id);
        }
        $this->db->where('name', $name);
        $name = $this->db->get('qouta')->num_rows();
        if ($name == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        }
    }
}
