<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 3/7/16
 * Time: 10:58 PM
 */
class Utilities
{
    public function loadPropertiesFiles($lang)
    {
        if(empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "en";
        }
        if (strcasecmp($_SESSION["activeLanguage"], "vi") == 0) {
            $lang->load('message', 'vietnamese');
        } else {
            $lang->load('message', 'english');
        }
    }
    function IsNullOrEmptyString($question){
        return (!isset($question) || trim($question)==='');
    }
}
