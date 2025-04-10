<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * メールに渡すデータ
     *
     * @var string
     */
    public $user;

    /**
     * 新しいメールインスタンスを作成する
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * メール内容をビルドする
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('新規登録ありがとうございます')  // メールの件名
                    ->view('emails.welcome');  // メールビューの指定
    }
}
