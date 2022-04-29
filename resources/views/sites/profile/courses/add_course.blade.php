
@extends('sites.layout-site')

@section('title')
إضافة دورة جديدة
@endsection
@section('css')

<link href="{{asset('site/assets/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
@endsection
@section('js')

<script>
 function ChooseFileUpVideo()
    { 
      // Get the checkbox instructor is  not external link    
       var checkBox = document.getElementById("up-video");
       var text = document.getElementById("up-video-input-link");
       if (checkBox.checked == true){
         text.value = '';
       } 
    };
</script>

<!-------------------------begin Course----------------------------------------->
<script>
   // Get the checkbox Course info  begin
   function ChooseCoursePriceFree()
    {     
         var checkBox = document.getElementById("radio-free-coures");
         var text = document.getElementById("course-price"); 
         if (checkBox.checked == true){
            document.getElementById("radio-not-free-coures").checked =false ;
           text.value = '';
           text.readOnly = true;
         } 

    };

 </script>

<script>
 
 function ChooseCoursePriceNotFree()
    {     
         var checkBox = document.getElementById("radio-not-free-coures");
         var text = document.getElementById("course-price"); 
         if (checkBox.checked == true){
            document.getElementById("radio-free-coures").checked =false ;
           text.value = '';
           text.readOnly = false;
         } 

    };
    //Course info  end

</script>

<!-------------------------end Course----------------------------------------->

<!-------------------------begin Certifi----------------------------------------->
<script>
 
  // Get the checkbox Certifi info  begin
  function ChooseCertifiPriceFree()
    {     
         var checkBox = document.getElementById("radio-certifi-free");
         var text = document.getElementById("certifi-price"); 
         if (checkBox.checked == true){
            document.getElementById("radio-certifi-not-free").checked =false ;
           text.value = '';
           text.readOnly = true;
         } 

    };
 
 </script>


<script>
 
 function ChooseCertifiPriceNotFree()
    {     
         var checkBox = document.getElementById("radio-certifi-not-free");
         var text = document.getElementById("certifi-price"); 
         if (checkBox.checked == true){
            document.getElementById("radio-certifi-free").checked =false ;
           text.value = '';
           text.readOnly = false;
         } 

    };
  // Certifi info  end 
 
 </script>
<!-------------------------end Certifi----------------------------------------->


<script>
  
  // peice just digital
  function isNumber(evt)
  {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

     return true;
  
};
    
</script>


<script>
  //  اختيار شهاده للكورس او عدم اختياره بحيث اقدر اجيب قيمه من الشيك بوكس لو هوا رقم واحد يبقي اختار شهاده  واقدر من خلاله اعطي قيود علي الشهاده 
function myFunction() {
  var x = document.getElementById('checkbox-add-cert');
  console.log(x.checked);
  if (x.checked) {
    x.checked = false;
  
  } else {
    x.checked = true;
  
  }

  console.log(x.checked);
};
</script>



@endsection
@section('js_course')


<script>
  

  $( document ).ready(function() {
         
           var radio_free_coures = document.getElementById("radio-free-coures");
           var text_free_coures = document.getElementById("course-price"); 
           if (radio_free_coures.checked == true){
              document.getElementById("radio-not-free-coures").checked =false ;
              text_free_coures.value = '';
              text_free_coures.readOnly = true;
           } 



           var checkBox_up_video = document.getElementById("up-video");
        
           if (checkBox_up_video.checked == true){
              document.getElementById("videoUploaded").style.display ='block' ;
            
           }else{
            document.getElementById("videoUploaded").style.display ='none' ;
           }


           var checkBox_add_cert_cretifi = document.getElementById("checkbox-add-cert");
        
        if (checkBox_add_cert_cretifi.checked == true){
           document.getElementById("course-cert").style.display ='block' ;
         
        }else{
         document.getElementById("course-cert").style.display ='none' ;
        }

      

           var radio_free_certifi = document.getElementById("radio-certifi-free");
          
           if (radio_free_certifi.checked == true){
              document.getElementById("radio-certifi-not-free").checked =false ;
              document.getElementById("certifi-price").value = '';
              document.getElementById("certifi-price").readOnly = true ;
             
           } 


    
                                                           

 
          });


                                                             
      
      
      </script>

<script src="{{asset('site/assets/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('site/assets/js/bootstrap-datepicker.ar.min.js')}}" charset="UTF-8" type="text/javascript"></script>

<script>
 $( document ).ready(function() {
        $.fn.datepicker.defaults.language = 'ar';
       
     
    });


    </script>


@endsection

@section('contacts')


     <div class="profile-content empty-course">
          <div class="container">
            
                       @include('sites.includes.alerts.success')
                       @include('sites.includes.alerts.errors')
                       @include('sites.includes.alerts.info')
                       @include('sites..profile.layout_ontant')
          
                    <div class="left_tap-box col-md-9 col-xs-12 pull-left">
                     
                        <div class="left_box-inner">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                     <div role="tabpanel" class="tab-pane fade in  active" id="home">
                                             
                                              <!-- /.home-head -->
                                              
                                             
                                                <div class="up-form">                                                                                        
                                                  {!!  Form::open(['route' => ['profile.course.create']  , 'method' => 'POST' ,  'enctype'=>'multipart/form-data']) !!}
                                                       @include('sites.collective-html.course.add_coures_form_fields')
                                                      

                                                       <div class="up_form-item">
                                                           <a   onclick="myFunction()" id="tag_a_add_cert"  class="add-cert">اضافة شهادة للدورة</a>
                                                           {!! Form::checkbox('add_cert' , 1  , null , ['id'=> "checkbox-add-cert" , 'style' => "display:none" ]) !!}
                                                           @include('sites.collective-html.course.add_certifi_form_fields')
                                                           <!-- /.up_form-item -->
                       
                                                           <div class="up_form-item up-confirm">
                                                               <input type="submit" value="اضافة الدورة">
                                                           </div>
                                                           <!-- /.up_form-item -->
                                                    
                       
                                                        </div>
                                      
                                                     
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