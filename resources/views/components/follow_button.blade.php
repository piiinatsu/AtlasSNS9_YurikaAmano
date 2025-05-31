@if(Auth::user()->follows()->where('followed_id', $targetUser->id)->exists())
  <form method="POST" action="{{ route('users.unfollow', $targetUser->id) }}" class="follow-form">
    @csrf
    <button type="submit" class="btn btn-danger">フォロー解除</button>
  </form>
@else
  <form method="POST" action="{{ route('users.follow', $targetUser->id) }}" class="follow-form">
    @csrf
    <button type="submit" class="btn btn-primary">フォローする</button>
  </form>
@endif
