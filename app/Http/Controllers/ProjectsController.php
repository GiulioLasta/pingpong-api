<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;

class ProjectsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
    
    /**
     * save project info test_01
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'description' => 'required'
        ]);
        // $user = auth()->user();
        $project = Projects::firstOrCreate([
            'description' => request('description'),
            'active' => 1
        ]);

        return response()->json($project);
    }

    public function list(Request $request)
    {
        $projects = Projects::where('active', '=', '1')
        ->get(['id', 'description'])
        ->all();
        //nope->select('description', 'id', 'id_project', 'note')->get();
        // ->flatten('description', 'id', 'id_project', 'note');
        // return View::make('users.addbooking', array('ticket' => $tickets));
        return response()->json($projects);
    }
    
    /**
     * update the user info
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $project = Projects::find($request->get('id'));
        $project->description = $request->get('description');
        $project->save();

        return response('update');
    }

}
