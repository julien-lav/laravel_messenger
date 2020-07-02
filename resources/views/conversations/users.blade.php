<div class="col-md-3">
    <div class="list-group">
        @foreach ($users as $user)
            <a class="list-group-item" href="{{ route('conversations.show', $user->id) }}">This is user {{ $user->name }}</a>
        @endforeach  
    </div>
</div>