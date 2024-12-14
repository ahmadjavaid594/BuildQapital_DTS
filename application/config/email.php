<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.hostinger.com'; // Hostinger SMTP server
$config['smtp_port'] = 465; // SSL port
$config['smtp_user'] = 'info@dts.org.pk'; // Replace with your email address
$config['smtp_pass'] = '2Io~kn58'; // Replace with your email password
$config['smtp_crypto'] = 'ssl'; // Use SSL encryption
$config['mailtype'] = 'html'; // Email format (html or text)
$config['charset'] = 'utf-8'; // Character encoding
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n"; // Newline characters
$config['crlf'] = "\r\n"; // Carriage return and line feed

    ?>