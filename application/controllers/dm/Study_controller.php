<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/29/16
 * Time: 9:44 PM
 */
class Study_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }
        $this->load->model('Category_model');
        $this->load->model('News_model');
    }

    public function view_all()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['categories'] = $this->Category_model->findStudyAbroadRoot();
        $categories = array();
        $can_be_deleted = TRUE;
        foreach ($data['categories'] as $category) {
            if ($this->Category_model->findByParent($category['id'])) {
                $can_be_deleted = FALSE;
            };
            $can_be_write = $this->Category_model->hasChild($category['id']);
            array_push($categories, array(
                'id' => $category['id'],
                'isView' => 0,
                'vi_name' => $category['vi_name'],
                'parent_id' => $category['parent_id'],
                'updated_date' => $category['updated_date'],
                'created_date' => $category['created_date'],
                'can_be_deleted' => $can_be_deleted,
                'can_be_edited' => false,
                'can_be_write' => $can_be_write
            ));
            $categories = $this->loadSub($categories, $category);
        }
        $data['categories'] = $categories;
        $data['title'] = 'Xem tất cả phân nhóm';
        $this->load->view('pages/dm/study/study_view_all', $data);
    }

    public function loadSub($categories, $currentCategory)
    {
        $subCategories = $this->Category_model->findByParent($currentCategory['id']);
        if (count($subCategories) > 0) {
            foreach ($subCategories as $category) {

                $current_news_list = $this->News_model->getNewsByCatId($category['id']);
                $isView = 0;
                if (count($current_news_list) > 0) {
                    $isView = 1;
                }
                $can_be_write = $this->Category_model->hasChild($category['id']);
                array_push($categories, array(
                    'id' => $category['id'],
                    'isView' => $isView,
                    'vi_name' => $category['vi_name'],
                    'parent_id' => $currentCategory['vi_name'],
                    'updated_date' => $category['updated_date'],
                    'created_date' => $category['created_date'],
                    'can_be_deleted' => FALSE,
                    'can_be_edited' => TRUE,
                    'can_be_write' => $can_be_write
                ));
                $categories = $this->loadSub($categories, $category);
            }
        }
        return $categories;
    }

    public function create_category()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['categories'] = $this->Category_model->findStudyAbroadRoot();
        $categories = array();
        foreach ($data['categories'] as $category) {
            array_push($categories, array(
                'id' => $category['id'],
                'vi_name' => $category['vi_name']
            ));
            $categories = $this->loadSub($categories, $category);
        }
        $data['categories'] = $categories;
        $data['title'] = 'Thêm 1 phân nhóm mới';
        $this->load->view('pages/dm/study/study_create_category', $data);
    }

    public function create_category_add()
    {
        $this->Category_model->insertWithParent($this->input->post('viCatName'), $this->input->post('slug'), $this->input->post('parentCatId'));
        redirect('manage-study-category', 'refresh');

    }

    public function create_category_cancel()
    {
        redirect('manage-study-category', 'refresh');
    }

    public function update_category()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        //getCurrent
        $currentCategory = $this->Category_model->findById($this->uri->segment(3));
        $data['currentCategory'] = $currentCategory;

        //getParent
        foreach ($data['currentCategory'] as $category) {
            $parentCategory = $this->Category_model->findById($category['parent_id']);
            $data['parentCategory'] = $parentCategory;
        }

        $data['catId'] = $this->uri->segment(3);
        $data['title'] = 'Thêm 1 phân nhóm mới';
        $this->load->view('pages/dm/study/study_update_category', $data);
    }

    public function update_category_add()
    {
        $this->Category_model->updateWithParent($this->input->post('catId') ,$this->input->post('slug'), $this->input->post('viCatName'));
        redirect('manage-study-category', 'refresh');
    }

    public function update_category_cancel()
    {
        redirect('manage-study-category', 'refresh');
    }

    public function delete_category()
    {
        $this->Category_model->delete($this->uri->segment(3));
        redirect('manage-study-category', 'refresh');
    }

    public function add_child()
    {
        //getCurrent
        $currentCategory = $this->Category_model->findById($this->uri->segment(3));
        $data['currentCategory'] = $currentCategory;

        //getParent
        foreach ($data['currentCategory'] as $category) {
            $parentCategory = $this->Category_model->findById($category['parent_id']);
            $data['parentCategory'] = $parentCategory;
        }

        $data['catId'] = $this->uri->segment(3);
        $data['title'] = 'Thêm 1 phân nhóm mới';
        $this->load->view('pages/dm/study/study_add_child', $data);
    }

    public function add_child_category()
    {
        $this->Category_model->insertWithParent($this->input->post('viCatName'), $this->input->post('slug'),$this->input->post('catId'));
        redirect('manage-study-category', 'refresh');
    }
}
