<?php

namespace Megaads\RealEmail\Controllers;

class BaseContoller
{
    const STATUS_DEFAULT = 'fail';
    const STATUS_SUCCESS = 'successful';

    protected function getDefaultStatus($message = '')
    {
        $result = [
            'status' => self::STATUS_DEFAULT
        ];

        if (!empty($message)) {
            $result['message'] = $message;
        }

        return $result;
    }

    protected function getSuccessStatus($data = [], $message = '')
    {
        $result = [
            'status' => self::STATUS_SUCCESS,
            'data' => $data
        ];
        if (!empty($message)) {
            $result['message'] = $message;
        }

        return $result;
    }
}