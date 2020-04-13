<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusValidation;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'create', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::latest()->paginate(10);

        return view('statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(Status::class);

        $status = new Status();


        return view('statuses.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusValidation $request)
    {
        $this->authorize(Status::class);

        $validatedData = $request->validated();
        $status = Status::create($validatedData);

        flash(__('Status was created successfully!'))->success()->important();

        return redirect()->route('statuses.index', $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        $this->authorize($status);

        return view('statuses.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(StatusValidation $request, Status $status)
    {
        $this->authorize($status);

        $validatedData = $request->validated();
        $status->update($validatedData);

        flash(__('Status was updated successfully!'))->success()->important();

        return redirect()->route('statuses.index', $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $this->authorize($status);

        $status->delete();

        flash(__('Status was deleted successfully!'))->success()->important();

        return redirect()->route('statuses.index');
    }
}
