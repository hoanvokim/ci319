<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/29/16
 * Time: 9:44 PM
 */
class Studyabroad_controller extends CI_Controller
{

    public $programId = 72;

    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }
        $this->load->model('News_model');
        $this->load->model('Tag_model');
        $this->load->model('Gallery_model');
    }

    public function index()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['programs'] = $this->News_model->getNewsByCatId($this->programId);
        $data['title'] = 'Thông tin du học';
        $this->load->view('pages/dm/studyabroad/view_all', $data);
    }

    public function create_studyabroad()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Thêm tin mới';
        $data['tags'] = $this->Tag_model->findAll();
        $this->load->view('pages/dm/studyabroad/add', $data);
    }

    public function create_studyabroad_submit()
    {
        $insertId = -1;
        $this->load->library('upload', $this->get_config());
        if ($this->upload->do_upload('userfile')) {
            $upload_files = $this->upload->data();
            $file_path = 'assets/upload/images/news/' . $upload_files['file_name'];
            $insertId = $this->News_model->insert_full(
                $this->programId,
                $file_path,
                $this->input->post('slug'),
                $this->input->post('title_header'),
                $this->input->post('description_header'),
                $this->input->post('keyword_header'),
                $this->input->post('vititle'),
                $this->input->post('contenteditor'),
                $this->input->post('summaryeditor')
            );
        } else {
            $insertId = $this->News_model->insert_full(
                $this->programId,
                $this->input->post('img_src'),
                $this->input->post('slug'),
                $this->input->post('title_header'),
                $this->input->post('description_header'),
                $this->input->post('keyword_header'),
                $this->input->post('vititle'),
                $this->input->post('contenteditor'),
                $this->input->post('summaryeditor')
            );
        }
        $tags = $this->input->post('tags');
        if (count($tags) > 0) {
            foreach ($tags as $tag) {
                $this->Tag_model->saveReferenceNews($tag, $insertId);
            }
        }
        redirect('studyabroad-manager', 'refresh');
    }

    public function create_studyabroad_cancel()
    {
        redirect('studyabroad-manager', 'refresh');
    }

    public function update_studyabroad()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $current = $this->News_model->getNewsById($this->uri->segment(3));
        $data['newsId'] = $current['id'];
        $data['slug'] = $current['slug'];
        $data['title_header'] = $current['title_header'];
        $data['description_header'] = $current['description_header'];
        $data['keyword_header'] = $current['keyword_header'];
        $data['vititle'] = $current['title'];
        $data['vicontent'] = $current['content'];
        $data['visummary'] = $current['summary'];
        $data['img_src'] = $current['img_src'];

        $data['title'] = 'Cập nhật bài viết:<strong>' . $current['title'] . '</strong>';
        $data['tags'] = $this->Tag_model->findAll();
        $data['selectedTags'] = $this->Tag_model->getTagByNewsId($this->uri->segment(3));
        $this->load->view('pages/dm/studyabroad/edit', $data);
    }

    public function update_studyabroad_submit()
    {

        if (isset($_POST["save"])) {
            $this->load->library('upload', $this->get_config());
            if ($this->upload->do_upload('userfile')) {
                $upload_files = $this->upload->data();
                $file_path = 'assets/upload/images/news/' . $upload_files['file_name'];

                $this->News_model->update_full(
                    $this->input->post('newsId'),
                    $this->programId,
                    $file_path,
                    $this->input->post('slug'),
                    $this->input->post('title_header'),
                    $this->input->post('description_header'),
                    $this->input->post('keyword_header'),
                    $this->input->post('vititle'),
                    $this->input->post('contenteditor'),
                    $this->input->post('summaryeditor')
                );
            } else {
                $this->News_model->update_full(
                    $this->input->post('newsId'),
                    $this->programId,
                    $this->input->post('img_src'),
                    $this->input->post('slug'),
                    $this->input->post('title_header'),
                    $this->input->post('description_header'),
                    $this->input->post('keyword_header'),
                    $this->input->post('vititle'),
                    $this->input->post('contenteditor'),
                    $this->input->post('summaryeditor')
                );
            }
            $this->Tag_model->deleteByNews($this->input->post('newsId'));
            $tags = $this->input->post('tags');
            if (count($tags) > 0) {
                foreach ($tags as $tag) {
                    $this->Tag_model->saveReferenceNews($tag, $this->input->post('newsId'));
                }
            }
            redirect('studyabroad-manager', 'refresh');
        }
        if (isset($_POST["remove-current"])) {
            $this->News_model->updateImage($this->input->post('newsId'));
            if (strpos($this->input->post('img_src'), 'youtube') == false) {
                unlink('./' . $this->input->post('img_src'));
            }
            $data['newsId'] = $this->input->post('newsId');
            $data['img_src'] = '';
            $data['slug'] = $this->input->post('slug');
            $data['title_header'] = $this->input->post('title_header');
            $data['description_header'] = $this->input->post('description_header');
            $data['keyword_header'] = $this->input->post('keyword_header');
            $data['vititle'] = $this->input->post('vititle');
            $data['vicontent'] = $this->input->post('contenteditor');
            $data['visummary'] = $this->input->post('summaryeditor');
            $data['title'] = 'Cập nhật bài viết:<strong>' . $this->input->post('vititle') . '</strong>';
            $this->load->view('pages/dm/studyabroad/edit', $data);

        }
    }

    public function update_studyabroad_cancel()
    {
        redirect('studyabroad-manager', 'refresh');
    }

    public function delete_studyabroad()
    {
        $news = $this->News_model->getNewsById($this->uri->segment(3));

        if (!is_null($news['img_src'])) {
            unlink('./' . $news['img_src']);
        }
        $this->News_model->delete($this->uri->segment(3));
        redirect('studyabroad-manager', 'refresh');
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
