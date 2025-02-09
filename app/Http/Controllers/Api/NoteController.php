<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function getNote(){
        $notes   = note::orderBy('id','desc')->get();
        return response()->json([
            'data'  => $notes
        ],200);
    }

    public function createNote(Request $request){
        $request->validate([
            'title' =>'required',
            'content'   =>'required'
        ]);

        $create = $request->user()->note()->create([
            'title' => $request->title,
            'content'   => $request->content
        ]);

        return response()->json([
            'message'   => 'Note Created',
            'data'      => $create
        ],201);
    }
}
