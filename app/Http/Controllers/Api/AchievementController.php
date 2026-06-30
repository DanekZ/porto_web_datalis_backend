<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Achievement::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string',
            'issuer'           => 'required|string',
            'type'             => 'required|in:award,course,certification',
            'level'            => 'nullable|string',
            'image'            => 'nullable|string',
            'image_path'       => 'nullable|string',
            'credential_url'   => 'nullable|string',
            'credential_id'    => 'nullable|string',
            'issue_date'       => 'nullable|date',
            'expiration_date'  => 'nullable|date',
            'categories'       => 'nullable|array',
            'year'             => 'nullable|string',
            'sort_order'       => 'integer',
        ]);

        $achievement = Achievement::create($data);
        return response()->json(['data' => $achievement], 201);
    }

    public function update(Request $request, $id)
    {
        $achievement = Achievement::findOrFail($id);
        $achievement->update($request->all());
        return response()->json(['data' => $achievement]);
    }

    public function destroy($id)
    {
        Achievement::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted.']);
    }
}