<?php

namespace Ctk\Request\Request;


class CardRequest extends Request
{
    protected $data;

    public function setData($data = []) {
        $this->data = $data;

        return $this;
    }

    public function list() {
        $this->setMethod('GET');
        $this->setEndpoint('card');

        return $this->call();
    }

    public function pin($san) {
        $this->setMethod('POST');
        $this->setEndpoint('card/pin');

        $this->setData([
            'san' => $san
        ]);

        return $this->call();
    }

    public function issue($data = []) {
        $this->setMethod('POST');
        $this->setEndpoint('card/issue');

        if ($data) {
            $this->setData($data);
        }

        return $this->call();
    }

    public function info($san) {
        $this->setMethod('POST');
        $this->setEndpoint('card/info');

        $this->setData([
            'san' => $san
        ]);

        return $this->call();
    }

    public function activate($san) {
        $this->setMethod('POST');
        $this->setEndpoint('card/activate');

        $this->setData([
            'san' => $san
        ]);

        return $this->call();
    }
}