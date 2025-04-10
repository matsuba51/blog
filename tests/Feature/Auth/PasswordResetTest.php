<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

// ✅ 1. 「パスワードリセットリンク画面」が表示できるか
test('reset password link screen can be rendered', function () {
    $response = $this->get('/forgot-password');
    $response->assertStatus(200);
});

// ✅ 2. パスワードリセットのリクエストが送信できるか
test('reset password link can be requested', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    // 🔹 通知が送信されたか確認
    Notification::assertSentTo($user, ResetPassword::class);
});

// ✅ 3. パスワードリセット画面が正しく開けるか
test('reset password screen can be rendered', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    // 🔹 送信された通知を取得
    $notification = Notification::sent($user, ResetPassword::class)->first();

    // 🔹 通知が送信されているか確認
    expect($notification)->not->toBeNull();

    // 🔹 トークンを取得
    $token = $notification->token;

    // 🔹 パスワードリセット画面が開けるか確認
    $response = $this->get("/reset-password/{$token}");

    $response->assertStatus(200);
});

// ✅ 4. 有効なトークンでパスワードをリセットできるか
test('password can be reset with valid token', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    // 🔹 送信された通知を取得
    $notification = Notification::sent($user, ResetPassword::class)->first();

    expect($notification)->not->toBeNull();

    $token = $notification->token;

    // 🔹 パスワードをリセット
    $response = $this->post('/reset-password', [
        'token' => $token,
        'email' => $user->email,
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('login'));

    // 🔹 パスワードが変更されたか確認
    $this->assertTrue(\Illuminate\Support\Facades\Hash::check('new-password', $user->fresh()->password));
});
