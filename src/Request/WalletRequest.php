<?php
namespace Ctk\Request\Request;

class WalletRequest extends Request
{
    protected $data;

    public function setData($data = []) {
        $this->data = $data;

        return $this;
    }

    public function list() {
        $this->setMethod('GET');
        $this->setEndpoint('wallet');

        return $this->call();
    }

    public function address($symbol) {
        $this->setMethod('GET');
        $this->setEndpoint('wallet/address/' . $symbol);

        return $this->call();
    }

    public function update($symbol) {
        $this->setMethod('PUT');
        $this->setEndpoint('wallet/' . $symbol);

        return $this->call();
    }
}