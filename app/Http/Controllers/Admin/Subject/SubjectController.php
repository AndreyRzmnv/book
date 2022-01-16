<?php

namespace App\Http\Controllers\Admin\Subject;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\SubjectStoreRequest;
use App\Http\Requests\Subject\SubjectUpdateRequest;
use App\Models\Subject\Subject;
use App\Policies\SubjectPolicy;
use App\Services\Admin\Subject\SubjectService;
use Illuminate\Http\Request;

class SubjectController extends AdminBaseController
{
    
    public function __construct(SubjectService $service)
    {
        $this->authorizeResource(SubjectPolicy::class);
        parent::__construct($service);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectStoreRequest $request)
    {
        return $this->baseStore($request->validated());
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
        return $this->baseUpdate($request->validated(), $subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        return $this->baseDestroy($subject);
    }
}
