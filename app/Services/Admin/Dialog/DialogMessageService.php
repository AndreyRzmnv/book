<?php
namespace App\Services\Admin\Dialog;

use App\Http\Resources\Dialog\MessagesResource;
use App\Models\Dialog\Dialog;
use App\Models\Dialog\DialogMessage;
use App\Services\Admin\AdminBaseService;

class DialogMessageService extends AdminBaseService
{
    public $permission = 'dialog_messages';
    
    public function __construct()
    {
        parent::__construct(DialogMessage::query());
    }

    public function show($dialogMessage)
    {
        dd();
        return MessagesResource::collection($dialogMessage->messages->load('user'));
    }
}