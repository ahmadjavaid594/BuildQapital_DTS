<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Results extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Test_Schedule_model');
        $this->load->model('Test_Result_Model');
        $this->load->model('Job_model');
    }

    public function upload()
    {
        if ($this->input->post('submit') == 'upload') {
            // Set form validation rules
            $this->form_validation->set_rules('job_id', 'Job', 'required|integer');
            if (empty($_FILES['csv_file']['name'])) {
                $this->form_validation->set_rules('csv_file', 'CSV File', 'required');
            }

            if ($this->form_validation->run() === true) {
                // Call the model method to handle the upload and processing
                $result = $this->Test_Result_Model->upload_test_results(
                    $this->input->post('job_id'),
                    $_FILES['csv_file']
                );

                // Set alert based on the result
                if (isset($result['error'])) {
                    set_alert('error', $result['error']);
                } else {
                    set_alert('success', $result['success']);
                }

                redirect(base_url('results'));
            } else {
                $this->index();
            }
        }
    }
    

    // Index - Display list and create form
    public function index()
    {
        
        $this->data['jobs'] = $this->Job_model->getAllJobsList('job');
        $this->data['title'] = 'Test Results';
        $this->data['sub_page'] = 'results/add';
        $this->data['main_menu'] = 'results';
        $this->data['validation_error'] = false;
        $this->load->view('layout/index', $this->data);
    }

   
    // Edit schedule - Populate the form with existing data
    public function edit($id)
    {
        if (is_superadmin_loggedin()) {
            if ($this->input->post('submit') == 'save') {
              
                $this->form_validation->set_rules('test_center_id', 'Test Center', 'trim|required');
                $this->form_validation->set_rules('job_id', 'Job', 'trim|required');
                $this->form_validation->set_rules('test_date', 'Date', 'trim|required');
                $this->form_validation->set_rules('start_time', 'Start Time', 'trim|required');
                $this->form_validation->set_rules('end_time', 'End Time', 'trim|required');
                $this->form_validation->set_rules('seats_available', 'Seats Available', 'trim|required|integer');
                $data = $this->input->post();
             
                if ($this->form_validation->run() !== false) {
                   
                    $id = $this->input->post('schedule_id'); // Hidden field for editing                
                    $this->Test_Schedule_model->save($data, $id);
        
                    set_alert('success', 'Test schedule has been updated successfully.');
                    redirect(base_url('testSchedule'));
                } else {
                    // Reload with validation errors
                    $this->data['validation_error'] = true;
                    $this->index();
                }
            }
        }
        $schedule = $this->Test_Schedule_model->getSingle('test_schedule', $id, true);
        if (!$schedule) {
            set_alert('error', 'Test schedule not found.');
            redirect(base_url('test_schedule'));
        }

        $this->data['data'] = $schedule;
        $this->data['test_centers'] = $this->Test_Centers_model->getList();
        $this->data['jobs'] = $this->Job_model->getAllJobsList('job');
        $this->data['title'] = 'Edit Test Schedule';
        $this->data['sub_page'] = 'test_schedule/edit';
        $this->data['main_menu'] = 'test_schedule';
        $this->load->view('layout/index', $this->data);
    }

    // Delete schedule
    public function delete($id)
    {
        $result = $this->Test_Result_Model->delete($id);
        if ($result) {
            set_alert('success', 'Test schedule has been deleted successfully.');
        } else {
            set_alert('error', 'An error occurred while deleting the test schedule.');
        }
        redirect(base_url('test_schedule'));
    }
}
