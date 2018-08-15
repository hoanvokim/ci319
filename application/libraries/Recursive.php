<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 3/17/16
 * Time: 3:09 PM
 */
class Recursive
{
    public function loadPropertiesFiles($lang)
    {
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
?>

