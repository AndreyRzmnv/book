<?php
namespace App\Services\Admin\Subject;

use App\Http\Resources\Subject\SubjectResource;
use App\Models\Subjects\Subject;
use App\Services\Admin\BaseService;
// use Yajra\DataTables\Facades\DataTables;
use DataTables;
class SubjectService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Subject::query());
    }
    protected function getModelForDataTable()
    {
        return $this->model
            ->select(
                'subjects.*'
            );
    }

    protected function constructDataTableQuery()
    {
        return DataTables::of($this->getModelForDataTable())
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

    /**
     * Формирует данные для шаблона "Список элементов"
     */
    public function dataTable()
    {
        return $this->constructDataTableQuery()->toJson();
    }

}