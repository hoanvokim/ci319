<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_controller extends CI_Controller{

    public function __construct(){

        parent::__construct();
        //load curr lang.
        $this->lang->load('message', 'vietnamese');
        if(empty($_SESSION["activeLanguage"])){
            $_SESSION["activeLanguage"] = "vi";
        }

        //load models for home page.
        $this->load->model('Category_model');
        $this->load->model('Setting_model');
        $this->load->library('email');
        $this->load->helper('form');
    }

    public function index(){

        $data['status'] = '';
        if($this->input->post('btn_send')){

            $contact['protocol'] = $this->config->item('protocol');
            $contact['charset'] = $this->config->item('charset');
            $contact['mailtype'] = $this->config->item('mailtype');
            $contact['wordwrap'] = $this->config->item('wordwrap');
            $this->email->initialize($contact);

            $sender_mail = $this->input->post('sender_email');
            $sender_phone = $this->input->post('sender_phone');
            $sender_name = $this->input->post('sender_name');

            $sender_subject = $this->input->post('sender_subject');
            $sender_content = $this->input->post('sender_content')."\n Phone : ".$sender_phone;;

            $this->email->from($sender_mail, $sender_name);

            $this->email->to($this->config->item('contact_email'));

            $this->email->subject($sender_subject);
            $this->email->message($sender_content);
            if ( ! $this->email->send())
            {
                $data['status'] = 'error';
            }else{
                $data['status'] = 'success';
            }
        }

        //get main menu
        $strMenu = '';
        $this->Category_model->getMainMenu(null,$strMenu);
        $data['menustr'] = $strMenu;

        $data['title_header'] = 'Liên hệ';
        $data['defaultbanner'] = $this->Setting_model->getValueFromKey('defaultbanner');

        $this->load->view('pages/webapp/contact',$data);

    }

}