<?php
namespace App\Services\Admin\Example;

use App\Http\Resources\Example\ExampleFormResource;
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

    /**
     * Создание записи в БД
     */
    public function store($request)
    {
        $this->model = $this->model
            ->create($request);
        $this->model
            ->exampleBlocks()
            ->createMany($request['blocks']);
        return $this->model;
    }

    /**
     * Обновление записи в БД
     */
    public function update($request)
    {
        $this->model->update($request);
        if(isset($request['blocks']) && !empty($request['blocks'])){
            foreach ($request['blocks'] as $block) {
                if(isset($block['id'])){
                    $this->model
                        ->exampleBlocks()
                        ->find($block['id'])
                        ->update($block);
                }else{
                    $this->model
                        ->exampleBlocks()
                        ->create($block);
                }
            }
        }
        if(isset($request['deleting_blocks'])){
            $this->model
                ->exampleBlocks()
                ->whereIn('id', $request['deleting_blocks'])
                ->delete();
        }
        return $this->model;
    }

    /**
     * Данные для редактирования элемента
     */
    public function edit()
    {
        return [
            'model' => new ExampleFormResource($this->model)
        ];
    }
}