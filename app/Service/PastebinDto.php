<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.07.2018
 * Time: 14:20
 */

namespace App\Service;


class PastebinDto
{

    const MAX_PASTE_CODE_SIZE = 524288; // 0.5 * 1024* 1024
    const EXPIRE_DATES = 'N,10M,1H,3H,1W,1D,1M';
    /**
     * Your paste text
     * @access private
     * @var string
     */
    private $_paste_code;
    /**
     * makes a paste public or private (default - public)
     * @access private
     * @var string
     */
    private $_paste_private = 0;
    /**
     * name or title of your paste
     * @access private
     * @var string
     */
    private $_paste_name = '';
    /**
     * expiration date of your paste
     * @access private
     * @var string
     */
    private $_paste_expire_date = '';
    /**
     * syntax highlighting value
     * @access private
     * @var string
     */
    private $_paste_format = '';
    /**
     * Your paste text
     * @access private
     * @var string
     */
    private $_user_key = '';
    public function __construct(){}
    /**
     * Set paste text
     * @access public
     * @param $code string paste text
     * @return bool true - success, false - fail
     */
    public function set_paste_code($code) {
        $code = (string)$code;
        if (strlen($code) > self::MAX_PASTE_CODE_SIZE || strlen($code) === 0) {return false;}
        $this->_paste_code = $code;
    }
    /**
     * Get paste text
     * @access public
     * @return string paste text
     */
    public function get_paste_code() {return $this->_paste_code;}
    /**
     * makes a paste public or private
     * @access private
     * @param $c int private status (0=public 1=unlisted 2=private)
     */
    private function _set_paste_private($c) {
        $c = intval($c);
        if ($c > 2 || $c < 0) return;
        $this->_paste_private = $c;
    }
    public function set_me_public() {$this->_set_paste_private(0);}
    public function set_me_unlisted() {$this->_set_paste_private(1);}
    public function set_me_private() {$this->_set_paste_private(2);}
    /**
     * Get paste private status
     * @access public
     * @return int private status
     */
    public function get_paste_private() {return $this->_paste_private;}
    /**
     * Set paste name
     * @access public
     * @param $name string paste name
     */
    public function set_paste_name($name) {

        $this->_paste_name = (string)$name;
    }
    /**
     * Get paste name
     * @access public
     * @return string
     */
    public function get_paste_name() {return $this->_paste_name;}
    /**
     * Set expire date
     * @access public
     * @param $date string expire date
     */
    public function set_paste_expire_date($date) {
        $date = (string)$date;
        if (!in_array($date, explode(',', self::EXPIRE_DATES))) return;
        $this->_paste_expire_date = $date;
    }
    /**
     * Get expire date
     * @access public
     * @return string expire data
     */
    public function get_paste_expire_date() {return $this->_paste_expire_date;}
    /**
     * Set paste format
     * @access public
     * @param string $format past format
     */
    public function set_paste_format($format) {

        $this->_paste_format = (string)$format;
    }
    /**
     * Get paste format
     * @access public
     * @return string paste format
     */
    public function get_paste_format() {return $this->_paste_format;}
    /**
     * Get API user key
     * @access public
     * @return string api user key
     */
    public function get_user_key() {return $this->_user_key;}
    /**
     * Get query string with current paste params for API-request
     * @access public
     * @return string query string
     */
    public function get_query_string_from_my_params() {

        return 'api_paste_private='.$this->get_paste_private().'&api_paste_name='.urlencode($this->get_paste_name()).'&api_paste_expire_date='.$this->get_paste_expire_date().'&api_paste_format='.$this->get_paste_format().'&api_paste_code='.urlencode($this->get_paste_code()).'';
    }
}