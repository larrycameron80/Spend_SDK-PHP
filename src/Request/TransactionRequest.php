<?php

namespace Ctk\Request\Request;


class TransactionRequest extends Request
{
    protected $data;

    public function setData($data = []) {
        $this->data = $data;
    }

    public function get($page = 1, $limit = 100, $symbol = '') {
        $this->setMethod('GET');
        $this->setEndpoint('transaction');

        $this->setData([
            'page' => $page,
            'limit' => $limit,
            'symbol' => $symbol,
        ]);

        return $this->call();
    }

    public function getBySymbol($page = 1, $limit = 100, $symbol = '') {
        $this->setMethod('GET');
        $this->setEndpoint('transactionBySymbol');

        $this->setData([
            'page' => $page,
            'limit' => $limit,
            'symbol' => $symbol,
        ]);

        return $this->call();
    }

    public function total($period = 'monthly', $type= '') {
        $this->setMethod('GET');
        $this->setEndpoint('transaction/total');

        $this->setData([
            'period' => $period,
            'type' => $type,
        ]);

        return $this->call();
    }
}