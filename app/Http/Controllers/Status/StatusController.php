<?php

namespace App\Http\Controllers\Status;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::get();
        return $statuses;
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => ['required'],
        ]);

        if ($request) {
            auth()->user()->statuses()->create([
                'identifier' => Str::random(32),
                'body' => $request->body
            ]);
            return response()->json("Status created successfully!");
        } else {
            return response()->json("Failed to upload status!");
        }
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
