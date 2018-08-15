<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/29/16
 * Time: 9:44 PM
 */
class Faq_controller extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }
        $this->load->model('Faq_model');
    }

    public function index()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['faqs'] = $this->Faq_model->findAll();
        $data['title'] = 'Câu hỏi thường gặp';
        $this->load->view('pages/dm/faq/view_all', $data);
    }

    public function create_faq()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Thêm câu hỏi thường gặp';
        $this->load->view('pages/dm/faq/add', $data);
    }

    public function create_faq_submit()
    {
        $this->Faq_model->insert(
            $this->input->post('faqQuestion'),
            $this->input->post('contenteditor')
        );
        redirect('faq-manager', 'refresh');
    }

    public function create_faq_cancel()
    {
        redirect('faq-manager', 'refresh');
    }

    public function update_faq()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $current = $this->Faq_model->findById($this->uri->segment(3));
        $data['faqId'] = $current['id'];
        $data['faqQuestion'] = $current['vi_question'];
        $data['faqAnswer'] = $current['vi_answer'];

        $data['title'] = 'Cập nhật nội dung';
        $this->load->view('pages/dm/faq/edit', $data);
    }

    public function update_faq_submit()
    {
        $this->Faq_model->update(
            $this->input->post('faqId'),
            $this->input->post('faqQuestion'),
            $this->input->post('contenteditor')
        );

        redirect('faq-manager', 'refresh');
    }

    public function update_faq_cancel()
    {
        redirect('faq-manager', 'refresh');
    }

    public function delete_faq()
    {
        $this->Faq_model->delete($this->uri->segment(3));
        redirect('faq-manager', 'refresh');
    }

}
