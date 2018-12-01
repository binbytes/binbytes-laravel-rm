<div class="text-center">
    <div class="mb-2">
        @if($user->avatar)
            <img class="avatar" src="{{ $user->avatar_url }}">
        @else
            <span class="user-placeholder">{{ substr($user->name, 0, 2) }}</span>
        @endif
    </div>
    <h5 class="my-0">{{ $user->name }}</h5>
</div>