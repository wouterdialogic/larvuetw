<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Todo::latest()->get(), 200);
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'text' => 'required',
            'finished' => 'required|boolean',
        ]);

        $todo = Todo::create($data);

        return response($todo, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        try {
            $result = [];
            $result["id"] = $todo->id;
            $result["function"] = "edit";

            $todo->finished = $request["todo"]["finished"];
            $todo->text = $request["todo"]["text"];
            $dbSave = $todo->save();
            
            if ( $dbSave == 1) {
                $result["status"] = "ok";
            } else {
                $result["status"] = "error";
                $result["message"] = "deleting ".$todo->id." not ok";
            }

            return response($result, 200);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        try {
            $result = [];
            $result["id"] = $todo->id;
            if ( $todo->delete() == 1) {
                $result["status"] = "deleted";
            } else {
                $result["status"] = "error";
                $result["message"] = "deleting ".$todo->id." not ok";
            }

            return $result;
        } catch (\Exception $e) {
            return $e;
        }

        // return );
        // echo "hi there";
            // echo "<pre>";
            // print_r($result);
            // print_r($todo->toArray());
            // echo "</pre>";

        // return "ok";
    }
}
