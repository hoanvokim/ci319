<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/29/16
 * Time: 9:44 PM
 */
class Admin_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
    }

    public function index()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Xem tổng quan';
        $this->load->view('pages/dm/index', $data);
    }

    public function login_submit()
    {
        $data["title"] = "Login";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|callback_check_database');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pages/security/login', $data);
        } else {
            redirect('admin', 'refresh');
        }

    }

    function logout()
    {
        $this->session->unset_userdata('authenticated_user');
        session_destroy();
        redirect('admin', 'refresh');
    }

    function check_database($password)
    {
        $email = $this->input->post('email');
        $result = $this->User_model->authenticate($email, $password);
        if ($result) {
            foreach ($result as $row) {
                $sess_array = array(
                    'id' => $row->id,
                    'email' => $row->email
                );
                $this->session->set_userdata('authenticated_user', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

    function change_password(){
        $data['title'] = 'Change password';
        $this->load->view('pages/dm/user/change_password', $data);
        $this->session->unset_userdata('status');
        $this->session->unset_userdata('message');
    }

    function change_password_submit(){
        $data['status']= '';
        $data['message'] = '';
        if (isset($_POST["save"])) {
            $authenticated_user = $this->session->userdata('authenticated_user');
            $user_id = $authenticated_user['id'];
            $user_row = $this->User_model->findById($user_id);
            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
            if(md5($old_password) == $user_row->password){
                if($new_password == $confirm_password){
                    $data = array('password' => md5($new_password));
                    $this->User_model->update($data,$user_id);
                    $data['status']= 'success';
                    $data['message']= 'Change password successfully.';
                }else{
                    $data['message'] = "New password and confirm password doesn't match";
                    $data['status'] = 'error';
                }
            }else{
                $data['status'] = 'success';
                $data['message'] = 'Old password is wrong';
            }
        }

        if (isset($_POST["cancel"])) {
        }
        $this->session->set_userdata('status',$data['status']);
        $this->session->set_userdata('message',$data['message']);
        redirect('edit-profile', 'refresh');
    }

}
