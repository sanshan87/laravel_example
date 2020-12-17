<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;

class BlogPostRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getPaginator($countForPage = null)
    {
        $fields = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];

        $result = $this->startCondition()
            ->select($fields)
            ->orderBy('id', 'DESC')
            ->with(['category:id,title', 'user:id,name'])
            ->paginate($countForPage);

        return $result;
    }

    public function getEdit($id)
    {
        return $this->startCondition()->find($id);
    }
}
