<?php

namespace App\Http\Controllers\Admin\Subcategory;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Requests\Subcategory\SubcategoryStoreRequest;
use App\Http\Requests\Subcategory\SubcategoryUpdateRequest;
use App\Models\Subcategory\Subcategory;
use App\Policies\SubcategoryPolicy;
use App\Services\Admin\Subcategory\SubcategoryService;

class SubcategoryController extends AdminBaseController
{
    public function __construct(SubcategoryService $service)
    {
        $this->authorizeResource(SubcategoryPolicy::class);
        parent::__construct($service);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryStoreRequest $request)
    {
        return $this->baseStore($request->validated());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategories\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryUpdateRequest $request, Subcategory $subcategory)
    {
        return $this->baseUpdate($request->validated(), $subcategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategories\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        return $this->baseDestroy($subcategory);
    }
}
