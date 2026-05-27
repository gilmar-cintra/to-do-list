<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskModelRequest;
use App\Http\Requests\UpdateTaskModelRequest;
use App\Models\TaskModel;

class TaskModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskModelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskModel $taskModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskModel $taskModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskModelRequest $request, TaskModel $taskModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskModel $taskModel)
    {
        //
    }
}
