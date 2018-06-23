<?php

namespace Ctk\Request\Request;


class SymbolRequest extends Request
{
    public function setData($data = []) {
        $this->data = $data;

        return $this;
    }

    public function list() {
        $this->setMethod('GET');
        $this->setEndpoint('symbol');

        return $this->call();
    }
}