<?php
namespace App\Services\Admin\Subcategory;

use App\Models\Subcategory\Subcategory;
use App\Services\Admin\AdminBaseService;
use Yajra\DataTables\Facades\DataTables;

class SubcategoryService extends AdminBaseService
{
    public $permission = 'subcategories';
    
    public function __construct()
    {
        parent::__construct(Subcategory::query());
    }

    /**
     * Модель для DT
     */
    protected function getModelForDataTable()
    {
        return $this->model
            ->select(
                'subcategories.id',
                'subcategories.name',
                'subcategories.category_id',
            )->with(['category:id,name']);
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
        return [ 'id', 'name', 'category.id', 'category.name', 'actions' ];
    }
}