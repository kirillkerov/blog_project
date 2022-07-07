<?php

namespace App\Controllers;

use App\Service\SubscribeService;
use App\Service\UserService;
use App\Exception\InvalidArgumentException;
use App\View\JsonResponse;

class UserController
{
    public function login(): JsonResponse
    {
        $response = ['result' => false, 'error' => ''];

        try {
            $response['result'] = UserService::login($_POST);
        } catch (InvalidArgumentException $e) {
            $response['error'] = $e->getMessage();
        }

        return new JsonResponse($response);
    }

    public function registration(): JsonResponse
    {
        $response = ['result' => false, 'error' => ''];

        try {
            $response['result'] = UserService::registration($_POST);
        } catch (InvalidArgumentException $e) {
            $response['error'] = $e->getMessage();
        }

        return new JsonResponse($response);
    }

    public function subscribe(): JsonResponse
    {
        $response = ['result' => false, 'error' => ''];

        try {
            $response['result'] = SubscribeService::subscribe();
        } catch (InvalidArgumentException $e) {
            $response['error'] = $e->getMessage();
        }

        return new JsonResponse($response);
    }
}
