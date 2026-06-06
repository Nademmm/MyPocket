<?php

use App\Models\Reminder;
use App\Models\SavingDiary;
use App\Models\Target;
use App\Models\User;

function validTargetPayload(array $overrides = []): array
{
    return array_merge([
        'title' => 'Emergency Fund',
        'target_amount' => 1000000,
        'current_amount' => 100000,
        'deadline' => now()->addMonth()->toDateString(),
        'status' => 'active',
    ], $overrides);
}

function validReminderPayload(array $overrides = []): array
{
    return array_merge([
        'title' => 'Pay Credit Card',
        'note' => 'Before due date',
        'remind_date' => now()->addDay()->format('Y-m-d\\TH:i'),
        'repeat_type' => 'once',
        'is_active' => '1',
    ], $overrides);
}

function validDiaryPayload(array $overrides = []): array
{
    return array_merge([
        'title' => 'Weekly Reflection',
        'content' => 'Saving progress is good and I need to stay consistent.',
        'diary_date' => now()->toDateString(),
    ], $overrides);
}

test('user can create update and delete target', function () {
    $user = User::factory()->create();

    $create = $this->actingAs($user)->post(route('targets.store'), validTargetPayload());
    $create->assertSessionHasNoErrors()->assertRedirect(route('targets.index'));

    $target = Target::where('user_id', $user->id)->latest('id')->firstOrFail();

    $update = $this->actingAs($user)->put(route('targets.update', $target->id), validTargetPayload([
        'title' => 'Updated Target',
        'current_amount' => 250000,
    ]));
    $update->assertSessionHasNoErrors()->assertRedirect(route('targets.index'));

    $this->assertDatabaseHas('targets', [
        'id' => $target->id,
        'title' => 'Updated Target',
        'current_amount' => '250000.00',
    ]);

    $delete = $this->actingAs($user)->delete(route('targets.destroy', $target->id));
    $delete->assertSessionHasNoErrors()->assertRedirect(route('targets.index'));

    $this->assertSoftDeleted('targets', ['id' => $target->id]);
});

test('user can create update and delete reminder', function () {
    $user = User::factory()->create();

    $create = $this->actingAs($user)->post(route('reminders.store'), validReminderPayload());
    $create->assertSessionHasNoErrors()->assertRedirect(route('reminders.index'));

    $reminder = Reminder::where('user_id', $user->id)->latest('id')->firstOrFail();

    $update = $this->actingAs($user)->put(route('reminders.update', $reminder->id), validReminderPayload([
        'title' => 'Updated Reminder',
        'repeat_type' => 'weekly',
    ]));
    $update->assertSessionHasNoErrors()->assertRedirect(route('reminders.index'));

    $this->assertDatabaseHas('reminders', [
        'id' => $reminder->id,
        'title' => 'Updated Reminder',
        'repeat_type' => 'weekly',
    ]);

    $delete = $this->actingAs($user)->delete(route('reminders.destroy', $reminder->id));
    $delete->assertSessionHasNoErrors()->assertRedirect(route('reminders.index'));

    $this->assertSoftDeleted('reminders', ['id' => $reminder->id]);
});

test('user can create update and delete diary', function () {
    $user = User::factory()->create();

    $create = $this->actingAs($user)->post(route('diaries.store'), validDiaryPayload());
    $create->assertSessionHasNoErrors()->assertRedirect(route('diaries.index'));

    $diary = SavingDiary::where('user_id', $user->id)->latest('id')->firstOrFail();

    $update = $this->actingAs($user)->put(route('diaries.update', $diary->id), validDiaryPayload([
        'title' => 'Updated Reflection',
        'content' => 'I improved my spending habits significantly this week.',
    ]));
    $update->assertSessionHasNoErrors()->assertRedirect(route('diaries.index'));

    $this->assertDatabaseHas('saving_diaries', [
        'id' => $diary->id,
        'title' => 'Updated Reflection',
    ]);

    $delete = $this->actingAs($user)->delete(route('diaries.destroy', $diary->id));
    $delete->assertSessionHasNoErrors()->assertRedirect(route('diaries.index'));

    $this->assertSoftDeleted('saving_diaries', ['id' => $diary->id]);
});
