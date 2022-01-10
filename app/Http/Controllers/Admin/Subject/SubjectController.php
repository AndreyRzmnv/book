<?php

namespace App\Http\Controllers\Admin\Subject;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\SubjectUpdateRequest;
use App\Models\Subjects\Subject;
use App\Policies\SubjectPolicy;
use App\Services\Admin\Subject\SubjectService;
use Illuminate\Http\Request;

class SubjectController extends AdminBaseController
{
    
    public function __construct(SubjectService $service)
    {
        $this->authorizeResource(SubjectPolicy::class);
        $this->service = $service;
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
     * @param  \App\Models\Subjects\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subjects\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subjects\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectUpdateRequest $request, Subject $subject)
    {
        $this->service->model = $subject;
        $this->service->baseUpdate($subject, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
