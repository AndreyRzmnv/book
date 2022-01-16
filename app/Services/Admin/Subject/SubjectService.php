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
                'color',
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
            // ->filterColumn('city', function ($query, $keyword) {
            //     $query->whereHas('city', function ($query) use ($keyword) {
            //         $query
            //             ->where('title', 'LIKE',  "%" . $keyword . "%")
            //             ;
            //     });
            // })
            // ->filter(function (Builder $query) {
            //     $this->applyFilters($query, request());
            // }, true);

            
            
            // ->addColumn('actions', function (Message $message) {
            //     return [
            //         'update' => true,
            //         'delete' => true,
            //     ];
            // })
        ;
    }
    /**
     * Возвращает список всех колонок для DataTable
     */
    protected function tableColumns()
    {
        return [ 'id', 'name', 'color', 'actions' ];
    }
}