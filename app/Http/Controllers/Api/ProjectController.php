<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['type', 'technologies'])->get();
        return response()->json($projects);
    }
    public function search($title)
    {
        $projects = Project::with(['type', 'technologies'])->where('title', 'like', '%' . $title . '%')->get();
        return response()->json($projects);
    }
    public function indexTechno()
    {
        $technologies = Technology::all();
        return response()->json($technologies);
    }
    public function indexType()
    {
        $types = Type::all();
        return response()->json($types);
    }
}
