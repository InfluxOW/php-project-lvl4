<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelValidation;
use App\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
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
        $labels = Label::latest()->paginate(5);

        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(Label::class);

        $label = new Label();

        return view('labels.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LabelValidation $request)
    {
        $this->authorize(Label::class);

        $validatedData = $request->validated();
        $label = Label::create($validatedData);

        flash("Label \"$label->name\" was created successfully!")->success()->important();

        return redirect()->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        $this->authorize($label);

        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(LabelValidation $request, Label $label)
    {
        $this->authorize($label);

        $validatedData = $request->validated();
        $label->fill($validatedData);

        if ($label->isDirty()) {
            $label->save();
            flash("Label \"$label->name\" was updated successfully!")->success()->important();
        }

        return redirect()->route('labels.index', $label);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        $this->authorize($label);

        $label->delete();

        flash("Label \"$label->name\" was deleted successfully!")->success()->important();

        return redirect()->route('labels.index');
    }
}
