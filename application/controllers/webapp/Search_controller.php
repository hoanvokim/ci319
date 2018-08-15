<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_controller extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        //load curr lang.
        $this->lang->load('message', 'vietnamese');
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }

        //load models for home page.
        $this->load->model('Category_model');
        $this->load->model('News_model');
        $this->load->model('Tag_model');
        $this->load->model('Faq_model');

        $this->load->library('pageutility');
        $this->load->library('email');
    }

    public function find($curpage = null)
    {
        $keyword = urldecode($this->input->get('searchValue'));
        $total_row = $this->News_model->getTotalRowBySearchTag($keyword);
        $data['search_item_count'] = $total_row > 0 ? $total_row : 0;
        $data['keyword'] = $keyword;

        if ($total_row > 0) {
            //limit = 10
            $this->pageutility->setData($total_row, 10);
            $data['total_page'] = $this->pageutility->total_page;
            $data['cur_page'] = $curpage == null ? 1 : $curpage;
            $data['anews'] = $this->News_model->getNewsBySearchTag($keyword, $curpage, $this->pageutility->limit);
            $data['search_item_count'] = $total_row;
        }

        //get main menu
        $strMenu = '';
        $this->Category_model->getMainMenu(null, $strMenu);
        $data['menustr'] = $strMenu;

        $data['title_header'] = 'Searching';
        $data['status'] = '';
        try {

            if ($this->input->post('btn_consult_send')) {
                $contact['protocol'] = $this->config->item('protocol');
                $contact['charset'] = $this->config->item('charset');
                $contact['mailtype'] = $this->config->item('mailtype');
                $contact['wordwrap'] = $this->config->item('wordwrap');

                $consult_name = $this->input->post('consult_name');
                $consult_email = $this->input->post('consult_email');
                $consult_phone = $this->input->post('consult_phone');

                $consult_subject = $this->input->post('consult_subject');
                $consult_content = "<i>Tên: " . $consult_name . "<br/>"
                    . "Email: " . $consult_email . "<br/>"
                    . "Số điện thoại: " . $consult_phone . "</i><br/>"
                    . "------------------------------------------<br/>"
                    . "<strong>Tiêu đề: " . $consult_subject . "</strong><br/><br/>"
                    . $this->input->post('consult_content');

                //test
                $config1 = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'sup.issiloo@gmail.com',
                    'smtp_pass' => 'TihHon@16LH',
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE
                );

                $this->load->library('email', $config1);
                $this->email->set_newline("\r\n");
                $this->email->initialize($config1);

                $this->email->from('sup.issiloo@gmail.com', $consult_email);

                $this->email->to($this->config->item('contact_email'));

                $this->email->subject($consult_subject);
                $this->email->message($consult_content);
                if (!$this->email->send()) {
                    $data['status'] = 'error';
                }
                else {
                    $data['status'] = 'success';
                }
                $sql = "insert into user(email,name,phone,title,content) values('$consult_email','$consult_name','$consult_phone','$consult_subject','$consult_content')";
                $result = $this->db->query($sql);
                if ($result) {
                    $data['status'] = 'success';
                }
                else {
                    $data['status'] = 'error';
                }
            }
            $this->load->view("pages/webapp/search_result", $data);
            $data['status'] = '';

        }
        catch (Exception $e) {
            $data['status'] = 'error';
        }
    }

}