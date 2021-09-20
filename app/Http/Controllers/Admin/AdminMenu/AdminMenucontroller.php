<?php

namespace App\Http\Controllers\Admin\AdminMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(config('admin-menu'));
    }
}
