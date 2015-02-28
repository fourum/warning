<div class="row">
    <div class="col-md-12">
        <h3>New Warning</h3>

        <p>
            You are warning <a href="{{ url('/user/' . $user->getUsername()) }}">{{ $user->getUsername() }}</a> for this <a href="{{ $post->getUrl() }}">post</a>
        </p>

        @include('warning::form')
    </div>
</div>
