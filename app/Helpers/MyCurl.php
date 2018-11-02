<?php
/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/11/18
 * Time: 10:44 AM
 */

namespace App\Helpers;


class MyCurl
{
    public $httpHeader = array(
        'Content-Type: application/json'
    );
    public $headers = array();
    public $error;
    protected $handle;

    public function __construct($headers = array('Content-Type: application/json'))
    {
        $this->handle = curl_init();
        curl_setopt($this->handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, true);
    }

    public function get($url, $vars = array()) {
        if (!empty($vars)) {
            $url .= (stripos($url, '?') !== false) ? '&' : '?';
            $url .= http_build_query($vars, '', '&');
        }
        return $this->request('GET', $url);
    }

    public function post($url, $vars) {
        return $this->request('POST', $url, $vars);
    }

    public function close() {
        if ($this->handle) {
            curl_close($this->handle);
        }
    }

    public function request($method, $url, $vars = array()) {
        curl_setopt($this->handle, CURLOPT_POSTFIELDS, (is_array($vars) ? json_encode($vars) : $vars));
        switch ($method) {
            case 'GET':
                curl_setopt($this->handle, CURLOPT_HTTPGET, true);
                break;
            case 'POST':
                curl_setopt($this->handle, CURLOPT_POST, true);
                break;
            default:
                curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, $method);
        }
        curl_setopt($this->handle, CURLOPT_URL, $url);
        $response = curl_exec($this->handle);
        if (!$response) {
            $this->error = curl_error($this->handle) . ' - ' . curl_error($this->handle);
            dd($this->error);
        }
        curl_close($this->handle);

        return json_decode($response, true);
    }
}