<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 
 
 
 
 * @filename : Accounting.php
 
 */

class Errors extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('errors/error_404_message.php');
    }
}
