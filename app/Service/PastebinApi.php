<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.07.2018
 * Time: 14:18
 */

namespace App\Service;


class PastebinApi
{
    const API_URL = 'http://pastebin.com/api/api_post.php';
    const PASTE_NO_PASTE_OBJECT = -1;
    const PASTE_NO_DATA_IN_OBJECT = -2;
    /**
     * API key
     * @access private
     * @var string
     */
    private $_api_dev_key;
    /**
     *
     * @param string $api_dev_key API key
     */
    public function __construct($api_dev_key) {

        $this->set_api_dev_key($api_dev_key);
    }
    /**
     * Set API developer key
     * @access public
     * @param $api_dev_key string API der key
     */
    public function set_api_dev_key($api_dev_key) {

        $this->_api_dev_key = (string)$api_dev_key;
    }
    /**
     * Get API developer key
     * @access public
     * @return string API developer key
     */
    public function get_api_dev_key() {return $this->_api_dev_key;}
    /**
     * Create new paste in the pastebin server
     * @access public
     * @param $paste pastebin paste object with data
     * @return link to paste
     */
    public function send_paste(PastebinDto $paste) {
        if (is_null($paste)) return self::PASTE_NO_PASTE_OBJECT;
        if (strlen(trim($paste->get_paste_code())) == 0) return self::PASTE_NO_DATA_IN_OBJECT;
        $ch = curl_init(self::API_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'api_option=paste&api_dev_key='.$this->get_api_dev_key().'&'.$paste->get_query_string_from_my_params());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        return curl_exec($ch);
    }
    /**
     * List the 18 currently trending pastes
     * @access public
     * @return pastes xml-data
     */
    public function get_trending_pastes() {
        $ch = curl_init(self::API_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'api_option=trends&api_dev_key='.$this->get_api_dev_key());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        return curl_exec($ch);
    }
}