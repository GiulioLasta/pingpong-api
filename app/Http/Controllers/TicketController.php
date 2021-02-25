<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
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
     * save ticket info test_01
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $user = auth()->user();
        $ticket = Ticket::firstOrCreate([
            'id_project' => request('id_project'),
            'id_priority' => request('id_priority'),
            'percentage' => 0,
            'id_user' => $user->id,
            'expiration_date' => date("Y/m/d"),
            'description' => request('description'),
            'note' => request('note'),
            'test' => 1
        ]);

        return response()->json($ticket);
    }

    
    /**
     * update ticket info test_01
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $ticket = Ticket::find(request('id'));
        $ticket -> id_project = request('id_project');
        // $ticket -> id_priority = request('id_priority');
        $ticket -> description = request('description');
        $ticket -> percentage = request('percentage');
        $ticket -> note = request('note');
        $ticket->save();

        return response()->json($ticket);
    }


    /**
     * save ticket info test_01
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $tickets = Ticket::orderBy('id', 'DESC')
            ->get(['id', 'description', 'id_project', 'percentage', 'note', 'test'])
            ->all();
            //nope->select('description', 'id', 'id_project', 'note')->get();
            // ->flatten('description', 'id', 'id_project', 'note');
        // return View::make('users.addbooking', array('ticket' => $tickets));
        return response()->json($tickets);
    }

    /**
     * delete ticket info test_01
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        $res = Ticket::where('id', request('id'))->delete();
        //nope->select('description', 'id', 'id_project', 'note')->get();
        // ->flatten('description', 'id', 'id_project', 'note');
        // return View::make('users.addbooking', array('ticket' => $tickets));
        return response()->json($res);
    }

    /**
     * delete ticket info test_01
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteList(Request $request)
    {
        $explode_id = array_map('intval', explode(',', $request->id));
        if($explode_id->ob_get_length()>0)
            $res = Ticket::wherein('id', $explode_id)->delete();
        return response()->json($res);
    }

}
