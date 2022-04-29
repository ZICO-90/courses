
@if(Session::has('info'))
<div class="container">
        <div class="login-form col-md-6 col-xs-12 text-right pull-right">
            <div class="alert alert-info" role="alert">
             <span id="error-form"> {{Session::get('info')}} </span>
            </div>
        </div>
</div>
  @endif
