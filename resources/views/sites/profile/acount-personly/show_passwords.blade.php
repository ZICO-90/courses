@extends('sites.layout-site')

@section('title')
   تحديث كلمة المرور
@endsection

@section('css')
<style>
  .input-group
  {
    direction:rtl;
  }
  </style>
@endsection


@section('contacts')


     <div class="profile-content empty-course">
          <div class="container">
            
                     @include('sites.includes.alerts.success')
                     
                      @include('sites..profile.layout_ontant')
          
                    <div class="left_tap-box col-md-9 col-xs-12 pull-left">
                     
                        <div class="left_box-inner">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                     <div role="tabpanel" class="tab-pane fade in  active" id="home">
                                             
                                              <!-- /.home-head -->
                                              
                                               {!!  Form::open(['route' => ['profile.password.reset.update', auth()->user()->id ]  , 'method' => 'PUT']) !!}
                                             
                                                <div class="up-form">                                                                                        
            
                                                            @include('sites.collective-html.password-update-form-Fields')
                                                            <div class="up_form-item up-confirm">
                                                                <input type="submit" value="حفظ">
                                                            </div>
                                                            <!-- /.up_form-item -->
                                                     
                                                        {!! Form::close() !!}
                                                </div>
                                                <!-- /.home-content -->
                                     </div>
                             </div>
                            <!-- /.tap-content -->
                        </div>
                        <!-- /.left_tap-box -->
                    </div>
            </div>
     </div>
          <!-- /.left_tap-box -->
          
@endsection