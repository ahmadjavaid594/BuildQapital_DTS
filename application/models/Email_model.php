<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Email_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

 public function sendJobStatusUpdate($data)
    {
        
        $emailTemplate = $this->db->where('template_id',3)->get('email_templates_details')->row_array();
    
        if ($emailTemplate['notified'] == 1) {
        
            $message = $emailTemplate['template_body'];
            $message = str_replace("{username}", $data['username'] , $message);
            $message = str_replace("{job_position}", $data['job_position'], $message);
            $message = str_replace("{company_name}", $data['company_name'], $message);
            $message = str_replace("{institute_name}", $data['institute_name'], $message);
            $message = str_replace("{application_status}", $data['application_status'], $message);
            $message = str_replace("{custom_message}", $data['custom_message'], $message);
            $message = str_replace("{email}", $data['email'], $message);
            $message = str_replace("{login_url}", $data['login_url'], $message);
            $msgData['recipient'] = $data['email'];
            $msgData['subject'] = "DTS Job Application Status Update";
            $msgData['message'] = $message;
           
            $this->sendEmail($msgData);
          
        }
    }
    public function sentStaffRegisteredAccount($data)
    {
        $emailTemplate = $this->getEmailTemplates(1);
        if ($emailTemplate['notified'] == 1) {
            $role_name = get_type_name_by_id('roles', $data['user_role']);
            $message = $emailTemplate['template_body'];
            $message = str_replace("{institute_name}", get_global_setting('institute_name'), $message);
            $message = str_replace("{name}", $data['name'], $message);
            $message = str_replace("{login_email}", $data['email'], $message);
            $message = str_replace("{password}", $data['password'], $message);
            $message = str_replace("{user_role}", $role_name, $message);
            $message = str_replace("{login_url}", base_url(), $message);
            $msgData['recipient'] = $data['email'];
            $msgData['subject'] = $emailTemplate['subject'];
            $msgData['message'] = $message;
            $this->sendEmail($msgData);
        }
    }

    public function sentStaffSalaryPay($data)
    {
        $emailTemplate = $this->getEmailTemplates(5);
        if ($emailTemplate['notified'] == 1) {
            $message = $emailTemplate['template_body'];
            $message = str_replace("{institute_name}", get_global_setting('institute_name'), $message);
            $message = str_replace("{name}", $data['name'], $message);
            $message = str_replace("{month_year}", $data['month_year'], $message);
            $message = str_replace("{payslip_no}", $data['bill_no'], $message);
            $message = str_replace("{payslip_url}", $data['payslip_url'], $message);
            $msgData['recipient'] = $data['recipient'];
            $msgData['subject'] = $emailTemplate['subject'];
            $msgData['message'] = $message;
            $this->sendEmail($msgData);
        }
    }

    public function sentAdvanceSalary($data)
    {
        $email_alert = false;
        if ($data['status'] == 2) {
            //send advance salary approve email
            $emailTemplate = $this->getEmailTemplates(9);
            if ($emailTemplate['notified'] == 1) {
                $email_alert = true;
            }
        } elseif ($data['status'] == 3) {
            //send advance salary reject email
            $emailTemplate = $this->getEmailTemplates(10);
            if ($emailTemplate['notified'] == 1) {
                $email_alert = true;
            }
        }
        if ($email_alert == true) {
            $message = $emailTemplate['template_body'];
            $message = str_replace("{institute_name}", get_global_setting('institute_name'), $message);
            $message = str_replace("{applicant_name}", $data['staff_name'], $message);
            $message = str_replace("{deduct_motnh}", date("F Y", strtotime($data['deduct_motnh'])), $message);
            $message = str_replace("{comments}", $data['comments'], $message);
            $message = str_replace("{amount}", $data['amount'], $message);
            $msgData['recipient'] = $data['email'];
            $msgData['subject'] = $emailTemplate['subject'];
            $msgData['message'] = $message;
            $this->sendEmail($msgData);
        }
    }

    public function sentLeaveRequest($data)
    {
        $email_alert = false;
        if ($data['status'] == 2) {
            //send leave salary approve email
            $emailTemplate = $this->getEmailTemplates(7);
            if ($emailTemplate['notified'] == 1) {
                $email_alert = true;
            }
        } elseif ($data['status'] == 3) {
            //send leave salary reject email
            $emailTemplate = $this->getEmailTemplates(8);
            if ($emailTemplate['notified'] == 1) {
                $email_alert = true;
            }
        }
        if ($email_alert == true) {
            $message = $emailTemplate['template_body'];
            $message = str_replace("{institute_name}", get_global_setting('institute_name'), $message);
            $message = str_replace("{applicant_name}", $data['applicant'], $message);
            $message = str_replace("{start_date}", _d($data['start_date']), $message);
            $message = str_replace("{end_date}", _d($data['end_date']), $message);
            $message = str_replace("{comments}", $data['comments'], $message);
            $msgData['recipient'] = $data['email'];
            $msgData['subject'] = $emailTemplate['subject'];
            $msgData['message'] = $message;
            $this->sendEmail($msgData);
        }
    }

    public function sentAward($data)
    {
        $emailTemplate = $this->getEmailTemplates(6);
        if ($emailTemplate['notified'] == 1) {
            $userdata = $this->application_model->getUserNameByRoleID($data['role_id'], $data['user_id']);
            $message = $emailTemplate['template_body'];
            $message = str_replace("{institute_name}", get_global_setting('institute_name'), $message);
            $message = str_replace("{winner_name}", $userdata['name'], $message);
            $message = str_replace("{award_name}", $data['award_name'], $message);
            $message = str_replace("{gift_item}", $data['gift_item'], $message);
            $message = str_replace("{award_reason}", $data['award_reason'], $message);
            $message = str_replace("{given_date}", date("Y-m-d", strtotime($data['given_date'])), $message);
            $msgData['recipient'] = $userdata['email'];
            $msgData['subject'] = $emailTemplate['subject'];
            $msgData['message'] = $message;
            $this->sendEmail($msgData);
        }
    }

   public function sentForgotPassword($data)
    {
        
        $emailTemplate = $this->db->where('template_id',2)->get('email_templates_details')->row_array();
    
        if ($emailTemplate['notified'] == 1) {
        
            $message = $emailTemplate['template_body'];
            $message = str_replace("{institute_name}", "Domestic Testing Services", $message);
            $message = str_replace("{username}", $data['name'] , $message);
            $message = str_replace("{name}", $data['name'], $message);
            $message = str_replace("{email}", $data['email'], $message);
            $message = str_replace("{reset_url}", $data['reset_url'], $message);
            $msgData['recipient'] = $data['username'];
            $msgData['subject'] = "Change Password";
            $msgData['message'] = $message;
            $this->sendEmail($msgData);
          
        }
    }
        public function sentSuccessRegister($data)
    {
        
        $emailTemplate = $this->db->where('template_id',1)->get('email_templates_details')->row_array();
    
        if ($emailTemplate['notified'] == 1) {
        
            $message = $emailTemplate['template_body'];
            $message = str_replace("{institute_name}", "Domestic Testing Services", $message);
            $message = str_replace("{username}", $data['name'] , $message);
            $message = str_replace("{name}", $data['name'], $message);
            $message = str_replace("{email}", $data['email'], $message);
            $message = str_replace("{login_url}", $data['login_url'], $message);
            $msgData['recipient'] = $data['username'];
            $msgData['subject'] = "DTS Registration";
            $msgData['message'] = $message;
            $this->sendEmail($msgData);
          
        }
    }
     public function sendChallanUpdate($data)
    {
        
        $emailTemplate = $this->db->where('template_id',4)->get('email_templates_details')->row_array();
    
        if ($emailTemplate['notified'] == 1) {
        
            $message = $emailTemplate['template_body'];
            $message = str_replace("{username}", $data['username'] , $message);
            $message = str_replace("{job_position}", $data['job_position'], $message);
            $message = str_replace("{company_name}", $data['company_name'], $message);
            $message = str_replace("{institute_name}", $data['institute_name'], $message);
            $message = str_replace("{email}", $data['email'], $message);
            $message = str_replace("{login_url}", $data['login_url'], $message);
            $msgData['recipient'] = $data['email'];
            $msgData['subject'] = "DTS Job Application Challan Update";
            $msgData['message'] = $message;
           
            $this->sendEmail($msgData);
          
        }
    }
    public function sendEmail($data)
    {
        $branchID = $this->application_model->get_branch_id();
        $getConfig = $this->db->get_where('email_config', array('id' => 1))->row_array();
        if ($getConfig['protocol'] == 'smtp') {
            $config = array(
                'smtp_host'     => trim($getConfig['smtp_host']),
                'smtp_port'     => trim($getConfig['smtp_port']),
                'smtp_user'     => trim($getConfig['smtp_user']),
                'smtp_pass'     => trim($getConfig['smtp_pass']),
                'smtp_crypto'   => $getConfig['smtp_encryption'],
            );
        }
        
        $config['protocol']     = 'smtp';
        $config['useragent']    = "CodeIgniter";
        $config['mailtype']     = "html";
        $config['newline']      = "\r\n";
        $config['charset']      = 'utf-8';
        $config['wordwrap']     = true;
        $config['smtp_timeout'] = 30;
        $this->load->library('email', $config);
        $this->email->from($getConfig['email'], get_global_setting('institute_name'));
        $this->email->to($data['recipient']);
        $this->email->subject($data['subject']);
        $this->email->message($data['message']);
        if ($this->email->send(true)) {
            return true;
        } else {
            return false;
        }
    }

    public function getEmailTemplates($id)
    {
        $branchID = $this->application_model->get_branch_id();
        $this->db->select('td.*');
        $this->db->from('email_templates_details as td');
        $this->db->where('td.template_id', $id);
        $this->db->where('td.branch_id', $branchID);
        return $this->db->get()->row_array();
    }
}
