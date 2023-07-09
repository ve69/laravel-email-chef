<?php

namespace OfflineAgency\LaravelEmailChef;

use Illuminate\Support\Facades\Http;

class LaravelEmailChef
{
    private $username;
    private $password;
    protected $login_url;
    protected $baseUrl;
    private $authkey;
    protected $header;

    public function __construct()
    {
        $this->setUsername();

        $this->setPassword();

        $this->setLoginUrl();

        $this->setBaseUrl();

        $this->setAuthkey();

        $this->setHeader();
    }

    public function login()
    {
        $url = $this->getLoginUrl() . 'login';

        $result = Http::withHeaders([
            'Accept' => 'application/json; charset=utf-8',
        ])->post($url, [
            'username' => $this->getUsername(),
            'password' => $this->getPassword()
        ]);

        //TODO: check result status and handle errors

        $result = json_decode($result->body());

        return $result->authkey;
    }

    private function setHeader()
    {
        $this->header = Http::withHeaders([
            'Accept' => 'application/json; charset=utf-8',
            'authkey' => $this->getAuthkey(),
        ]);
    }

    private function getPassword()
    {
        return $this->password;
    }

    private function setPassword(): void
    {
        $this->password = config('email-chef.password');
    }

    private function getUsername()
    {
        return $this->username;
    }

    private function setUsername(): void
    {
        $this->username = config('email-chef.username');
    }

    private function getAuthkey()
    {
        return $this->authkey;
    }

    private function setAuthkey(): void
    {
        $authkey = $this->login();

        $this->authkey = $authkey;
    }

    private function setBaseUrl(): void
    {
        $this->baseUrl = config('email-chef.baseUrl');
    }

    private function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function getLoginUrl()
    {
        return $this->login_url;
    }

    public function setLoginUrl(): void
    {
        $this->login_url = config('email-chef.login_url');
    }
}
