<?php

namespace App\Http\Services;

use App\Http\Interfaces\ITestService;

class TestService implements ITestService
{
    public function setCookie()
    {
    }

    public function getCookie()
    {
    }

    public function test()
    {
        return "Test Successfull";
    }
}
