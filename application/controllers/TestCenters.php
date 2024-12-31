<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @filename : TestCenters.php
 */

class TestCenters extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Test_Centers_model');
    }

    /* Test centers list and form submission */
    public function index()
    {
        if (!is_applicant_loggedin()) {
            if ($this->input->post('submit') == 'save' && is_superadmin_loggedin()) {
                // Validation rules
                $this->form_validation->set_rules('name', translate('name'), 'required|callback_unique_name');
                $this->form_validation->set_rules('address', translate('address'), 'required');
                $this->form_validation->set_rules('city', translate('city'), 'required');
                $this->form_validation->set_rules('state', translate('state'), 'required');
                $this->form_validation->set_rules('country', translate('country'), 'required');
                $this->form_validation->set_rules('email', translate('email'), 'required');
                $this->form_validation->set_rules('capacity', translate('capacity'), 'required');

                if ($this->form_validation->run() == true) {
                    // Save data
                    $post = $this->input->post();
                    $response = $this->Test_Centers_model->save($post);
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('testCenters'));
                } else {
                    $this->data['validation_error'] = true;
                }
            }
            // Load data
            $this->data['title'] = 'Test Centers';
            $this->data['sub_page'] = 'test_centers/add';
            $this->data['main_menu'] = 'testCenters';
            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /* Test center information update */
    public function edit($id = '')
    {
        if (is_superadmin_loggedin()) {
            if ($this->input->post('submit') == 'save') {
                // Validation rules
                $this->form_validation->set_rules('name', translate('name'), 'required|callback_unique_name');
                $this->form_validation->set_rules('address', translate('address'), 'required');
                $this->form_validation->set_rules('city', translate('city'), 'required');
                $this->form_validation->set_rules('state', translate('state'), 'required');
                $this->form_validation->set_rules('country', translate('country'), 'required');
                $this->form_validation->set_rules('email', translate('email'), 'required');
                $this->form_validation->set_rules('capacity', translate('capacity'), 'required');

                if ($this->form_validation->run() == true) {
                    // Save data
                    $post = $this->input->post();
                    $response = $this->Test_Centers_model->save($post, $id);
                    if ($response) {
                        set_alert('success', translate('information_has_been_updated_successfully'));
                    }
                    redirect(base_url('testCenters'));
                }
            }

            // Get test center data for editing
            $this->data['data'] = $this->Test_Centers_model->getSingle('test_centers', $id, true);

            // Load view
            $this->data['title'] = translate('Test Centers');
            $this->data['sub_page'] = 'test_centers/edit';
            $this->data['main_menu'] = 'test_centers';

            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /* Delete test center information */
    public function delete_data($id = '')
    {
        if (is_superadmin_loggedin()) {
            $this->db->where('id', $id);
            $this->db->delete('test_centers');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    /* Unique test center name validation */
    public function unique_name($name)
    {
        $test_center_id = $this->input->post('test_center_id');
        if (!empty($test_center_id)) {
            $this->db->where_not_in('id', $test_center_id);
        }
        $this->db->where('name', $name);
        $name = $this->db->get('test_centers')->num_rows();
        if ($name == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        }
    }
}
