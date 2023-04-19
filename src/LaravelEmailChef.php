<?php

namespace OfflineAgency\LaravelEmailChef;

use Illuminate\Support\Facades\Http;

class LaravelEmailChef
{
    private $username;
    private $password;
    private $authkey;
    protected $baseUrl;
    protected $header;

    public function __construct()
    {
        $this->setUsername();

        $this->setPassword();

        $this->setAuthkey();

        $this->setBaseUrl();

        $this->setHeader();
    }

    public function login()
    {
        $url = $this->getBaseUrl() . 'login';

        $result = Http::withHeaders([
            'Accept' => 'application/json; charset=utf-8',
        ])->post($url, [
            'username' => $this->getUsername(),
            'password' => $this->getPassword()
        ]);
        dd($result->body());
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
        $this->authkey = 'e03061855eed6248119619f5b4bc279ece6443ca';
    }

    private function setBaseUrl(): void
    {
        $this->baseUrl = config('email-chef.baseUrl');
    }

    private function getBaseUrl()
    {
        return $this->baseUrl;
    }
}
