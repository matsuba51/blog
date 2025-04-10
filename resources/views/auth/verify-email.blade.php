<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        ご登録ありがとうございます！<br>
        ご利用を開始する前に、登録時に入力されたメールアドレス宛に送信された確認リンクをクリックして、メールアドレスの確認をお願いします。<br>
        メールが届いていない場合は、以下のボタンから再送することができます。
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            新しい確認リンクを登録済みのメールアドレスに送信しました。
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    メールを再送する
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                ログアウト
            </button>
        </form>
    </div>
</x-guest-layout>
