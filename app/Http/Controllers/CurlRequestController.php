<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurlRequestController extends Controller
{
        private $headers = [], $body = [], $response_timeout = 50, $request_timeout = 50;

        private function getHeaders()
        {
            return $this -> headers;
        }
        public function setHeaders($headers)
        {
            $this -> headers = $headers;
        }
        private function getBody()
        {
            return $this -> body;
        }
        public function setBody($body)
        {
            $this -> body = $body;
        }
        public function setUrl($url)
        {
            $this -> url = $url;
        }
        private function getUrl()
        {
            return $this -> url;
        }

        public function setResponseMethod($method)
        {
            $this -> method = $method;
        }
        private function getResponseMethod()
        {
            return $this -> method;
        }
        public function setRequestTimeout($request_timeout)
        {
            $this -> request_timeout = $request_timeout;
            return $this;
        }
        private function getRequestTimeout()
        {
            return $this -> request_timeout;
        }
        public function setResponseTimeout($response_timeout)
        {
            $this -> response_timeout = $response_timeout;
            return $this;
        }
        private function getResponseTimeout()
        {
            return $this -> response_timeout;
        }


        public function httpPost()
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this -> getHeaders());
            curl_setopt($ch, CURLOPT_URL,$this -> getUrl());
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this -> getResponseMethod());
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this -> getBody());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this -> getRequestTimeout());
            curl_setopt($ch, CURLOPT_TIMEOUT, $this -> getResponseTimeout());
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $err = curl_error($ch);
            curl_close ($ch);

            return ['response' => json_decode($response, true), 'status_code' => $http_code, 'error' => $err];
        }

}
