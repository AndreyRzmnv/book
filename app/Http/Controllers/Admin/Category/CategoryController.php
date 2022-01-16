<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category\Category;
use App\Services\Admin\Category\CategoryService;

class CategoryController extends AdminBaseController
{
    public function __construct(CategoryService $service)
    {
        $this->authorizeResource(CategoryPolicy::class);
        parent::__construct($service);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        return $this->baseStore($request->validated());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        return $this->baseUpdate($request->validated(), $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        return $this->baseDestroy($category);
    }
}
