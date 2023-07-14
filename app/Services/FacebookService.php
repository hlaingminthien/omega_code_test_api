<?php

namespace App\Services;

use Facebook\Facebook;

class FacebookService
{
    protected $facebook;

    public function __construct(Facebook $facebook)
    {
        $this->facebook = $facebook;
    }

    public function getPosts()
    {
        try {
            // Make a Graph API request to retrieve the user's posts
            $response = $this->facebook->get('/me/posts', $this->getAccessToken());
    
            // Get the decoded response data
            $data = $response->getDecodedBody();
    
            // Extract and return the posts from the response data
            return $data['data'];
        } catch (FacebookResponseException $e) {
            // Handle Facebook API errors
            return [];
        } catch (FacebookSDKException $e) {
            // Handle SDK errors
            return [];
        }
    }
    
    public function createPost($message)
    {
        try {
            // Make a Graph API request to create a new post
            $response = $this->facebook->post('/me/feed', [
                'message' => $message
            ], $this->getAccessToken());
    
            // Get the decoded response data
            $data = $response->getDecodedBody();
    
            // Return the ID of the created post
            return $data['id'];
        } catch (FacebookResponseException $e) {
            // Handle Facebook API errors
            return null;
        } catch (FacebookSDKException $e) {
            // Handle SDK errors
            return null;
        }
    }
    
    private function getAccessToken()
    {
        // Retrieve the access token for the authenticated user
        // You can implement your own logic to get the access token from the user
        // For example, you can use Laravel's authentication system or a stored access token
    
        // Return the access token
        return 'YOUR_ACCESS_TOKEN';
    }
}
