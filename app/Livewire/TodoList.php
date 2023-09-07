<?php

namespace App\Livewire;

use App\Models\TodoItem;
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

    public function render(): View
    {
        return view('livewire.todo-list', [
            'todoList' => TodoItem::paginate(self::TODOITEM_PER_PAGE),
        ])->title(config('app.name'));
    }

    public function changeTodoItemStatus(int $id): void
    {
        $todoItem = TodoItem::findOrFail($id);
        $todoItem->update([
            'completed' => ! $todoItem->completed,
        ]);
    }

    public function deleteTodoItem(int $id): void
    {
        TodoItem::findOrFail($id)->delete();
    }

    public function showFormAddTodo(): void
    {
        $this->showForm = ! $this->showForm;
    }

    public function addTodo(): void
    {
        $this->validate();

        TodoItem::create([
            'title' => $this->newTodo,
            'completed' => false,
        ]);

        $this->newTodo = '';
        $this->showForm = false;
    }
}
