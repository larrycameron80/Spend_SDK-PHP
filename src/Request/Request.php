<?php
namespace Ctk\Request\Request;


abstract class Request
{
    protected $endpoint = '';
    protected $method = 'GET';
    protected $srvApiToken;
    protected $url;
    protected $accessToken;
    protected $headers = [];
    protected $data = [];
    protected $autoProccessData = true;
    protected $callback;
    protected $select;
    protected $response;

    public function __construct($url, $accessToken, $srvApiToken)
    {
        $this->url = $url;
        $this->accessToken = $accessToken;
        $this->srvApiToken = $srvApiToken;

        $this->setHeader('Content-Type', 'application/json');

        if ($this->srvApiToken) {
            $this->setHeader('Auth', $this->srvApiToken);
        } else {
            $this->setHeader('Authorization', $this->accessToken);
        }
    }

    public function call() {
        $url = sprintf('%s/api/%s', $this->getUrl(), $this->getEndpoint()) ;

        if (($this->method == 'GET') && !empty($this->data)) {
            $url .= '?' . http_build_query($this->data);
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if ($this->getHeaders()) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
        }

        if (($this->method != 'GET')) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->data));
        }

        $rawResponse = curl_exec($ch);
        $this->response = json_decode($rawResponse, true);

        $response = $this->response;

        if ($response['success'] && $this->autoProccessData) {
            $response = !empty($response['data']) ? $response['data'] : $response;
        } else {
            $errors = [];

            if (!empty($response['error'])) {
                foreach ($response['error'] as $error) {
                    $errors[] = $error['message'];
                }
            }

            //throw new \Exception(implode(', ', $errors));
        }

        curl_close($ch);

        $this->headers = [];

        if (!empty($response[$this->select])) {
            return $response[$this->select];
        } else {
            return $this->callback ? $this->doCallback($response) : $response;
        }
    }

    private function doCallback($response) {
        $callback = $this->callback;

        return $callback($response);
    }

    public function setCallback($callback) {
        $this->callback = $callback;

        return $this;
    }

    public function setAutoProcessData($status) {
        $this->autoProccessData = (bool)$status;

        return $this;
    }

    public function select($item) {
        $this->select = $item;

        return $this;
    }

    private function getHeaders() {
        return $this->headers;
    }

    private function setHeader($key, $value) {
        $this->headers[] = sprintf('%s: %s', $key, $value);

        return $this;
    }

    private function getUrl() {
        return $this->url;
    }

    private function getEndpoint() {
        return $this->endpoint;
    }

    protected function setMethod($method) {
        $this->method = $method;

        return $this;
    }

    protected function setEndpoint($endpoint) {
        $this->endpoint = $endpoint;

        return $this;
    }
}