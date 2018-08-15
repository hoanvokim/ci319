<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/29/16
 * Time: 9:44 PM
 */
class News_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }
        $this->load->model('News_model');
        $this->load->model('Category_model');
        $this->load->model('Tag_model');
    }

    public function all_news()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['categories'] = $this->Category_model->findStudyAbroadRoot();
        $categories = array();
        foreach ($data['categories'] as $category) {
            $categories = $this->loadSubJustId($categories, $category);
        }
        $data['categories'] = $categories;
        $news = $this->News_model->getNewsByCatCollectionWithoutLimit($categories);
        $news_list = array();
        foreach ($news as $item) {
            if (!in_array($item['id'], $this->config->item('cat_duhoc'))) {
                array_push($news_list, array(
                    'id' => $item['id'],
                    'category' => $this->Category_model->findCategoryNameFromId($item['category_id']),
                    'title' => $item['title'],
                    'summary' => $item['summary'],
                    'created_date' => $item['created_date'],
                    'updated_date' => $item['updated_date']
                ));
            }
        }
        $data['news_list'] = $news_list;
        $data['title'] = 'Các bài viết';
        $this->load->view('pages/dm/study/news_view_all', $data);
    }

    public function loadSubJustId($categories, $currentCategory)
    {
        $subCategories = $this->Category_model->findByParent($currentCategory['id']);
        if (count($subCategories) > 0) {
            foreach ($subCategories as $category) {
                array_push($categories, $category['id']);
                $categories = $this->loadSubJustId($categories, $category);
            }
        }
        return $categories;
    }

    public function update_study_news()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $current = $this->News_model->getNewsById($this->uri->segment(3));
        $data['newsId'] = $current['id'];
        $data['catId'] = $current['category_id'];
        $data['catName'] = $this->Category_model->findCategoryNameFromId($current['category_id']);
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
        $this->load->view('pages/dm/study/news_edit', $data);
    }

    public function update_study_news_submit()
    {
        if (isset($_POST["save"])) {
            $this->load->library('upload', $this->get_config());
            if ($this->upload->do_upload('userfile')) {
                $upload_files = $this->upload->data();
                $file_path = 'assets/upload/images/news/' . $upload_files['file_name'];

                $this->News_model->update_full(
                    $this->input->post('newsId'),
                    $this->input->post('catId'),
                    $file_path,
                    $this->input->post('slug'),
                    $this->input->post('title_header'),
                    $this->input->post('description_header'),
                    $this->input->post('keyword_header'),
                    $this->input->post('vititle'),
                    $this->input->post('contenteditor'),
                    $this->input->post('summaryeditor')
                );
            }
            else {
                $this->News_model->update_full(
                    $this->input->post('newsId'),
                    $this->input->post('catId'),
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
            redirect('manage-study-news', 'refresh');
        }
        if (isset($_POST["remove-current"])) {
            $this->News_model->updateImage($this->input->post('newsId'));
            if (strpos($this->input->post('img_src'), 'youtube') == false) {
                unlink('./' . $this->input->post('img_src'));
            }
            $data['newsId'] = $this->input->post('newsId');
            $data['catId'] = $this->input->post('catId');
            $data['img_src'] = '';
            $data['slug'] = $this->input->post('slug');
            $data['title_header'] = $this->input->post('title_header');
            $data['description_header'] = $this->input->post('description_header');
            $data['keyword_header'] = $this->input->post('keyword_header');
            $data['vititle'] = $this->input->post('vititle');
            $data['vicontent'] = $this->input->post('contenteditor');
            $data['visummary'] = $this->input->post('summaryeditor');
            $data['title'] = 'Cập nhật bài viết:<strong>' . $this->input->post('vititle') . '</strong>';
            $data['tags'] = $this->Tag_model->findAll();
            $data['selectedTags'] = $this->Tag_model->getTagByNewsId($this->input->post('newsId'));
            $this->load->view('pages/dm/study/news_edit', $data);
        }
    }

    public function update_study_news_cancel()
    {
        redirect('manage-study-news', 'refresh');
    }

    public function add_news()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['categories'] = $this->Category_model->findStudyAbroadRoot();
        $categories = array();
        foreach ($data['categories'] as $category) {
            $categories = $this->loadSub($categories, $category, 0);
        }
        $data['categories'] = $categories;

        $data['title'] = 'Viết bài';
        $data['tags'] = $this->Tag_model->findAll();
        $this->load->view('pages/dm/study/study_news_add', $data);
    }

    public function add_news_into_category()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['categories'] = $this->Category_model->findStudyAbroadRoot();
        $categories = array();
        foreach ($data['categories'] as $category) {
            $categories = $this->loadSub($categories, $category, $this->uri->segment(3));
        }
        $data['categories'] = $categories;
        $data['currentCategory'] = $this->uri->segment(3);
        $data['title'] = 'Viết bài';
        $data['tags'] = $this->Tag_model->findAll();
        $this->load->view('pages/dm/study/study_news_add_into_category', $data);
    }

    public function loadSub($categories, $currentCategory, $id)
    {
        $subCategories = $this->Category_model->findByParent($currentCategory['id']);
        if (count($subCategories) > 0) {
            foreach ($subCategories as $category) {
                $this->load->model('News_model');
                $can_be_write = $this->Category_model->hasChild($category['id']);

                if (!$can_be_write && !in_array($category['id'], $this->config->item('cat_duhoc'))) {
                    array_push($categories, array(
                        'id' => $category['id'],
                        'vi_name' => $category['vi_name'],
                        'parent_id' => $currentCategory['vi_name'],
                        'updated_date' => $category['updated_date'],
                        'created_date' => $category['created_date'],
                        'can_be_deleted' => FALSE,
                    ));
                }
                $categories = $this->loadSub($categories, $category, $id);
            }
        }
        return $categories;
    }

    public function add_news_add()
    {
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
                $this->input->post('contenteditor'),
                $this->input->post('summaryeditor')
            );
        }
        else {
            $insertId = $this->News_model->insert_full(
                $this->input->post('catId'),
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
        redirect('manage-study-news', 'refresh');
    }

    public function add_news_into_category_add()
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
                    $this->input->post('contenteditor'),
                    $this->input->post('summaryeditor')
                );
            }
            else {
                $insertId = $this->News_model->insert_full(
                    $this->input->post('catId'),
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
            redirect('manage-study-category', 'refresh');
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
            $data['contenteditor'] = $this->input->post('contenteditor');
            $data['summaryeditor'] = $this->input->post('summaryeditor');
            $data['currentCategory'] = $this->input->post('catId');
            $data['title'] = 'Cập nhật bài viết:<strong>' . $this->input->post('vititle') . '</strong>';
            $this->load->view('pages/dm/news/edit', $data);

        }
    }

    public function delete_news_category()
    {
        $news = $this->News_model->getNewsByCatId($this->uri->segment(3));
        foreach ($news as $item) {
            if (!is_null($item['img_src'])) {
                unlink('./' . $item['img_src']);
            }
        }
        $this->News_model->delete($this->uri->segment(3));
        redirect('manage-study-news', 'refresh');
    }

    public function delete_news_id()
    {
        $news = $this->News_model->getNewsById($this->uri->segment(3));
        if (!is_null($news['img_src'])) {
            unlink('./' . $news['img_src']);
        }
        $this->News_model->delete($this->uri->segment(3));
        redirect('manage-study-news', 'refresh');
    }

    public function add_news_cancel()
    {
        redirect('admin', 'refresh');
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