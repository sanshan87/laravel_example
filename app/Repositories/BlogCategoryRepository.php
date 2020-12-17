<?php


namespace App\Repositories;

use App\Models\BlogCategory as Model;

class BlogCategoryRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }
    public function getEdit($id){
        return $this->startCondition()->find($id);
    }

    public function getForComboBox(){
        $columns = "id, CONCAT(id, '. ', title) as id_title";
        return $this->startCondition()
            ->selectRaw($columns)
            ->toBase()
            ->get();
    }

    public function getPaginator($countForPage = null){
        return $this->startCondition()->with(['parentCategory:id,title'])->paginate($countForPage);
    }
}
