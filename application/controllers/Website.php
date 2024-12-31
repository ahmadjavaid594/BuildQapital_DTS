<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Website extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('location_model');
        $this->load->model('designation_model');
        $this->load->model('job_model');
        $this->load->model('qouta_model');
        $this->load->model('organization_model');
        $this->load->model(['dashboard_model', 'applicants_model', 'application_model', 'email_model']);
  
    }

    public function index()
    {
        
        if (is_student_loggedin() || is_parent_loggedin()) {
            $studentID = 0;
            if (is_student_loggedin()) {
                $this->data['title'] = translate('welcome_to') . " " . $this->session->userdata('name');
                $studentID = get_loggedin_user_id();
            }elseif (is_parent_loggedin()) {
                $studentID = $this->session->userdata('myChildren_id');
                if (!empty($studentID)) {
                    $this->data['title'] = get_type_name_by_id('student', $studentID, 'first_name') . " - " . translate('dashboard');
                } else {
                    $this->data['title'] = translate('welcome_to') . " " . $this->session->userdata('name');
                }
            }
            $this->data['student_id'] = $studentID;
            $schoolID = get_loggedin_branch_id();
            $this->data['school_id'] = $schoolID;
            $this->data['sub_page'] = 'userrole/dashboard';
        } else {
            if (is_superadmin_loggedin()) {
                if ($this->input->get('school_id')) {
                    $schoolID = $this->input->get('school_id');
                    $this->data['title'] = get_type_name_by_id('branch', $schoolID) . " " . translate('branch_dashboard');
                } else {
                    $this->data['title'] = translate('all_branch_dashboard');
                    $schoolID = "";
                }
            } else {
                $schoolID = get_loggedin_branch_id();
                $this->data['title'] = get_type_name_by_id('branch', $schoolID) . " " . translate('branch_dashboard');
            }
  //          $this->data['school_id'] = $schoolID;
//            $this->data['student_by_class'] = $this->dashboard_model->getStudentByClass($schoolID);
      //      $this->data['fees_summary'] = $this->dashboard_model->annualFeessummaryCharts($schoolID);
           // $this->data['income_vs_expense'] = $this->dashboard_model->getIncomeVsExpense($schoolID);
        //    $this->data['weekend_attendance'] = $this->dashboard_model->getWeekendAttendance($schoolID);
         //   $this->data['monthly_attendance'] = $this->dashboard_model->getMonthlyAttendance($schoolID);
          //  $this->data['daily_attendance_summary'] = $this->dashboard_model->getDailyBranchWiseAttendance($schoolID);
    //        $this->data['get_monthly_admission'] = $this->dashboard_model->getMonthlyAdmission($schoolID);
     //       $this->data['get_voucher'] = $this->dashboard_model->getVoucher($schoolID);
      //      $this->data['get_transport_route'] = $this->dashboard_model->get_transport_route($schoolID);
    //        $this->data['get_total_student'] = $this->dashboard_model->get_total_student($schoolID);
          //  $this->data['sub_page'] = 'dashboard/index';
        }
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/fullcalendar/fullcalendar.css',
            ),
            'js' => array(
                'vendor/chartjs/chart.min.js',
                'vendor/echarts/echarts.common.min.js',
                'vendor/moment/moment.js',
                'vendor/fullcalendar/fullcalendar.js',
            ),
        );
        $this->data['sub_page'] = 'website/home';
        $this->data['main_menu'] = 'dashboard';
        $this->load->view('website/index', $this->data);

    }
    public function about()
    {
        $this->data['sub_page'] = 'website/about';
        $this->load->view('website/index', $this->data);
    }
    public function services()
    {
        $this->data['sub_page'] = 'website/services';
        $this->load->view('website/index', $this->data);
    }
    public function contact()
    {
        $this->data['sub_page'] = 'website/contact';
        $this->load->view('website/index', $this->data);
    }
    public function login()
    {
        $this->data['sub_page'] = 'website/login';
        $this->load->view('website/index', $this->data);
    }
    public function viewJob($job_id) {

      
        $job = $this->job_model->getJobDetails($job_id);
    
        if (!$job) {
            show_404(); // Show 404 if job is not found
        }
    
        $this->data['job'] = $job;
        //$this->load->view('job_view', $data);
        $this->data['sub_page'] = 'website/viewjob';
        $this->load->view('website/index', $this->data);

    }
    public function jobs()
    {
        
            // Get filter parameters from GET request
            $organization_id = $this->input->get('organization');
            $qouta_id = $this->input->get('qouta');
            $designation_id = $this->input->get('designation');
            $job_type_id = $this->input->get('job_type');
            $location = $this->input->get('location');
            $qualification = $this->input->get('qualification');
            $active = $this->input->get('active');
         

            // Prepare the filter array
            $filter = [];
        
            // Only add the filters to the array if they are set and not empty
            if (!empty($active)) {
                $filter['active'] = $active;
            }
            if (!empty($organization_id)) {
                $filter['organization'] = $organization_id;
            }
        
            if (!empty($qouta_id)) {
                $filter['qouta'] = $qouta_id;
            }
        
            if (!empty($designation_id)) {
                $filter['designation'] = $designation_id;
            }
        
            if (!empty($job_type_id)) {
                $filter['job_type'] = $job_type_id;
            }
        
            if (!empty($location)) {
                $filter['location'] = $location;
            }
            $page = $this->input->get('page') ?? 1;
            $limit = 10; // Number of jobs per page
            $offset = ($page - 1) * $limit;

            // Get filtered jobs for the current page
            $filter = $this->input->get();  // Assuming filters are passed as GET parameters
            $this->data['jobs'] = $this->job_model->getJobsList($filter, $limit, $offset);
            
            // Get total job count for pagination
            $this->data['total_jobs'] = $this->job_model->getTotalJobsCount($filter);
            
            // Calculate total pages
            $this->data['total_pages'] = ceil($this->data['total_jobs'] / $limit);
           
            // Fetch filter data for dropdowns
            $this->data['organizations'] = $this->job_model->getOrganizations();
            $this->data['qoutas'] = $this->job_model->getQoutas();
            $this->data['designation'] = $this->job_model->getDesignations();
            $this->data['job_type'] = $this->job_model->getJobTypes();
            $this->data['qualifications'] = $this->job_model->getQualifications();
            $this->data['organization_id'] = $organization_id;
            $this->data['qouta_id'] = $qouta_id;
            $this->data['designation_id'] = $designation_id;
            $this->data['job_type_id'] = $job_type_id;
            $this->data['location'] = $location;
            $this->data['page'] = $page;
            // Load the page view
            $this->data['headerelements'] = array(
                'css' => array(
                    'vendor/fullcalendar/fullcalendar.css',
                ),
                'js' => array(
                    'vendor/chartjs/chart.min.js',
                    'vendor/echarts/echarts.common.min.js',
                    'vendor/moment/moment.js',
                    'vendor/fullcalendar/fullcalendar.js',
                ),
            );
            $this->data['sub_page'] = 'website/jobs';
            $this->load->view('website/index', $this->data);
        
        
    
    }
    public function register()
    {

       
        if ($_POST) {
            
          
            $this->employee_validation();
          
            if ($this->form_validation->run() == true) {
                //var_dump($_POST);
                //die;
                //save all employee information in the database
                $user_id = $this->applicants_model->save($this->input->post());

                // handle custom fields data
                //$class_slug = $this->router->fetch_class();
                //$customField = $this->input->post("custom_fields[$class_slug]");
                //if (!empty($customField)) {
                 //   saveCustomFields($customField, $studentID);
               // }

                set_alert('success', translate('information_has_been_saved_successfully'));
                //send account activate email
                //$this->email_model->sentStaffRegisteredAccount($post);
                redirect(base_url('employee/view/' . $post['user_role']), 'refresh');
           }
        }
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['title'] = translate('add_employee');
        $this->data['sub_page'] = 'employee/add';
        $this->data['main_menu'] = 'employee';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'js/employee.js',
                'vendor/dropify/js/dropify.min.js',
            ),
        );

        $this->data['sub_page'] = 'website/register';
        $this->load->view('website/index', $this->data);
    }
    public function saveUser()
    {
        $this->data['sub_page'] = 'website/register';
        $this->load->view('website/index', $this->data);
    }
   
    protected function employee_validation()
    {
        
        $this->form_validation->set_rules('name', translate('name'), 'trim|required');
        $this->form_validation->set_rules('mobile_no', translate('mobile_no'), 'trim|required');
        $this->form_validation->set_rules('cnic', translate('cnic'), 'trim|required|callback_unique_cnic');
        $this->form_validation->set_rules('father_name', translate('father_name'), 'trim|required');
        $this->form_validation->set_rules('city', translate('city'), 'trim|required');
        $this->form_validation->set_rules('province', translate('province'), 'trim|required');
        $this->form_validation->set_rules('district', translate('district'), 'trim|required');
        $this->form_validation->set_rules('present_address', translate('present_address'), 'trim|required');
        $this->form_validation->set_rules('email', translate('email'), 'trim|required|valid_email|callback_unique_username');
        $this->form_validation->set_rules('user_photo', 'profile_picture',array(array('handle_upload', array($this->application_model, 'profilePicUpload'))));
    }
    public function unique_username($username)
    {
      
        $this->db->where('username', $username);
        $query = $this->db->get('login_credential');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("unique_username", translate('username_has_already_been_used'));
            return false;
        } else {
            return true;
        }
    }
    public function unique_cnic($cnic)
    {
      
        $this->db->where('cnic', $cnic);
        $query = $this->db->get('applicants');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("unique_cnic",  translate('cnic_has_already_been_used'));
            return false;
        } else {
            return true;
        }
    }

}
