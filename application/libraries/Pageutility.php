<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 3/7/16
 * Time: 10:58 PM
 */
class Pageutility{

    public $limit = 1000;

    public $total_page = 0;

    public function setData($total_row, $limiter){
        if($total_row > $limiter){
            $this->limit = $limiter;
            $temp = $total_row%$this->limit;
            $total = intval($total_row/$this->limit);
            $this->total_page = $temp == 0 ? $total : ($total + 1);
        }
    }

}