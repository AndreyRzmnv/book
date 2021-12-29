<?php
namespace App\Services\Admin;

// use DataTables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BaseService
{
    protected $model;

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
    public function tableColumns()
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
            $actions[] = 'update';
            $actions[] = 'delete';

            return $actions;
        };
    }

    /**
     * Собираем запрос и формируем коллекцию DT
     */
    protected function constructDataTableQuery()
    {
        // dd($this->model);
        return DataTables::of($this->model)
            ->only($this->tableColumns())
            ->addColumn('actions', $this->actionColumnDT())
            ->filter(function (Builder $query) {
                $this->applyFilters($query, request());
            }, true);
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
    public function outputData()
    {
        return [];
    }

    /**
     * Данные для создания элемента
     */
    public function createData()
    {
        return [];
    }

    /**
     * Данные для редактирования элемента
     */
    public function editData()
    {
        $data = $this->createData();

        $data += [
            'element' => $this->model
        ];

        return $data;
    }

    /**
     * Создание записи в БД
     */
    public function store($request)
    {
        $requestValidated = $request->validated();
        return $this->model->create($requestValidated);
    }

    /**
     * Обновление записи в БД
     */
    public function update($request)
    {
        $requestValidated = $request->validated();

        return $this->model->update($requestValidated);
    }

    /**
     * Удаляем элемент
     */
    public function removeElement()
    {
        return $this->model->delete();
    }

    /**
     * Собираем данные для Excel, отсортируем для соответсвия шапке и уберем лишние колонки, которых нет в шапке
     */
    protected function collectDataExcel($data, $columns)
    {
        $sColumns = array_flip(array_keys($columns));

        if(!empty($data)) {
            foreach($data as $key => $value) {

                $newArray = array_intersect_key($value, $columns);
                foreach($newArray as &$arr) {
                    $arr = strip_tags($arr);
                    $arr = str_replace('&nbsp;', ' ', $arr);
                    $arr = str_replace('&quot;', '"', $arr);
                }
                uksort($newArray, function ($a, $b) use($sColumns) {

                    return $sColumns[$a] > $sColumns[$b];
                });

                $data[$key] = $newArray;
            }
        }

        return $data;
    }

    public function search($request)
    {
        $keywords = prepare_keyword($request['q'] ?? '');

        return $this->model
            ->select(['id', 'title'])
            ->when(count($keywords), function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->where(function ($query) use ($keyword) {
                        $query->where('title', 'like', "%$keyword%");
                    });
                }
            })
            ->orderBy('title')
            ->paginate(15);
    }


}