<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/29/16
 * Time: 9:44 PM
 */
class Subcategory_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }
        $this->load->model('Category_model');
        $this->load->model('Tag_model');
        $this->load->model('News_model');
    }

    public function create_subcategory()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Tạo 1 phân nhóm phụ';
        $this->load->view('pages/dm/subcategory/add_sub_category', $data);
    }

    public function create_subcategory_submit()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        if (isset($_POST["save"])) {
            $this->Category_model->insertSubCategory($this->input->post('viCatName'), $this->input->post('slug'));
        }
        if (isset($_POST["cancel"])) {
        }
        $data['title'] = 'Tạo 1 phân nhóm phụ';
        $this->load->view('pages/dm/subcategory/add_sub_category', $data);
    }

    public function create_news_subcategory()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['categories'] = $this->Category_model->findAllSubCategory();
        $data['tags'] = $this->Tag_model->findAll();

        $data['title'] = 'viết bài cho phân nhóm phụ';
        $this->load->view('pages/dm/subcategory/add_news_sub_category', $data);
    }


    public function create_news_subcategory_submit()
    {
        if (isset($_POST["save"])) {
            $insertId = -1;
            $this->load->library('upload', $this->get_config());
            if ($this->upload->do_upload('userfile')) {
                $upload_files = $this->upload->data();
                $file_path = 'assets/upload/images/news/' . $upload_files['file_name'];

                $insertId = $this->News_model->insert_full(
                    $this->input->post('catId'),
                    $file_path,
                    $this->input->post('slug'),
                    $this->input->post('title_header'),
                    $this->input->post('description_header'),
                    $this->input->post('keyword_header'),
                    $this->input->post('vititle'),
                    $this->input->post('vicontent'),
                    $this->input->post('visummary')
                );
            } else {
                $insertId = $this->News_model->insert_full(
                    $this->input->post('catId'),
                    '',
                    $this->input->post('slug'),
                    $this->input->post('title_header'),
                    $this->input->post('description_header'),
                    $this->input->post('keyword_header'),
                    $this->input->post('vititle'),
                    $this->input->post('vicontent'),
                    $this->input->post('visummary')
                );
            }
            $tags = $this->input->post('tags');
            if (count($tags) > 0) {
                foreach ($tags as $tag) {
                    $this->Tag_model->saveReferenceNews($tag, $insertId);
                }
            }
        }
        if (isset($_POST["cancel"])) {
        }
        $data['categories'] = $this->Category_model->findAllSubCategory();
        $data['tags'] = $this->Tag_model->findAll();
        $data['title'] = 'viết bài cho phân nhóm phụ';
        $this->load->view('pages/dm/subcategory/add_news_sub_category', $data);
    }
    private function get_config()
    {
        return array(
            'upload_path' => "./assets/upload/images/news",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );

    }
}
