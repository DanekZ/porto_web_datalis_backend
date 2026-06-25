<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::orderBy('sort_order')->orderBy('created_at', 'desc');

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('featured') && $request->featured === 'true') {
            $query->where('featured', true)->limit(3);
        }

        $projects = $query->get()->map(fn($p) => $this->format($p));

        return response()->json([
            'data'  => $projects,
            'total' => $projects->count(),
            'counts' => [
                'all'  => Project::count(),
                'web'  => Project::where('category', 'web')->count(),
                'data' => Project::where('category', 'data')->count(),
            ],
        ]);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return response()->json(['data' => $this->format($project)]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string',
            'description' => 'required|string',
            'thumbnail'   => 'nullable|string',
            'images'      => 'nullable|array|max:5',
            'tech_stack'  => 'required|array',
            'category'    => 'required|in:web,data',
            'github_url'  => 'nullable|string',
            'demo_url'    => 'nullable|string',
            'status'      => 'in:completed,in-progress,archived',
            'featured'    => 'boolean',
            'sort_order'  => 'integer',
        ]);

        $project = Project::create($data);
        return response()->json(['data' => $this->format($project)], 201);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return response()->json(['data' => $this->format($project)]);
    }

    public function destroy($id)
    {
        Project::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted.']);
    }

    private function format(Project $p): array
    {
        return [
            'id'          => $p->id,
            'title'       => $p->title,
            'description' => $p->description,
            'thumbnail'   => $p->thumbnail,
            'images'      => $p->images ?? [],
            'tech_stack'  => $p->tech_stack ?? [],
            'category'    => $p->category,
            'github_url'  => $p->github_url,
            'demo_url'    => $p->demo_url,
            'status'      => $p->status,
            'featured'    => $p->featured,
            'sort_order'  => $p->sort_order,
            'created_at'  => $p->created_at,
        ];
    }
}