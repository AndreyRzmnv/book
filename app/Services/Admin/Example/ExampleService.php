<?php
namespace App\Services\Admin\Example;

use App\Models\Example\Example;
use App\Services\Admin\AdminBaseService;
use Yajra\DataTables\Facades\DataTables;

class ExampleService extends AdminBaseService
{
    public $permission = 'examples';
    
    public function __construct()
    {
        parent::__construct(Example::query());
    }

    /**
     * Модель для DT
     */
    protected function getModelForDataTable()
    {
        return $this->model
            ->select(
                'examples.id',
                'examples.name',
                'examples.subcategory_id',
            )->with(['subcategory.category.subject:id,name']);
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
        return [ 
            'id', 
            'name', 
            'subcategory.id', 
            'subcategory.name', 
            'subcategory.category.id', 
            'subcategory.category.name', 
            'subcategory.category.subject.id', 
            'subcategory.category.subject.name', 
            'actions' 
        ];
    }

    public function store($request)
    {
        dd($request);
    }
}