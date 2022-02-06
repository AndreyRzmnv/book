<?php
namespace App\Services\Admin\Category;

use App\Http\Resources\Category\CategorySearchResource;
use App\Models\Category\Category;
use App\Services\Admin\AdminBaseService;
use Illuminate\Database\Eloquent\Builder;
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
            ->addColumn('actions', $this->actionColumnDT())
            ->filter(function (Builder $query) {
                $this->applyFilters($query, request()->all());
            }, true);

    }

    /**
     * Фильры для DT
     */
    protected function applyFilters(Builder $query, $request)
    {
        if( isset($request['subject']) && !empty($request['subject']) ){
            $query->where('subject_id', $request['subject']['id']);
        }
        
    }

    /**
     * Возвращает список всех колонок для DataTable
     */
    protected function tableColumns()
    {
        return [ 'id', 'name', 'subject.id', 'subject.name', 'actions' ];
    }

    /**
     * Поиск элементов для селекта
     */
    public function search($request)
    {
        $keywords = prepare_keyword($request['q'] ?? '');
        $query = $this->model
            ->select(['id', 'name', 'subject_id'])
            ->with(['subject:id,name'])
            ->when(count($keywords), function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->where(function ($query) use ($keyword) {
                        $query->where('name', 'like', "%$keyword%");
                    })
                    ->orWhere(function ($query) use ($keyword) {
                        $query->whereHas('subject', function ($query) use ($keyword){
                            $query->where('name', 'like', "%$keyword%");
                        });
                    })
                    ;
                }
            })
            ->orderBy('name')
            ->paginate(15);
        return CategorySearchResource::collection($query);
    }
}