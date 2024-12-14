<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 
 
 
 
 * @filename : Accounting.php
 
 */

class Document extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('document_model');
    }

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        if (is_applicant_loggedin()) {
            if ($this->input->post('submit') == 'save') {
               
                $this->form_validation->set_rules('name', translate('name'), 'required');
               
                if ($this->form_validation->run() == true) {
                
                    $post = $this->input->post();
                    $response = $this->document_model->save($post);
                
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('document'));
                } else {
                    $this->data['validation_error'] = true;
                }
            }
            $id = get_loggedin_user_id();
            $this->data['documents'] = $this->document_model->getDocumentByApplicant($id);
            $this->data['title'] = 'Document';
            $this->data['sub_page'] = 'document/add';
            $this->data['main_menu'] = 'document';
            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /* branch information update here */
    public function edit($id = '')
    {
        if (is_applicant_loggedin()) {
            $data = $this->input->post();
         
            if ($this->input->post('submit') == 'update') {
                $this->form_validation->set_rules('name', translate('name'), 'required');
               
              if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                   
                    $response = $this->document_model->save($post, $id);
                    if ($response) {
                        set_alert('success', translate('information_has_been_updated_successfully'));
                    }
                    redirect(base_url('document'));
                }
            }
           
            $this->data['data'] = $this->document_model->getSingle('applicant_document', $id, true);
       
            $this->data['title'] = translate('document');
            $this->data['sub_page'] = 'document/edit';
            $this->data['main_menu'] = 'document';

            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /* delete information */
    public function delete_data($id = '')
    {
        if (is_applicant_loggedin()) {
            $this->db->where('id', $id);
            $this->db->delete('applicant_document');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

}
