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

    public function showProjectForApi($slug)
    {
        $project = Project::with('technologies')->where('slug', $slug)->firstOrFail();
        return response()->json($project);
    }

    public function filter($technologies = null, $types = null)
    {
        // Inizia una query sui progetti
        $query = Project::query();

        // Controlla se le tecnologie non sono impostate a 'none'
        if ($technologies !== 'none' && $technologies) {
            $techArray = explode(',', $technologies); // Divide le tecnologie in array
            $query->whereHas('technologies', function ($q) use ($techArray) {
                $q->whereIn('id', $techArray);
            });
        }

        // Controlla se il tipo non è impostato a 'none'
        if ($types !== 'none' && $types) {
            $query->where('type_id', $types);
        }

        // Recupera i progetti con le loro tecnologie e tipo associati
        $projects = $query->with(['technologies', 'type'])->get();

        // Restituisci i dati filtrati
        return response()->json([
            'projects' => $projects, // Progetti filtrati con le relazioni
        ]);
    }
}
