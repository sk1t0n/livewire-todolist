<div class="todolist-wrapper">
    <h1 class="todolist-title">{{ config('app.name') }}</h1>

    <button wire:click="showFormAddTodo" class="todolist-addtodobutton">Add todo</button>

    @if ($showForm)
        @include('livewire.includes.addtodoform')
    @endif

    <hr class="my-4">

    <ul class="todolist">
        @foreach ($todoList as $todoItem)
            <li class="todolist__li" wire:key="{{ $todoItem->id }}">
                <span>
                    <input wire:click="changeTodoItemStatus({{ $todoItem->id }})" class="todolist__input" type="checkbox"
                        {{ $todoItem->completed ? 'checked' : '' }}>
                    {{ $todoItem->title }}
                </span>
                <button wire:click="deleteTodoItem({{ $todoItem->id }})" class="todolist__button">Delete</button>
            </li>
        @endforeach
    </ul>

    {{ $todoList->links() }}
</div>
