<?php

use App\Livewire\TodoList;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(TodoList::class)
        ->assertStatus(200);
});

test('showFormAddTodo', function () {
    Livewire::test(TodoList::class)
        ->call('showFormAddTodo')
        ->assertSet('showForm', true)
        ->call('showFormAddTodo')
        ->assertSet('showForm', false);
});

test('addTodo', function () {
    Livewire::test(TodoList::class)
        ->set('newTodo', 'Todo 1')
        ->call('addTodo')
        ->assertSet('newTodo', '')
        ->assertSet('showForm', false);

    $this->assertDatabaseCount('todo_items', 1);
});

test('addTodo when newTodo is empty', function () {
    Livewire::test(TodoList::class)
        ->call('addTodo')
        ->assertHasErrors('newTodo');
});
