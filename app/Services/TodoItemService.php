<?php

namespace App\Services;

use App\Models\TodoItem;
use App\Repositories\TodoItemRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TodoItemService
{
    public function __construct(private TodoItemRepository $todoItemRepository)
    {
    }

    public function getAll(int $perPage): LengthAwarePaginator
    {
        $query = $this->todoItemRepository->findAll();

        return $query->paginate($perPage);
    }

    public function changeTodoItemStatus(int $id): void
    {
        $todoItem = $this->todoItemRepository->findById($id);
        $todoItem->update([
            'completed' => ! $todoItem->completed,
        ]);
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
