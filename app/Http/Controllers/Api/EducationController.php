<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Education::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'institution' => 'required|string',
            'degree'      => 'required|string',
            'field'       => 'required|string',
            'start_year'  => 'required|string',
            'end_year'    => 'nullable|string',
            'location'    => 'nullable|string',
            'gpa'         => 'nullable|string',
            'logo'        => 'nullable|string',
            'sort_order'  => 'integer',
        ]);

        $education = Education::create($data);

        return response()->json(['data' => $education], 201);
    }

    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);
        $education->update($request->all());

        return response()->json(['data' => $education]);
    }

    public function destroy($id)
    {
        Education::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted.']);
    }
}