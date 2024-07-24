<?php

if (!function_exists("makeJson")) {
    function makeJson(int $status, string $message, $data = null, array $header = [])
    {
        return response()->json(["messages" => $message, "data" => $data], $status, $header);
    }
}
