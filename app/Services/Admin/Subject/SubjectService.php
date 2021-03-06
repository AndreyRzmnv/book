<?php
namespace App\Services\Admin\Subject;

use App\Models\Subject\Subject;
use App\Services\Admin\AdminBaseService;
use Yajra\DataTables\Facades\DataTables;

class SubjectService extends AdminBaseService
{
    public $permission = 'subjects';
    
    public function __construct()
    {
        parent::__construct(Subject::query());
    }

    /**
     * Модель для DT
     */
    protected function getModelForDataTable()
    {
        return $this->model
            ->select(
                'id',
                'name',
                'color',
            );
    }

    /**
     * Собираем запрос и формируем коллекцию DT
     */
    protected function constructDataTableQuery()
    {
        return DataTables::of($this->getModelForDataTable())
            ->only($this->tableColumns())
            ->addColumn('actions', $this->actionColumnDT());
    }

    /**
     * Возвращает список всех колонок для DataTable
     */
    protected function tableColumns()
    {
        return [ 'id', 'name', 'color', 'actions' ];
    }
}