<?php

namespace Ctk\Request\Request;


class ExchangeRequest extends Request
{
    protected $data;

    public function setData($data = []) {
        $this->data = $data;
    }

    public function estimates() {
        $this->setMethod('GET');
        $this->setEndpoint('exchange');

        return $this->call();
    }

    public function list() {
        $this->setMethod('GET');
        $this->setEndpoint('exchange/transactions');

        return $this->call();
    }

    public function list($id) {
        $this->setMethod('GET');
        $this->setEndpoint('exchange/' . $id);

        return $this->call();
    }

    public function estimate($from, $to, $amount) {
        $this->setMethod('POST');
        $this->setEndpoint('exchange');

        $this->setData([
            'from' => $from,
            'to' => $to,
            'amount' => $amount,
        ]);

        return $this->call();
    }

    public function minimum($from, $to) {
        $this->setMethod('POST');
        $this->setEndpoint('exchange/minimum');

        $this->setData([
            'from' => $from,
            'to' => $to,
        ]);

        return $this->call();
    }

    public function transaction($from, $to, $amount) {
        $this->setMethod('POST');
        $this->setEndpoint('exchange/transaction');

        $this->setData([
            'from' => $from,
            'to' => $to,
            'amount' => $amount,
        ]);

        return $this->call();
    }
}