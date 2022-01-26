<?php

namespace App\Http\Controllers\Admin\Example;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Requests\Example\ExampleStoreRequest;
use App\Http\Requests\Example\ExampleUpdateRequest;
use App\Models\Example\Example;
use App\Policies\ExamplePolicy;
use App\Services\Admin\Example\ExampleService;
use Illuminate\Http\Request;

class ExampleController extends AdminBaseController
{
    public function __construct(ExampleService $service)
    {
        $this->authorizeResource(ExamplePolicy::class);
        parent::__construct($service);
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
    public function store(ExampleStoreRequest $request)
    {
        return $this->baseStore($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function show(Example $example)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function edit(Example $example)
    {
        return $this->baseEdit($example);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function update(ExampleUpdateRequest $request, Example $example)
    {
        return $this->baseUpdate($request->validated(), $example);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function destroy(Example $example)
    {
        return $this->baseDestroy($example);
    }
}
