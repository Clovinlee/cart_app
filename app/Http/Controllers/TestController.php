<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ITestService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private $testService;

    public function __construct()
    {
        // $this->testService = $testService;

        $this->testService = app(ITestService::class);
        $this->testService = $this->testService['test1'];
    }

    public function sum($a, $b)
    {
        return $a + $b;
    }

    //
    public function index(Request $request)
    {
        $sum = $this->sum(1, 2);
        return response()->json($this->testService->test() . "\n" . $sum, 200);
    }

    public function getCookie(Request $request)
    {
        return response()->json($request->cookie(), 200);
    }

    public function setCookie(Request $request)
    {
        // 'name', 'value', $minutes, $path, $domain, $secure, $httpOnly
        $response = response()->json(['message' => 'Cookie has been set'], 200);

        $response->cookie('testId', 'testingID doang', 60, false, false, true, false);
        $response->cookie('sensitiveCookie', 'clovinlee', 60, null, null, true, true);

        return $response;
    }
}
