<?php

namespace App\Repositories;

use App\Models\TodoItem;
use Illuminate\Database\Eloquent\Builder;

class TodoItemRepository
{
    public function findAll(): Builder
    {
        return TodoItem::query()->select([
            'id',
            'title',
            'completed',
        ]);
    }

    public function findById(int $id): TodoItem
    {
        return TodoItem::select([
            'id',
            'title',
            'completed',
        ])->findOrFail($id);
    }
}
