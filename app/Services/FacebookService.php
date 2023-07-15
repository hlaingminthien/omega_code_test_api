<?php

namespace App\Services;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class FacebookService
{
    protected $facebook;

    public function __construct(Facebook $facebook)
    {
        $this->facebook = $facebook;
    }
    
    public function getFeed()
    {
        try {
            $accessToken = 'EAAVGKp0g3Y0BAN9PAHsRvT3z113VA4ebHr1XuUuyadkuxhYUOkoPKcac0klKkGqr3R6QWFNUZCWqOtvxVFhPP6qgWYiBVyOlbcZAlfxoVdLjZCVuozUifqBn5eZAuuGgtqrtMcpCcUXo7CJxaXBlhYjT6WgYN9zrX5wxGZAY6J1ZAeaOazpxSuGYdpTRAtLY7ph9BthmcMBYM4wpoKsQo4QLpGBMGq5HEZD';
    
            $client = new Client();
            $response = $client->get('https://graph.facebook.com/v14.0/me/posts', [
                'query' => [
                    'access_token' => $accessToken,
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
    
            return $data;
        } catch (GuzzleException $e) {
            // Handle HTTP client errors
            return ['error' => $e->getMessage()];
        }
    }

    public function uploadFeed($message)
    {
        try {
            $accessToken = 'EAAVGKp0g3Y0BAN9PAHsRvT3z113VA4ebHr1XuUuyadkuxhYUOkoPKcac0klKkGqr3R6QWFNUZCWqOtvxVFhPP6qgWYiBVyOlbcZAlfxoVdLjZCVuozUifqBn5eZAuuGgtqrtMcpCcUXo7CJxaXBlhYjT6WgYN9zrX5wxGZAY6J1ZAeaOazpxSuGYdpTRAtLY7ph9BthmcMBYM4wpoKsQo4QLpGBMGq5HEZD';
            $client = new Client();
            $response = $client->post(
                'https://graph.facebook.com/v14.0/me/posts',
                [
                    'query' => [
                        'access_token' => $accessToken,
                    ],
                    'form_params' => [
                        'message' => $message,
                    ],
                ]
            );
    
            $responseData = json_decode($response->getBody(), true);
    
            return $responseData['id'];
        } catch (\Exception $e) {
            // Handle errors
            return ['error' => $e->getMessage()];
        }
    }    
}

