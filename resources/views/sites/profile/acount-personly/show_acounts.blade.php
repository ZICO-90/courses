@extends('sites.layout-site')

@section('title')
    الملف الشخصي
@endsection

@section('css')
<style>
  .input-group
  {
    direction:rtl;
  }
  </style>
@endsection

@section('js')
<script>
    function ChooseFile()
    {



        // Change Images in Choose File
        var output = document.getElementById('images');

        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        };

    };
</script>
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
                                              <div class="home-head">
                                                  <h1>
                                                      <i class="fa fa-user"></i>
                                                      الملف الشخصي
                                                      <a class="edit-personal">
                                                          <i class="fa fa-cog"></i>
                                                          تعديل البيانات
                                                      </a>
                                                     
                                                  </h1>
                                              </div>
                                              <!-- /.home-head -->
                        
                                               <div class="home_img  text-center">
                                                   <div class="home_img-inner">
                                                       <div class="left-caption col-xs-12">
                                                         
                                                           <!-- /.imgcontent -->
                                                       </div>
                                                       <!-- /.Fption -->
                                                      
                                                       @if(!empty(auth()->user()->avatar))
                                                           <img src="{{asset(auth()->user()->avatar)}}" id="images" alt="" width="150" height="150">
                                                     
                                                            
                                                        @else
                                                      
                                                              @if(auth()->user()->gender == 1)
                                                              <img src="{{asset('site/assets/images/avatar5.png')}}" id="images" alt="" width="150" height="150">
                                                              @elseif(auth()->user()->gender == 2)
                                                              <img src="{{asset('site/assets/images/avatar3.png')}}" id="images" alt="" width="150" height="150">
                                                              @endif

                                                        @endif
                                                   </div>
                                               </div>
                                               {!!  Form::model($user_info, ['route' => ['profile.update.acounts',Crypt::encrypt($user_info->id) ] , 'method' => 'PUT' , 'enctype'=>'multipart/form-data']) !!}
                                               <div class="home_img  text-center">
                                                   <div class="home_img-inner" >
                                                       <div class="left-caption col-xs-12">
                                                        <input type="file" accept="image/*" id="show-adj8"   onchange="ChooseFile()" name="avatar">
                                                    </div>
                                                </div>
                                            </div>
                                        
                                                <!-- /.home_img -->
                        
                                                <div class="up-form">
                                                   
                                                   
                                                        
                                                            @include('sites.collective-html.acount-personly-form-fields')
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