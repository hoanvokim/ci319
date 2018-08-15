<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/29/16
 * Time: 9:44 PM
 */
class Sharing_controller extends CI_Controller
{

    public $scheduleId = 60;

    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }
        $this->load->model('News_model');
        $this->load->model('Gallery_model');
        $this->load->model('Tag_model');
    }

    public function index()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $categories = array();
        $data['programs'] = $this->News_model->getNewsByCatId($this->scheduleId);
        foreach ($data['programs'] as $program) {
            $type = 'images';
            if (strpos($program['img_src'], 'youtube') !== false) {
                $type = 'youtube';
            }

            array_push($categories, array(
                'id' => $program['id'],
                'title' => $program['title'],
                'summary' => $program['summary'],
                'type' => $type,
                'updated_date' => $program['updated_date'],
                'created_date' => $program['created_date']
            ));
        }
        $data['programs'] = $categories;
        $data['title'] = 'Góc chia sẻ';
        $this->load->view('pages/dm/sharing/view_all', $data);
    }

    public function create_sharing()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Thêm thời khoá biểu mới';
        $data['tags'] = $this->Tag_model->findAll();
        $this->load->view('pages/dm/sharing/add', $data);
    }

    public function create_sharing_submit()
    {
        $insertId = -1;
        $this->load->library('upload', $this->get_config());
        if ($this->upload->do_upload('albumFile')) {
            $upload_files = $this->upload->data();
            $file_path = 'assets/upload/images/sharing/' . $upload_files['file_name'];
            $insertId = $this->News_model->insert_full(
                $this->scheduleId,
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
                $this->scheduleId,
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

        //upload images into album

        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        if (strlen($_FILES['userfile']['name'][0]) > 0) {
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload();
                $fileName = $_FILES['userfile']['name'];
                $images[] = $fileName;
            }
            $this->Gallery_model->insertNewsImage($images, $insertId);
        }

        $tags = $this->input->post('tags');
        if (count($tags) > 0) {
            foreach ($tags as $tag) {
                $this->Tag_model->saveReferenceNews($tag, $insertId);
            }
        }
        redirect('sharing-manager', 'refresh');
    }

    public function create_sharing_cancel()
    {
        redirect('sharing-manager', 'refresh');
    }

    public function update_sharing()
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
        $data['youtube_thumbnail'] = $this->getThumbnailFromYoutubeLink($current['img_src']);
        $data['images'] = $this->Gallery_model->getGalleryByNewsId($current['id']);

        $data['title'] = 'Cập nhật bài viết:<strong>' . $current['title'] . '</strong>';
        $data['tags'] = $this->Tag_model->findAll();
        $data['selectedTags'] = $this->Tag_model->getTagByNewsId($this->uri->segment(3));
        $this->load->view('pages/dm/sharing/edit', $data);
    }

    public function update_sharing_submit()
    {
        if (isset($_POST["save"])) {
            $this->load->library('upload', $this->get_config());
            if ($this->upload->do_upload('albumFile')) {
                $upload_files = $this->upload->data();
                $file_path = 'assets/upload/images/sharing/' . $upload_files['file_name'];

                $this->News_model->update_full(
                    $this->input->post('newsId'),
                    $this->scheduleId,
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
                    $this->scheduleId,
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
            redirect('sharing-manager', 'refresh');
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
            $data['youtube_thumbnail'] = '';
            $data['images'] = $this->Gallery_model->getGalleryByNewsId($this->input->post('newsId'));
            $data['title'] = 'Cập nhật trường đại học';
            $this->load->view('pages/dm/sharing/edit', $data);
        }
        if (isset($_POST["cancel"])) {
            redirect('sharing-manager', 'refresh');
        }
        if (isset($_POST["delete"])) {
            $listGallery = $this->Gallery_model->getGalleryByNewsId($this->input->post('newsId'));
            foreach ($listGallery as $item) {
                if(!is_null($item['img_src'])) {
                    unlink('./' . $item['img_src']);
                }
            }
            $this->Gallery_model->deleteImagesByNewsID($this->input->post('newsId'));
            $this->News_model->delete($this->input->post('newsId'));
            redirect('sharing-manager', 'refresh');
        }
        if (isset($_POST["delete-img"])) {
            if (count($this->input->post('deleteimg')) > 0) {
                foreach ($this->input->post('deleteimg') as $item) {
                    $img = $this->Gallery_model->getGalleryById($item);
                    if(!is_null($img['img_src'])) {
                        unlink('./' . $img['img_src']);
                    }
                }
                $this->Gallery_model->deleteList($this->input->post('deleteimg'));
            }
            //
            $data['newsId'] = $this->input->post('newsId');
            $data['img_src'] = $this->input->post('img_src');
            $data['slug'] = $this->input->post('slug');
            $data['title_header'] = $this->input->post('title_header');
            $data['description_header'] = $this->input->post('description_header');
            $data['keyword_header'] = $this->input->post('keyword_header');
            $data['vititle'] = $this->input->post('vititle');
            $data['vicontent'] = $this->input->post('contenteditor');
            $data['visummary'] = $this->input->post('summaryeditor');
            $data['youtube_thumbnail'] = $this->getThumbnailFromYoutubeLink($this->input->post('img_src'));
            $data['images'] = $this->Gallery_model->getGalleryByNewsId($this->input->post('newsId'));
            $data['title'] = 'Cập nhật trường đại học';
            $this->load->view('pages/dm/sharing/edit', $data);
        }
        if (isset($_POST["add-img"])) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload();
                $fileName = $_FILES['userfile']['name'];
                $images[] = $fileName;
            }
            $this->Gallery_model->insertNewsImage($images, $this->input->post('newsId'));
            //
            $data['newsId'] = $this->input->post('newsId');
            $data['img_src'] = $this->input->post('img_src');
            $data['slug'] = $this->input->post('slug');
            $data['title_header'] = $this->input->post('title_header');
            $data['description_header'] = $this->input->post('description_header');
            $data['keyword_header'] = $this->input->post('keyword_header');
            $data['vititle'] = $this->input->post('vititle');
            $data['vicontent'] = $this->input->post('contenteditor');
            $data['visummary'] = $this->input->post('summaryeditor');
            $data['youtube_thumbnail'] = $this->getThumbnailFromYoutubeLink($this->input->post('img_src'));
            $data['images'] = $this->Gallery_model->getGalleryByNewsId($this->input->post('newsId'));
            $data['title'] = 'Cập nhật trường đại học';
            $this->load->view('pages/dm/sharing/edit', $data);
        }

    }

    public function update_sharing_cancel()
    {
        redirect('sharing-manager', 'refresh');
    }

    public function delete_sharing()
    {
        $listGallery = $this->Gallery_model->getGalleryByNewsId($this->uri->segment(3));
        if(count($listGallery)>0) {
            foreach ($listGallery as $item) {
                if(!is_null($item['img_src'])) {
                    unlink('./' . $item['img_src']);
                }
            }
        }
        $this->Gallery_model->deleteImagesByNewsID($this->uri->segment(3));
        $this->News_model->delete($this->uri->segment(3));
        redirect('sharing-manager', 'refresh');
    }


    private function get_config()
    {
        return array(
            'upload_path' => "./assets/upload/images/sharing",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );

    }

    private function set_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = "./assets/upload/images/sharing";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '20480000';
        $config['overwrite'] = TRUE;

        return $config;
    }

    public function getThumbnailFromYoutubeLink($youtube_link)
    {
        if (strlen($youtube_link) > 0) {
            if (strpos($youtube_link, 'embed') !== false) {
                //embed link.
                $video_id = substr(str_replace('embed/', '', $youtube_link), strripos($youtube_link, 'embed/'));
            } else {
                $video_id = substr(str_replace('watch?v=', '', $youtube_link), strripos($youtube_link, 'watch?v='));
            }
            return "http://img.youtube.com/vi/$video_id/0.jpg";
        } else {
            return '';
        }
    }
}