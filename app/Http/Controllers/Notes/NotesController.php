<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notes\NoteStoreRequest;
use App\Models\Tenant\Notes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('tenant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteStoreRequest $request)
    {
        if ($valid = $request->validated()) {
            try {
                $note                 = new Notes();
                $note->entity_type_id = $valid['entity_type_id'];
                $note->entity_id      = $valid['entity_id'];
                $note->note           = $valid['note'];
                $note->user_id        = Auth::user()->id;
                $note->created_at     = Carbon::now();
                $note->save();
            }
            catch(\Exception $e) {
                Log::debug(__METHOD__. ' Error - ' . $e->getMessage());
            }
        }
        else {
            Log::debug(__METHOD__. ' - Note entry failed validation with the following errors', (array) $valid->errors());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function show(Notes $notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function edit(Notes $notes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notes $notes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notes $notes)
    {
        //
    }
}
