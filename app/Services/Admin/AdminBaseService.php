<?php
namespace App\Services\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminBaseService
{
    public $model;

    /**
     * Service constructor.
     * @param Builder $model
     */
    public function __construct(Builder $model)
    {
        $this->model = $model;
    }

    /**
     * Возвращает список всех колонок для DataTable
     */
    protected function tableColumns()
    {
        return [ 'id', 'name', 'actions' ];
    }

    /**
     * Сформируем колонку "Действие" для DataTable
     */
    protected function actionColumnDT()
    {
        return function ($element){
            $actions = [];
            if(auth()->user()->can('update-' . $this->permission))
                $actions[] = 'update';
            if(auth()->user()->can('delete-' . $this->permission))
                $actions[] = 'delete';

            return $actions;
        };
    }

    /**
     * Собираем запрос и формируем коллекцию DT
     */
    protected function constructDataTableQuery()
    {
        return DataTables::of($this->model)
            ->only($this->tableColumns())
            ->addColumn('actions', $this->actionColumnDT())
            ->filter(function (Builder $query) {
                $this->applyFilters($query, request());
            }, true);
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
    }

    protected function applyFilters(Builder $query, Request $request)
    {
        
    }

    /**
     * Формирует данные для шаблона "Список элементов"
     */
    public function dataTable()
    {
        return $this->constructDataTableQuery()->toJson();
    }

    /**
     * Формирует данные для шаблона "Список элементов"
     */
    // public function outputData()
    // {
    //     return [];
    // }

    /**
     * Данные для создания элемента
     */
    // public function createData()
    // {
    //     return [];
    // }

    /**
     * Данные для редактирования элемента
     */
    // public function editData()
    // {
    //     $data = $this->createData();

    //     $data += [
    //         'element' => $this->model
    //     ];

    //     return $data;
    // }

    /**
     * Создание записи в БД
     */
    public function store($request)
    {
        return $this->model->create($request);
    }

    /**
     * Обновление записи в БД
     */
    public function update($request)
    {
        return $this->model->update($request);
    }

    /**
     * Удаление элемента модели
     */
    public function destroy()
    {
        return $this->model->delete();
    }

    public function search($request)
    {
        $keywords = prepare_keyword($request['q'] ?? '');
        return $this->model
            ->select(['id', 'name'])
            ->when(count($keywords), function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->where(function ($query) use ($keyword) {
                        $query->where('name', 'like', "%$keyword%");
                    });
                }
            })
            ->orderBy('name')
            ->paginate(15);
    }


}