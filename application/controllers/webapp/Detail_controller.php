<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_controller extends CI_Controller
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
        $this->load->model('Gallery_model');
        $this->load->model('Setting_model');
    }

    public function index($slug)
    {
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
                    . "Email: ". $consult_email . "<br/>"
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
                } else {
                    $data['status'] = 'success';
                }
                $sql = "insert into user(email,name,phone,title,content) values('$consult_email','$consult_name','$consult_phone','$consult_subject','$consult_content')";
                $result = $this->db->query($sql);
                if ($result) {
                    $data['status'] = 'success';
                } else {
                    $data['status'] = 'error';
                }
            }

        } catch (Exception $e) {
            $data['status'] = 'error';
        }

        //get main menu
        $strMenu = '';
        $this->Category_model->getMainMenu(null, $strMenu);
        $data['menustr'] = $strMenu;

        $data['defaultbanner'] = $this->Setting_model->getValueFromKey('defaultbanner');

        $news_id = $this->News_model->getIdFromSlug($slug); //if not return -1
        $data['detail'] = $this->News_model->getNewsById($news_id);    //array of a news.    if not return -1
        $data['banner_title'] = $data['detail'] != -1 ? $data['detail']['title'] : '';
        $data['banner_bg'] = $data['detail'] != -1 ? $data['detail']['img_src'] : '';
        $data['title_header'] = $data['banner_title'];

        $category_id = $data['detail'] != -1 ? $data['detail']['category_id'] : -1;
        $category_info = $this->Category_model->getInfoFromId($category_id);  //a category row. if not return -1

        $data['category_info'] = $category_info;

        $data['lst_post'] = $this->News_model->getNewsByCatId($category_id);
        $data['cur_post'] = $this->getIndexFromLstPost($data['lst_post'], $news_id);
        $data['max_post'] = count($data['lst_post']) - 1;

        $data['is_video'] = false;
        if ($category_info != -1 && ($category_id == $this->config->item('gocchiase') || $category_info['vi_name'] == 'Góc chia sẻ' || $category_info['en_name'] == 'Sharing')) {
            if (strpos($data['detail']['img_src'], 'youtube') == false) {
                $data['is_video'] = false;
            }
            else {
                $data['is_video'] = true;
                $data['link_embed'] = strpos($data['detail']['img_src'], 'embed') == false ? str_replace('watch?v=', 'embed/', $data['detail']['img_src']) : $data['detail']['img_src'];
            }
            $data['img_galleries'] = $this->Gallery_model->getGalleryByNewsId($news_id);
            $this->load->view('pages/webapp/share_corner_detail', $data);
        }
        else {
            $data['relatednews'] = $this->News_model->getRelatedNewsById($news_id);
            $data['tagnews'] = $this->Tag_model->getTagByNewsId($news_id);
            $this->load->view('pages/webapp/detail_news', $data);
        }
    }

    public function getIndexFromLstPost($aNews, $news_id)
    {
        $cnt = count($aNews);
        if ($cnt > 0) {
            for ($i = 0; $i < $cnt; $i++) {
                if ($aNews[$i]['id'] == $news_id) {
                    return $i;
                }
            }
        }
        return -1;
    }

}