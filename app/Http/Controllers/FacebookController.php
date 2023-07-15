<?php

namespace App\Http\Controllers;

use App\Services\FacebookService;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    protected $facebookService;

    public function __construct(FacebookService $facebookService)
    {
        $this->facebookService = $facebookService;
    }

    public function uploadFeed(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string',
        ]);

        $message = $request->message;
        $response = $this->facebookService->uploadFeed($message);

        return response()->json($response, 200);
    }

    public function getFeed()
    {
        $response = $this->facebookService->getFeed();

        return response()->json($response, 200);
    }
}
