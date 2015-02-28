{!! Form::open(array('url' => '/warning/create', 'method' => 'post', 'role' => 'form', 'class' => 'form form-inline')) !!}

    {!! Form::hidden('userId', $user->getId(), array('style' => 'width:100%', 'id' => 'userId')) !!}
    {!! Form::hidden('postId', $post->getId(), array('style' => 'width:100%', 'id' => 'postId')) !!}

    <div class="form-group">
        {!! Form::label('ruleId', 'Rule Broken') !!}
        {!! Form::select('ruleId', $rules, null, array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('points', 'Warning Points') !!}
        {!! Form::text('points', 1, array('class' => 'form-control')) !!}
    </div>

    {!! Form::button('Send', array('class' => 'btn btn-default btn-primary', 'type' => 'submit', 'style' => 'margin-top:25px')) !!}

{!! Form::close() !!}
