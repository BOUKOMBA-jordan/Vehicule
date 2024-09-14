<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OptionFormRequest;
use App\Models\Option;

class OptionController extends Controller
{
    /**
     * Display a listing of the options.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.options.index', [
            'options' => Option::paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new option.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $option = new Option();
        return view('admin.options.form', [
            'option' => $option
        ]);
    }

    /**
     * Store a newly created option in storage.
     *
     * @param OptionFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OptionFormRequest $request)
    {
        $option = Option::create($request->validated());
        return to_route('admin.option.index')->with('success', 'L\'option a bien été créée');
    }

    /**
     * Show the form for editing the specified option.
     *
     * @param Option $option
     * @return \Illuminate\View\View
     */
    public function edit(Option $option)
    {
        return view('admin.options.form', [
            'option' => $option
        ]);
    }

    /**
     * Update the specified option in storage.
     *
     * @param OptionFormRequest $request
     * @param Option $option
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OptionFormRequest $request, Option $option)
    {
        $option->update($request->validated());
        return to_route('admin.option.index')->with('success', 'L\'option a bien été modifiée');
    }

    /**
     * Remove the specified option from storage.
     *
     * @param Option $option
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Option $option)
    {
        $option->delete();
        return to_route('admin.option.index')->with('success', 'L\'option a bien été supprimée');
    }
}