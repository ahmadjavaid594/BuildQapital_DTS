<?php
defined('BASEPATH') or exit('No direct script access allowed');
class City extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('city_model');
    }

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        if (is_superadmin_loggedin()) {
            if ($this->input->post('submit') == 'save') {
               
                $this->form_validation->set_rules('name', translate('name'), 'required|callback_unique_name');
                if ($this->form_validation->run() == true) {
                
                    $post = $this->input->post();
                    $response = $this->city_model->save($post);
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('city'));
                } else {
                    $this->data['validation_error'] = true;
                }
            }
            $this->data['title'] = 'City';
            $this->data['sub_page'] = 'city/add';
            $this->data['main_menu'] = 'city';
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
            //    $this->form_validation->set_rules('description', translate('description'), 'required');
              if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                    $response = $this->city_model->save($post, $id);
                    if ($response) {
                        set_alert('success', translate('information_has_been_updated_successfully'));
                    }
                    redirect(base_url('city'));
                }
            }

            $this->data['data'] = $this->city_model->getSingle('cities', $id, true);
       
            $this->data['title'] = 'City';
            $this->data['sub_page'] = 'city/edit';
            $this->data['main_menu'] = 'city';

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
            $this->db->delete('cities');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    /* unique valid branch name verification is done here */
    public function unique_name($name)
    {
        $city_id = $this->input->post('city_id');
        if (!empty($city_id)) {
            $this->db->where_not_in('id', $city_id);
        }
        $this->db->where('name', $name);
        $name = $this->db->get('cities')->num_rows();
        if ($name == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        }
    }
}
