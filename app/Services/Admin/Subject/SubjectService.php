<?php
namespace App\Services\Admin\Subject;

use App\Http\Resources\Subject\SubjectResource;
use App\Models\Subjects\Subject;
use App\Services\Admin\AdminBaseService;
use Yajra\DataTables\Facades\DataTables;

class SubjectService extends AdminBaseService
{
    public $permission = 'subjects';
    
    public function __construct()
    {
        parent::__construct(Subject::query());
    }
    protected function getModelForDataTable()
    {
        return $this->model
            ->select(
                'id',
                'name',
            );
    }

    protected function constructDataTableQuery()
    {
        return DataTables::of($this->getModelForDataTable())
            ->only($this->tableColumns())
            ->addColumn('actions', $this->actionColumnDT())
        // ->setTransformer(function (Subject $subject) {
        //     return SubjectResource::make($subject)->resolve();
        // })

            
            // ->addColumn('actions', function (Message $message) {
            //     return [
            //         'update' => true,
            //         'delete' => true,
            //     ];
            // })
        ;
    }
}