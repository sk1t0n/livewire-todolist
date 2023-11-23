<?php

namespace App\Livewire;

use App\Services\TodoItemService;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    private const TODOITEM_PER_PAGE = 6;

    /** @var bool */
    public $showForm = false;

    /** @var string */
    #[Rule('required')]
    public $newTodo = '';

    private TodoItemService $todoItemService;

    public function boot(TodoItemService $todoItemService): void
    {
        $this->todoItemService = $todoItemService;
    }

    public function render(): View
    {
        return view('livewire.todo-list', [
            'todoList' => $this->todoItemService->getAll(self::TODOITEM_PER_PAGE),
        ])->title(config('app.name'));
    }

    public function changeTodoItemStatus(int $id): void
    {
        $this->todoItemService->changeTodoItemStatus($id);
    }

    public function deleteTodoItem(int $id): void
    {
        $this->todoItemService->deleteTodoItem($id);
    }

    public function showFormAddTodo(): void
    {
        $this->showForm = ! $this->showForm;
    }

    public function addTodo(): void
    {
        $this->validate();

        $this->todoItemService->createTodoItem($this->newTodo);

        $this->newTodo = '';
        $this->showForm = false;
    }
}
