@extends('sites.layout-site')

@section('title')
يرجي تسجيل حساب جديد
@endsection

@section('contacts')
<div class="up-box">
    @include('sites.includes.alerts.errors')
    @include('sites.includes.alerts.success')
    <div class="container">
        <div class="up-form">
            
            <form action="{{route('register.store')}}" method="POST">
                @csrf
                @include('sites.collective-html.register-form-Fields')
                <div class="up_form-item up-confirm">
                    <input type="submit" value="تسجيل">
                </div>
                <!-- /.up_form-item --> 
            </form>

        </div>
        <!-- /.up-form -->
    </div>
    <!-- /.container -->
</div>




                                
<div class="modal fade" id="teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align: center">
           
             
            <div class="lost-inner">
                <h1>
                    <i class="fa fa-cube"></i> تعرف علي سياسة الخصوصية كمدرب
                </h1>
                <div class="lost-item">
                    <p>{{$policy->teacher}}
                    </p>
                </div>
                <!-- /.lost-item -->
        
            </div>
                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">رفض</button>
          
          
        </div>
      </div>
    </div>
</div>




<div class="modal fade" id="sudents" tabindex="-1" role="dialog" aria-labelledby="messageModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align: center">
           
             
            <div class="lost-inner">
                <h1>
                    <i class="fa fa-cube"></i> تعرف علي سياسة الخصوصية كمتدرب
                </h1>
                <div class="lost-item">
                    <p><p>{{$policy->student}}
                    </p>
                </div>
                <!-- /.lost-item -->
        
            </div>
                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">رفض</button>
          
          
        </div>
      </div>
    </div>
</div>
@endsection

@section('js_course')

<script>
    $(document).ready(function() {
        $('.modal').on('shown.bs.modal', function() {
      
           $(this).before($('.modal-backdrop'));
           $(this).css("z-index", parseInt($('.modal-backdrop').css('z-index')) + 1);
          }); 
    });   
</script>
@endsection