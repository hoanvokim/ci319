<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/29/16
 * Time: 9:44 PM
 */
class Tag_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }
        $this->load->model('Tag_model');
    }

    public function index()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['tags'] = $this->Tag_model->findAll();
        $data['title'] = 'Từ khoá';
        $this->load->view('pages/dm/tag/view_all', $data);
    }

    public function create_tag()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Thêm từ khoá';
        $this->load->view('pages/dm/tag/add', $data);
    }

    public function create_tag_submit()
    {
        $this->Tag_model->insert(
            $this->input->post('tagName')
        );
        redirect('tag-manager', 'refresh');
    }

    public function create_tag_cancel()
    {
        redirect('tag-manager', 'refresh');
    }

    public function update_tag()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $current = $this->Tag_model->findById($this->uri->segment(3));
        $data['tagId'] = $current['id'];
        $data['tagName'] = $current['name'];

        $data['title'] = 'Sửa từ khoá tìm kiếm';
        $this->load->view('pages/dm/tag/edit', $data);
    }

    public function update_tag_submit()
    {
        $this->Tag_model->update(
            $this->input->post('tagId'),
            $this->input->post('tagName')
        );

        redirect('tag-manager', 'refresh');
    }

    public function update_tag_cancel()
    {
        redirect('tag-manager', 'refresh');
    }

    public function delete_tag()
    {
        $this->Tag_model->delete($this->uri->segment(3));
        redirect('tag-manager', 'refresh');
    }

}
