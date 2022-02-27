<?php
namespace App\Services\Admin\Dialog;

use App\Http\Resources\Dialog\MessagesResource;
use App\Models\Dialog\Dialog;
use App\Models\Dialog\DialogMessage;
use App\Services\Admin\AdminBaseService;

class DialogService extends AdminBaseService
{
    public $permission = 'dialogs';
    
    public function __construct()
    {
        parent::__construct(Dialog::query());
    }

    public function show($dialog)
    {
        return MessagesResource::collection($dialog->messages()->latest()->paginate(10)->load('user'));
    }

    
}