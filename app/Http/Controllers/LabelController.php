<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Label;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'create', 'edit', 'update', 'destroy']);
    }

    public function index(): View
    {
        $labels = Label::latest()->paginate(10);

        return view('labels.index', compact('labels'));
    }

    public function create(): View
    {
        $this->authorize(Label::class);

        $label = new Label();

        return view('labels.create', compact('label'));
    }

    public function store(LabelRequest $request): RedirectResponse
    {
        $this->authorize(Label::class);

        $label = Label::create($request->all());

        flash(__('label_created', ['label' => $label->name]))->success()->important();

        return redirect()->route('labels.index');
    }

    public function edit(Label $label): View
    {
        $this->authorize($label);

        return view('labels.edit', compact('label'));
    }

    public function update(LabelRequest $request, Label $label): RedirectResponse
    {
        $this->authorize($label);

        $label->update($request->all());

        flash(__('label_updated', ['label' => $label->name]))->success()->important();

        return redirect()->route('labels.index', $label);
    }

    public function destroy(Label $label): RedirectResponse
    {
        $this->authorize($label);

        $label->delete();

        flash(__('label_deleted', ['label' => $label->name]))->success()->important();

        return redirect()->route('labels.index');
    }
}
