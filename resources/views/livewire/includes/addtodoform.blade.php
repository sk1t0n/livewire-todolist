<form class="todolist-addtodoform" wire:submit="addTodo">
    @error('newTodo')
        <div>{{ $message }}</div>
    @enderror
    <input wire:model="newTodo" type="text" placeholder="Enter todo ...">
</form>
