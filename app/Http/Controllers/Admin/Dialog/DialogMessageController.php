<?php

namespace App\Http\Controllers;

use App\Models\Dialog\DialogMessage;
use App\Services\Admin\Dialog\DialogMessageService;
use Illuminate\Http\Request;

class DialogMessageController extends Controller
{
    public function __construct(DialogMessageService $service)
    {
        // $this->authorizeResource(CategoryPolicy::class);
        parent::__construct($service);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dialog\DialogMessage  $dialogMessage
     * @return \Illuminate\Http\Response
     */
    public function show(DialogMessage $dialogMessage)
    {
        return $this->service->show($dialogMessage);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dialog\DialogMessage  $dialogMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(DialogMessage $dialogMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dialog\DialogMessage  $dialogMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DialogMessage $dialogMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dialog\DialogMessage  $dialogMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(DialogMessage $dialogMessage)
    {
        //
    }
}
