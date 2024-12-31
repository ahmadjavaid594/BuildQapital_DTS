<?php
defined('BASEPATH') or exit('No direct script access allowed');
class District extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('district_model');
    }

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        if (is_superadmin_loggedin()) {
            if ($this->input->post('submit') == 'save') {
               
                $this->form_validation->set_rules('name', translate('name'), 'required|callback_unique_name');
                $this->form_validation->set_rules('province_name', translate('Province'), 'required');
                
                if ($this->form_validation->run() == true) {
                
                    $post = $this->input->post();
                    $response = $this->district_model->save($post);
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('district'));
                } else {
                    $this->data['validation_error'] = true;
                }
            }
            $this->data['title'] = 'District';
            $this->data['sub_page'] = 'district/add';
            $this->data['main_menu'] = 'district';
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
                $this->form_validation->set_rules('province_name', translate('Province'), 'required');
              if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                    $response = $this->district_model->save($post, $id);
                    if ($response) {
                        set_alert('success', translate('information_has_been_updated_successfully'));
                    }
                    redirect(base_url('district'));
                }
            }

            $this->data['data'] = $this->district_model->getSingle('districts', $id, true);
       
            $this->data['title'] = 'District';
            $this->data['sub_page'] = 'district/edit';
            $this->data['main_menu'] = 'district';

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
            $this->db->delete('districts');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    /* unique valid branch name verification is done here */
    public function unique_name($name)
    {
        $district_id = $this->input->post('district_id');
        if (!empty($district_id)) {
            $this->db->where_not_in('id', $district_id);
        }
        $this->db->where('name', $name);
        $name = $this->db->get('districts')->num_rows();
        if ($name == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        }
    }
}
