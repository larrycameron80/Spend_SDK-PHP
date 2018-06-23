<?php
namespace Ctk;

use Ctk\Request\Request\CardRequest;
use Ctk\Request\Request\ExchangeRequest;
use Ctk\Request\Request\SymbolRequest;
use Ctk\Request\Request\TransactionRequest;
use Ctk\Request\Request\UserRequest;
use Ctk\Request\Request\WalletRequest;

class CtkClient
{
    protected $url = '';
    protected $srvApiToken = '';
    protected $accessToken = '';

    public function __construct($url, $srvApiToken = '')
    {
        $this->url = sprintf('https://%s', $url);
        $this->srvApiToken = $srvApiToken;
    }

    public function setAccessToken($accessToken) {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function wallet() {
        return new WalletRequest($this->url, $this->accessToken, $this->srvApiToken);
    }

    public function user() {
        return new UserRequest($this->url, $this->accessToken, $this->srvApiToken);
    }

    public function symbol() {
        return new SymbolRequest($this->url, $this->accessToken, $this->srvApiToken);
    }

    public function exchange() {
        return new ExchangeRequest($this->url, $this->accessToken, $this->srvApiToken);
    }

    public function card() {
        return new CardRequest($this->url, $this->accessToken, $this->srvApiToken);
    }

    public function transaction() {
        return new TransactionRequest($this->url, $this->accessToken, $this->srvApiToken);
    }
}