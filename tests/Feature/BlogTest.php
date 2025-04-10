<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase; // テスト後にデータベースをリセット

    public function test_blog_list_can_be_viewed()
    {
        // ユーザーを作成
        $user = User::factory()->create();
        
        // ブログを作成
        $blog = Blog::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Blog',
            'content' => 'This is a test blog.',
        ]);

        // ログインした状態でブログ一覧ページにアクセス
        $response = $this->actingAs($user)->get('/blogs');

        // ステータスコードが200か確認（正常な応答）
        $response->assertStatus(200);

        // ページ内に'Test Blog'が含まれているか確認
        $response->assertSee('Test Blog');
    }
}
