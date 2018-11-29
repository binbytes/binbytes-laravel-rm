<div class="mb-3 row justify-content-center">
    <h5 class="m-0">
        @if($user->avatar)
            <img class="avatar mb-0" src="{{ $user->avatar_url }}">
        @else
            <span class="user-placeholder">{{ substr($user->name, 0, 2) }}</span>
        @endif
    </h5>
</div>
<h5 class="my-0">{{ $user->name }}</h5>