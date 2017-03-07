<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

        $config = array();
        $config['useragent']           = "CodeIgniter";
        $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']            = "smtp";
        $config['smtp_host']           = "ssl://smtp.gmail.com";
        $config['smtp_port']           = "465";
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';
        $config['newline']  = "\r\n";
        $config['wordwrap'] = TRUE;
        $config['smtp_user']    = 'johnenrico.idn@gmail.com';
        $config['smtp_pass']    = 'supersu1234';