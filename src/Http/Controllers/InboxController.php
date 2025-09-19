<?php

namespace Redberry\MailboxForLaravel\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Redberry\MailboxForLaravel\CaptureService;

class InboxController
{
    public function __invoke(Request $request, CaptureService $service): \Illuminate\Contracts\View\View
    {
        $messages = $service->all(); // adapt to your API

        $payload = [
            'messages' => array_values($messages['data'] ?? $messages), // support both shapes
        ];

        // Otherwise, render the Blade view and hydrate initial props
        return View::make('inbox::index', ['data' => $payload]);
    }
}
