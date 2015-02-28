@include('meta')
@include('header')

<div class="row">
    <div class="col-md-12">
        <h3>Settings</h3>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        @include('settings.sidebar')
    </div>
    <div class="col-md-9" style="height:1000px;">
        <h4 style="margin-bottom:20px;">Warnings</h4>

        @include('settings.form', array('settings' => $settings))
    </div>
</div>

@include('footer')
