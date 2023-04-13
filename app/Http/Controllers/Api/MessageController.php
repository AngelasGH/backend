<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $message = Message::all();
    }


    public function store(MessageRequest $request)
    {
        $validated = $request->validated();
        $message = Message::create($validated);

        return $message;
    }


    public function update(MessageRequest $request, string $id)
    {
        $validated = $request->validated();
        $message = Message::findOrFail($id);
        $message->update($validated);

        return $message;
    }
}