<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_news_controller extends CI_Controller
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
        $this->load->model('Setting_model');
        $this->load->model('Faq_model');
        $this->load->library('pageutility');
        $this->load->library('email');
    }

    public function index($slug, $curpage = null)
    {

        $data['status'] = '';
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

        //get main menu
        $strMenu = '';
        $this->Category_model->getMainMenu(null, $strMenu);
        $data['menustr'] = $strMenu;

        $category_id = $this->Category_model->getIdFromSlug($slug);
        $data['banner_title'] = $this->Category_model->getName($category_id);
        $data['defaultbanner'] = $this->Setting_model->getValueFromKey('defaultbanner');
        $data['title_header'] = $data['banner_title'];

        $aMenu = array();
        $aMenu[] = $category_id;
        $this->Category_model->getAllSubMenu($category_id, $aMenu);
        $data['aMenu'] = $aMenu;

        //limit = 10
        $this->pageutility->setData($this->News_model->getToTalRowByCatCollection($aMenu), 10);
        $data['total_page'] = $this->pageutility->total_page;
        $data['cur_page'] = $curpage == null ? 1 : $curpage;
        $data['slug'] = $slug;
        $data['anews'] = $this->News_model->getNewsByCatCollection($aMenu, $curpage, $this->pageutility->limit);
        $data['relatednews'] = $this->News_model->getRelatedNewsByCatId($category_id);

        if (count($data['relatednews']) == 0) {
            $data['relatednews'] = $this->News_model->getNewsByCategoryConfig('sidebar', false); // get from category_config not care about is_enable
        }
        else {
            $aTemp = $this->News_model->getNewsByCategoryConfig('sidebar', true);
            if (count($aTemp) > 0) {
                $data['relatednews'] = $aTemp;
            }
        }

        $category_info = $this->Category_model->getInfoFromId($category_id);   //if not return -1

        if ($category_info != -1 && ($category_id == $this->config->item('gocchiase') || $category_info['vi_name'] == 'Góc chia sẻ' || $category_info['en_name'] == 'Sharing')) {
            $arr_news = array();
            $cnt = 0;
            foreach ($data['anews'] as $item) {
                $arr_news[$cnt]['id'] = $item['id'];
                $arr_news[$cnt]['category_id'] = $item['category_id'];
                $arr_news[$cnt]['img_src'] = $item['img_src'];
                $arr_news[$cnt]['slug'] = $item['slug'];
                $arr_news[$cnt]['title'] = $item['title'];
                if (strripos($item['img_src'], 'embed/') !== false || strripos($item['img_src'], 'watch?v=') !== false) {
                    //is video
                    $arr_news[$cnt]['youtube_thumbnail'] = getThumbnailFromYoutubeLink($item['img_src']);
                }
                else {
                    $arr_news[$cnt]['youtube_thumbnail'] = false;
                }
                $cnt++;
            }
            $data['anews'] = $arr_news;
            $this->load->view('pages/webapp/share_corner', $data);

        }
        elseif ($category_info != -1 && ($category_id == $this->config->item('faq') || $category_info['vi_name'] == 'Hỏi đáp' || $category_info['en_name'] == 'FAQs')) {
            $data['faqs'] = $this->Faq_model->getAll();
            $this->load->view('pages/webapp/faq', $data);
        }
        elseif ($category_info != -1 && ($category_id == $this->config->item('introduce') || $category_info['vi_name'] == 'Giới thiệu' || $category_info['en_name'] == 'Introduce')) {
            $data['intros'] = $this->News_model->getIntroduces($this->config->item('introduce'));
            $this->load->view('pages/webapp/intro', $data);
        }
        elseif ($category_info != -1 && $category_id == $this->config->item('duhochanquoc')) {
            //especially for study aboard
            $this->load->view("pages/webapp/korean_study_aboard", $data);
        }
        else {
            $this->load->view("pages/webapp/list_news", $data);
        }
    }

    public function belongToStudyAbroad($category_id)
    {
        $aStudyAbroadMenu = array();
        $this->Category_model->getAllSubMenu(10, $aStudyAbroadMenu);
        foreach ($aStudyAbroadMenu as $item) {
            if ($category_id == $item) {
                return true;
            }
        }
        return false;
    }

    public function tag($tag_id, $curpage = null)
    {
        $data['status'] = '';
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
        //get main menu
        $strMenu = '';
        $this->Category_model->getMainMenu(null, $strMenu);
        $data['menustr'] = $strMenu;

        $tag_name = $this->Tag_model->getNameById($tag_id);
        $data['title_header'] = $tag_name != -1 ? $tag_name : '';

        //limit = 10
        $this->pageutility->setData($this->News_model->getTotalRowByTagId($tag_id), 10);
        $data['total_page'] = $this->pageutility->total_page;
        $data['cur_page'] = $curpage == null ? 1 : $curpage;
        $data['tag_id'] = $tag_id;
        $data['anews'] = $this->News_model->getNewsByTagId($tag_id, $curpage, $this->pageutility->limit);

        $data['tag_name'] = $data['title_header'];

        $this->load->view("pages/webapp/list_news_tag", $data);
    }

}