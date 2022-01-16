<?php
namespace App\Services\Admin\Category;

use App\Models\Category\Category;
use App\Services\Admin\AdminBaseService;
use Yajra\DataTables\Facades\DataTables;

class CategoryService extends AdminBaseService
{
    public $permission = 'categories';
    
    public function __construct()
    {
        parent::__construct(Category::query());
    }

    /**
     * Модель для DT
     */
    protected function getModelForDataTable()
    {
        return $this->model
            ->select(
                'categories.id',
                'categories.name',
                'categories.subject_id',
            )->with(['subject:id,name']);
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
        return [ 'id', 'name', 'subject.id', 'subject.name', 'actions' ];
    }
}