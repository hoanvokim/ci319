<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 9/4/17
 * Time: 10:27 PM
 */
class Setting_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }

        $this->load->model('Setting_model');
    }

    public function index()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Cập nhật các thiết lập trong website';
        $data['settings'] = $this->Setting_model->getSettingData();
        $this->load->view('pages/dm/setting/setting', $data);
    }

    public function updateSettingSubmit()
    {
        $settings = $this->Setting_model->getSettingData();
        foreach ($settings as $setting) {
            $this->Setting_model->update(
                $setting['key'],
                $this->input->post($setting['key'])
            );
        }
        redirect('setting-manager', 'refresh');
    }

}
