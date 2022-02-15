<?php

namespace App\Http\Controllers\Admin\Dialog;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Dialog\Dialog;
use App\Services\Admin\Dialog\DialogService;
use Illuminate\Http\Request;

class DialogController extends AdminBaseController
{
    public function __construct(DialogService $service)
    {
        // $this->authorizeResource(CategoryPolicy::class);
        parent::__construct($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dialog\Dialog  $dialog
     * @return \Illuminate\Http\Response
     */
    public function show(Dialog $dialog)
    {
        return $this->service->show($dialog);
    }
}
