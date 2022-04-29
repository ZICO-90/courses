
@if(Session::has('error'))
<div class="container">
        <div class="login-form col-md-6 col-xs-12 text-right pull-right">
            <div class="alert alert-danger" role="alert">
                <span id="error-form"> {{ Session::get('error') }} </span>
            </div>
        </div>
</div>
  @endif

 


