<?php

namespace App\Services;

use App\Models\TodoItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TodoItemService
{
    public function getAll(int $perPage): LengthAwarePaginator
    {
        return TodoItem::query()->select([
            'id',
            'title',
            'completed',
        ])->paginate($perPage);
    }

    public function changeTodoItemStatus(int $id): void
    {
        DB::transaction(function () use ($id) {
            $todoItem = TodoItem::select([
                'id',
                'title',
                'completed',
            ])->lockForUpdate()->findOrFail($id);

            $todoItem->update([
                'completed' => ! $todoItem->completed,
            ]);
        });
    }

    public function deleteTodoItem(int $id): void
    {
        TodoItem::destroy($id);
    }

    public function createTodoItem(string $title, bool $completed = false): TodoItem
    {
        return TodoItem::create([
            'title' => $title,
            'completed' => $completed,
        ]);
    }
}
