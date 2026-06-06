<?php

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;

function createCategory(string $type = 'expense'): Category
{
    return Category::create([
        'name' => 'Test ' . $type . ' ' . Str::uuid(),
        'type' => $type,
    ]);
}

test('user can create transaction', function () {
    $user = User::factory()->create();
    $category = createCategory('expense');

    $payload = [
        'amount' => 15000,
        'type' => 'expense',
        'category_id' => $category->id,
        'description' => 'Belanja mingguan',
        'transaction_date' => now()->toDateString(),
    ];

    $response = $this
        ->actingAs($user)
        ->post(route('transactions.store'), $payload);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('transactions.index'));

    $this->assertDatabaseHas('transactions', [
        'user_id' => $user->id,
        'category_id' => $category->id,
        'type' => 'expense',
        'amount' => '15000.00',
        'description' => 'Belanja mingguan',
    ]);
});

test('user can update transaction', function () {
    $user = User::factory()->create();
    $category = createCategory('income');

    $transaction = Transaction::create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'type' => 'income',
        'amount' => 10000,
        'description' => 'Initial',
        'transaction_date' => now()->subDay()->toDateString(),
    ]);

    $response = $this
        ->actingAs($user)
        ->put(route('transactions.update', $transaction->id), [
            'amount' => 20000,
            'type' => 'income',
            'category_id' => $category->id,
            'description' => 'Updated income',
            'transaction_date' => now()->toDateString(),
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('transactions.index'));

    $this->assertDatabaseHas('transactions', [
        'id' => $transaction->id,
        'amount' => '20000.00',
        'description' => 'Updated income',
    ]);
});

test('user can delete transaction', function () {
    $user = User::factory()->create();
    $category = createCategory('expense');

    $transaction = Transaction::create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'type' => 'expense',
        'amount' => 7500,
        'description' => 'To delete',
        'transaction_date' => now()->toDateString(),
    ]);

    $response = $this
        ->actingAs($user)
        ->delete(route('transactions.destroy', $transaction->id));

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('transactions.index'));

    $this->assertSoftDeleted('transactions', [
        'id' => $transaction->id,
    ]);
});
