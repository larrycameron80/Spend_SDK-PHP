<?php
namespace Ctk\Request\Request;

class UserRequest extends Request
{
    protected $data;

    public function setData($data = []) {
        $this->data = $data;
    }

    public function get() {
        $this->setMethod('GET');
        $this->setEndpoint('user');

        return $this->call();
    }

    public function login($username, $password) {
        $this->setMethod('POST');
        $this->setEndpoint('user/login');

        $this->setData([
            'username' => $username,
            'password' => $password
        ]);

        $call = $this->call();

        return $call;
    }

    public function loginCode($session, $code, $username) {
        $this->setMethod('POST');
        $this->setEndpoint('user/login/code');

        $this->setData([
            'username' => $username,
            'code' => $code,
            'session' => $session,
        ]);

        return $this->call();
    }

    public function password($username) {
        $this->setMethod('POST');
        $this->setEndpoint('user/password');

        $this->setData([
            'username' => $username,
        ]);

        return $this->call();
    }

    public function passwordConfirm($username, $code, $password) {
        $this->setMethod('POST');
        $this->setEndpoint('user/password/confirm');

        $this->setData([
            'username' => $username,
            'code' => $code,
            'password' => $password,
        ]);

        return $this->call();
    }

    public function update($data = []) {
        $this->setMethod('PUT');
        $this->setEndpoint('user/update');

        if ($data) {
            $this->setData($data);
        }

        return $this->call();
    }

    public function signup($data = []) {
        $this->setMethod('POST');
        $this->setEndpoint('user/signup');

        if ($data) {
            $this->setData($data);
        }

        return $this->call();
    }

    public function signupVerify($username, $code) {
        $this->setMethod('POST');
        $this->setEndpoint('user/signup/verify');

        $this->setData([
            'username' => $username,
            'code' => $code
        ]);

        return $this->call();
    }

    public function signupConfirmationResend($username) {
        $this->setMethod('POST');
        $this->setEndpoint('user/signup/verify');

        $this->setData([
            'username' => $username,
        ]);

        return $this->call();
    }

    public function signupConfirm($data = []) {
        $this->setMethod('POST');
        $this->setEndpoint('user/signup/confirm');

        if ($data) {
            $this->setData($data);
        }

        return $this->call();
    }
}