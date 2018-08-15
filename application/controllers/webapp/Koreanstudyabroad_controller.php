<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koreanstudyabroad_controller extends CI_Controller
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
        $this->load->model('Setting_model');
        $this->load->library('email');
        $this->load->helper('form');

        $this->load->model('News_model');
        $this->load->model('Tag_model');
        $this->load->model('Gallery_model');
    }

    public function index($type = 1, $slug_url = null)
    {
        $data['defaultbanner'] = $this->Setting_model->getValueFromKey('defaultbanner');
        $data['status'] = '';
        if ($this->input->post('btn_send')) {

            $contact['protocol'] = $this->config->item('protocol');
            $contact['charset'] = $this->config->item('charset');
            $contact['mailtype'] = $this->config->item('mailtype');
            $contact['wordwrap'] = $this->config->item('wordwrap');
            $this->email->initialize($contact);

            $sender_mail = $this->input->post('sender_email');
            $sender_phone = $this->input->post('sender_phone');
            $sender_name = $this->input->post('sender_name');

            $sender_subject = $this->input->post('sender_subject');
            $sender_content = $this->input->post('sender_content') . "\n Phone : " . $sender_phone;;

            $this->email->from($sender_mail, $sender_name);

            $this->email->to($this->config->item('contact_email'));

            $this->email->subject($sender_subject);
            $this->email->message($sender_content);
            if (!$this->email->send()) {
                $data['status'] = 'error';
            } else {
                $data['status'] = 'success';
            }
        }

        //get main menu
        $strMenu = '';
        $this->Category_model->getMainMenu(null, $strMenu);
        $data['menustr'] = $strMenu;
        if ($type == 1) {
            $this->loadDuHoc($slug_url, $data);
        } else {
            $this->loadDaoTao($slug_url, $data);
        }
        if ($slug_url != null) {
            $newsId = null;
            $relatedNewsArr = array();
            switch ($slug_url) {
                case 'du-hoc-tieng' :
                    $newsId = $this->config->item('baiviet_duhoctieng');
                    array_push($relatedNewsArr, $this->config->item('baiviet_duhocnganh'), $this->config->item('baiviet_duhocnghe'));
                    break;
                case 'du-hoc-nganh' :
                    $newsId = $this->config->item('baiviet_duhocnganh');
                    array_push($relatedNewsArr, $this->config->item('baiviet_duhoctieng'), $this->config->item('baiviet_duhocnghe'));
                    break;
                case 'du-hoc-nghe' :
                    $newsId = $this->config->item('baiviet_duhocnghe');
                    array_push($relatedNewsArr, $this->config->item('baiviet_duhoctieng'), $this->config->item('baiviet_duhocnganh'));
                    break;
                case 'tieng-han-so-cap' :
                    $newsId = $this->config->item('baiviet_tienghansocap');
                    array_push($relatedNewsArr, $this->config->item('baiviet_tienghantrungcap'), $this->config->item('baiviet_luyenthitopik'),
                        $this->config->item('baiviet_luyenthieps'), $this->config->item('baiviet_lichkhaigiang'), $this->config->item('baiviet_daotaodoanhnghiep'));
                    break;
                case 'tieng-han-trung-cap' :
                    $newsId = $this->config->item('baiviet_tienghantrungcap');
                    array_push($relatedNewsArr, $this->config->item('baiviet_tienghansocap'), $this->config->item('baiviet_luyenthitopik'),
                        $this->config->item('baiviet_luyenthieps'), $this->config->item('baiviet_lichkhaigiang'), $this->config->item('baiviet_daotaodoanhnghiep'));
                    break;
                case 'luyen-thi-topik' :
                    $newsId = $this->config->item('baiviet_luyenthitopik');
                    array_push($relatedNewsArr, $this->config->item('baiviet_tienghansocap'), $this->config->item('baiviet_tienghantrungcap'),
                        $this->config->item('baiviet_luyenthieps'), $this->config->item('baiviet_lichkhaigiang'), $this->config->item('baiviet_daotaodoanhnghiep'));
                    break;
                case 'luyen-thi-klat' :
                    $newsId = $this->config->item('baiviet_luyenthiklat');
                    array_push($relatedNewsArr, $this->config->item('baiviet_tienghansocap'), $this->config->item('baiviet_tienghantrungcap'),
                        $this->config->item('baiviet_luyenthitopik'), $this->config->item('baiviet_luyenthieps'), $this->config->item('baiviet_daotaodoanhnghiep'));
                    break;
                case 'luyen-thi-eps' :
                    $newsId = $this->config->item('baiviet_luyenthieps');
                    array_push($relatedNewsArr, $this->config->item('baiviet_tienghansocap'), $this->config->item('baiviet_tienghantrungcap'),
                        $this->config->item('baiviet_luyenthitopik'), $this->config->item('baiviet_luyenthiklat'), $this->config->item('baiviet_daotaodoanhnghiep'));
                    break;
                case 'dao-tao-doanh-nghiep' :
                    $newsId = $this->config->item('baiviet_daotaodoanhnghiep');
                    array_push($relatedNewsArr, $this->config->item('baiviet_tienghansocap'), $this->config->item('baiviet_tienghantrungcap'),
                        $this->config->item('baiviet_luyenthitopik'), $this->config->item('baiviet_luyenthiklat'), $this->config->item('baiviet_lichkhaigiang'));
                    break;
                case 'lich-khai-giang' :
                    $newsId = $this->config->item('baiviet_lichkhaigiang');
                    array_push($relatedNewsArr, $this->config->item('baiviet_tienghansocap'), $this->config->item('baiviet_tienghantrungcap'),
                        $this->config->item('baiviet_luyenthitopik'), $this->config->item('baiviet_luyenthiklat'), $this->config->item('baiviet_luyenthieps'), $this->config->item('baiviet_daotaodoanhnghiep'));
                    break;
            }
            $data['detail'] = $this->News_model->getNewsById($newsId);    //array of a news.    if not return -1
            $data['banner_title'] = $data['detail'] != -1 ? $data['detail']['title'] : '';
            $data['banner_bg'] = $data['detail'] != -1 ? $data['detail']['img_src'] : '';
            $data['title_header'] = $data['banner_title'];

            $category_id = $data['detail'] != -1 ? $data['detail']['category_id'] : -1;
            $category_info = $this->Category_model->getInfoFromId($category_id);  //a category row. if not return -1

            $data['category_info'] = $category_info;

            $data['lst_post'] = $this->News_model->getNewsByCatId($category_id);
            $data['cur_post'] = $this->getIndexFromLstPost($data['lst_post'], $newsId);
            $data['max_post'] = count($data['lst_post']) - 1;


            $data['relatednews'] = $this->News_model->getNewsByIds($relatedNewsArr);
            $data['tagnews'] = $this->Tag_model->getTagByNewsId($newsId);
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

    /**
     * @param $slug_url
     * @param $data
     */
    public function loadDuHoc($slug_url, $data)
    {
        $duhochanquoc = $this->Category_model->findById($this->config->item('duhochanquoc'));
        foreach ($duhochanquoc as $duhoc) {
            $data['title_header'] = $duhoc['vi_name'];
            $data['parent'] = $duhoc;
        }

        if ($slug_url == null) {
            $categories = $this->Category_model->findByIds($this->config->item('cat_duhoc'));
            $data['categories'] = $categories;
            $this->load->view('pages/webapp/korean_study_aboard', $data);
        }
    }

    public function loadDaoTao($slug_url, $data)
    {
        $chuongtrinhdaotao = $this->Category_model->findById($this->config->item('chuongtrinhdaotao'));
        foreach ($chuongtrinhdaotao as $duhoc) {
            $data['title_header'] = $duhoc['vi_name'];
            $data['parent'] = $duhoc;
        }

        if ($slug_url == null) {
            $categories = $this->Category_model->findByIds($this->config->item('cat_chuongtrinhdaotao'));
            $data['categories'] = $categories;
            $this->load->view('pages/webapp/korean_study_aboard', $data);
        }
    }
}
