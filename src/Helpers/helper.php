<?php


if (!function_exists('triggerAsyncRequest')) {
    function triggerAsyncRequest($url, $params, $method = "GET", $headers = [])
    {
        $isPost = false;
        $channel = curl_init();
        if (strtolower($method) == "post") {
            $isPost = true;
        }
        if (strtolower($method) == "get") {
            $arrRequestParams = [];
            foreach ($params as $key => $item) {
                $arrRequestParams[] = "$key=$item";
            }
            $url = $url . '?' . join('&', $arrRequestParams);
        } else {
            $headers[] = 'Content-Type: application/json';
            curl_setopt($channel, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($channel, CURLOPT_URL, $url);
        curl_setopt($channel, CURLOPT_POST, $isPost);
        if (!empty($headers)) {
            curl_setopt($channel, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($channel, CURLOPT_NOSIGNAL, 1);
        curl_setopt($channel, CURLOPT_TIMEOUT_MS, 5000);
        curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($channel, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
        curl_exec($channel);
        curl_close($channel);
    }
}