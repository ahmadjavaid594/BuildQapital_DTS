<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 
 
 
 
 * @filename : Accounting.php
 
 */

class Dashboard extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
    }

    public function index()
    {
        if (is_superadmin_loggedin()) {
            $this->data['school_id'] = $schoolID;
            $this->data['total_jobs'] = $this->dashboard_model->get_all_jobs();
            $this->data['total_users'] = $this->dashboard_model->get_all_users();
            $this->data['total_organizations'] = $this->dashboard_model->get_all_organizations();
            $this->data['total_qoutas'] = $this->dashboard_model->get_all_qoutas();
            $this->data['total_job_types'] = $this->dashboard_model->get_all_job_types();
            $this->data['total_locations'] = $this->dashboard_model->get_all_locations();
            $this->data['total_designations'] = $this->dashboard_model->get_all_designations();
            $this->data['total_active_jobs'] = $this->dashboard_model->get_all_active_jobs();
            $this->data['total_inactive_jobs'] = $this->dashboard_model->get_all_inactive_jobs();
            $this->data['total_applictions'] =  $this->dashboard_model->get_all_applications();
            $this->data['total_challans_paid'] =  $this->dashboard_model->get_total_challans_paid();
            $this->data['sub_page'] = 'dashboard/index';
        } else {
           
            $this->data['total_pending'] = $this->dashboard_model->get_all_pending_challans();
            $this->data['total_applied'] = $this->dashboard_model->get_all_applied_jobs();
            $this->data['total_short_listed'] = $this->dashboard_model->get_all_shortlisted_jobs();
            $this->data['total_rejected'] = $this->dashboard_model->get_all_rejected_jobs();
            $this->data['total_qoutas'] = $this->dashboard_model->get_all_qoutas();
            $this->data['total_job_types'] = $this->dashboard_model->get_all_job_types();
            $this->data['total_locations'] = $this->dashboard_model->get_all_locations();
            $this->data['total_designations'] = $this->dashboard_model->get_all_designations();
            $this->data['total_active_jobs'] = $this->dashboard_model->get_all_active_jobs();
            $this->data['total_inactive_jobs'] = $this->dashboard_model->get_all_inactive_jobs();
            $this->data['sub_page'] = 'dashboard/index';
        }
       
        $this->data['title'] = 'Dashboard';
        $this->data['main_menu'] = 'dashboard';
        $this->load->view('layout/index', $this->data);
    }
}
