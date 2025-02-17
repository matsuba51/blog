@foreach ($blog->comments as $comment)
    <li class="bg-gray-700 p-4 rounded-md shadow">
        <strong class="text-blue-300">{{ $comment->user->name }}</strong>: 
        <span id="comment-text-{{ $comment->id }}">{{ $comment->content }}</span>

        @if (Auth::check() && Auth::id() === $comment->user_id)
            <button onclick="showEditForm({{ $comment->id }})" class="btn-edit">編集</button>
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">削除</button>
            </form>
        @endif
    </li>

    <!-- 編集フォーム -->
    <li id="edit-form-{{ $comment->id }}" class="hidden">
        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <textarea name="content" rows="2" class="w-full p-2 text-black rounded-md">{{ $comment->content }}</textarea>
            <div class="mt-2">
                <button type="submit" class="btn-primary">更新</button>
                <button type="button" onclick="hideEditForm({{ $comment->id }})" class="btn-secondary">キャンセル</button>
            </div>
        </form>
    </li>
@endforeach
