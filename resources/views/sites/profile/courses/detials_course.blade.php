@extends('sites.layout-site')

@section('title')
الدورات
@endsection

@section('css')
<link href="{{asset('site/assets/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('js')

<script>


    function chooce_answer(event ,TagSpan , ids ,isChecked)
     {     
     
    
       // var cheeckbox_answer =  document.getElementById(event + ids);

        var cheeckbox_answer_getttribut = isChecked.getAttribute('class')
        var checkboxes = document.getElementsByClassName(cheeckbox_answer_getttribut)

        var changeTextSpan =  document.getElementById(TagSpan + ids);
        var text_span_attr = changeTextSpan.getAttribute('name')
        var text_span_attr_list = document.getElementsByName(text_span_attr)

   
        for(i = 0 ; i < checkboxes.length ; i++ )
        {
            if(checkboxes[i] !== isChecked )
            {
               
                checkboxes[i].checked = false
                text_span_attr_list[i].innerHTML =  "خطأ"  ;
                text_span_attr_list[i].style.color = 'red' ;
            }else{
                checkboxes[i].checked = true
                text_span_attr_list[i].innerHTML =  "صح"  ;
                text_span_attr_list[i].style.color = '#0b990e' ;
            }
        }
       

        
 
     };
 
  </script>

  <script>
    // Get the checkbox Course info  begin js_details

    function add_lectur(event)
     {     
        
        
        var action =  document.getElementsByClassName(event);
        $(action).stop();
        $(action).slideToggle(400);
        
 
     };
 
  </script>





<script>
 function ChooseFileUpVideo(isname , close , isId ,upload ,IsgetCheck)
    { 
        //ChooseFileUpVideo('edit_up_video_lecture_' , 'edit_url_lecture_' , $lesson->id, 'edit_lecture_videoUploaded_' ,this )
      // Get the checkbox instructor is  not external link    
       //var checkBox = document.getElementByName(isname + isId );

        var linked_url_action = document.getElementsByName(close + isId);
        
       
        var upload_action =  document.getElementsByName(upload +  isId );


       

       if(IsgetCheck.checked === true)
       {
           
         linked_url_action[0].value = '';
         $(upload_action[0]).stop();
         $(upload_action[0]).slideDown();
         $(linked_url_action[0]).fadeOut();
      
       }else
       {
        
        linked_url_action[0].value = '';
        $(upload_action[0]).stop();
        $(upload_action[0]).slideUp();
        $(linked_url_action[0]).fadeIn();
       }


    };
</script>


<script>
    function ChooseFileUpVideoTwo(isname , close , isId ,upload ,IsgetCheck)
       { 
          var linked_url_action =  document.getElementById(close + isId);

          var uplaod_action =  document.getElementById(upload + isId);



/*
          console.log(linked_url_action )
          console.log(uplaod_action )
        console.log(isname)

        console.log(close)
        console.log(isId)
        console.log(upload)
        console.log(IsgetCheck)
   */
        if(IsgetCheck.checked === true)
        {
            $(uplaod_action).stop();
            $(uplaod_action).slideToggle(400);
            $(linked_url_action ).fadeOut();
        }else{

            $(uplaod_action).stop();
            $(uplaod_action).slideUp();
            $(linked_url_action ).fadeIn();
        }

       };
   </script>





<!-------------------------begin Course----------------------------------------->
<script>
   // Get the checkbox Course info  begin
   function ChoosePriceFree(isname , isId , close , price)
    {     
        
        var checkBox = document.getElementById(isname +isId );
        var text_price = document.getElementById(price + isId); 

        if (checkBox.checked == true){
            document.getElementById(close +isId ).checked =false ;
            text_price.value = '';
            text_price.readOnly = true;
        }
      
    };

 </script>

<script>
 
 function ChoosePriceNotFree(isname , isId , close , price)
    {     
        var checkBox = document.getElementById(isname +isId );
        var text_price = document.getElementById(price + isId); 
        if (checkBox.checked == true){
            document.getElementById(close +isId ).checked =false ;
            text_price.value = '';
            text_price.readOnly = false;
        }



    };
    //Course info  end

</script>


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
<script>
  

$( document ).ready(function() 
{
         
          
       var forms =    document.querySelectorAll('form[name=edit_course_form]');
       // begin for    
      for(var i=0;i<forms.length;i++)
      {

               var radioChexboxFree = document.getElementById("free-coures_"+i);
              
               if(radioChexboxFree.checked == true) // begin if   
               {
                   document.getElementById("not-free-coures_"+i).checked =false ;
                   var text_price_course =  document.getElementById('course-price_'+i);
                   text_price_course.value ='' ;
                   text_price_course.readOnly=true ;
               } // end if price
       
               var radioChexboxCertifiFree = document.getElementById("certifi-free_"+i);
               if(radioChexboxCertifiFree.checked == true) // begin if   
               {
                  
                 document.getElementById("certifi-not-free_"+i).checked =false ;
                  
                   var text_price_course =  document.getElementById('certifi-price_'+i);
                   text_price_course.value ='' ;
                   text_price_course.readOnly=true ;
               } // end if price

                var up_video = document.getElementById("up-video_"+i);
        
                var linked = document.getElementById('link-video_'+ i);
                var classlinked =  linked.getAttribute('class');
                var isActionlinked =  document.getElementsByClassName(classlinked);
        
          
                var action =  document.getElementById('videoUploaded_'+i);
                var className =  action.getAttribute('class');
                var isAction =  document.getElementsByClassName(className);
                     
                 if(up_video.checked === true)
                 {
                   linked.value= '';
                 $(isAction).stop();
                 $(isAction).slideDown();
                 $(isActionlinked).fadeOut();
                 }
   
                 var up_video_lecture = document.getElementById("up-video_lecture_"+i);
                 var isAction_linked_lecture  = document.getElementById('link-video_lecture_'+ i);
                 var action_lecture =  document.getElementById('lecture_videoUploaded_'+i);
                 var className_lecture =  action_lecture.getAttribute('class');
                 var isAction_lecture =  document.getElementsByClassName(className_lecture);
                     
                  if(up_video_lecture.checked === true)
                  {
                    
                    isAction_linked_lecture.value= '';
                    $(isAction).stop();
                    $(isAction_lecture).slideDown();
                    $(isAction_linked_lecture).fadeOut();
                  }


                  var cheeckbox_answer =  document.getElementById('answer_checkbox_' + i);

                  
                  var cheeckbox_answer_getttribut = cheeckbox_answer.getAttribute('class');
                  var checkboxes = document.getElementsByClassName(cheeckbox_answer_getttribut);
                
                 
                  var changeTextSpan =  document.getElementById('checkbox_value_' + i);
                  var text_span_attr = changeTextSpan.getAttribute('name');
                  var text_span_attr_list = document.getElementsByName(text_span_attr);

                  
               


                  if(checkboxes.length > 0)
                  {
                    for(t = 0 ; t < checkboxes.length ; t++ )
                   {
                   
                       if(checkboxes[t].checked === true )
                       {
                        
                           text_span_attr_list[t].innerHTML =  "صح"  ;
                           text_span_attr_list[t].style.color = '#0b990e' ;
                       }
                   }

                  }
                 
               


              //  edit_lecture_fields_form edit_lesson_form_'
                var is_Form_Name_lesson = 'form' + '[' + 'name=' + 'edit_lesson_form_'+ i + ']' ;
               
               
               
                 var forms_leeson =    document.querySelectorAll(is_Form_Name_lesson);
                
                    if(forms_leeson.length > 0)
                    {
                        console.log(forms_leeson );
                                     var lesson_edit_up_video_lecture = document.getElementById("edit_up-video_lecture_"+i);
                                     var leeeon_getTagClass = lesson_edit_up_video_lecture.getAttribute('class')
                                     var  lesson_edit_up_video_lecture_list =  document.getElementsByClassName(leeeon_getTagClass);

                                     console.log(lesson_edit_up_video_lecture_list.length);
                                     var lesson_edit_linked = document.getElementById('edit_link-video_lecture_'+ i);
                                     var  lesson_edit_classlinked =  lesson_edit_linked.getAttribute('class');
                                     var  lesson_edit_isActionlinked =  document.getElementsByClassName(lesson_edit_classlinked);
                    
                      
                                     var lesson_edit_action =  document.getElementById('edit_lecture_videoUploaded_'+ i);
                                     var lesson_className =  lesson_edit_action.getAttribute('class');
                                     var lesson_isAction =  document.getElementsByClassName(lesson_className);
                      
                   
                      
                         
                     
                                   

                                     for(lesson = 0  ; lesson < lesson_edit_up_video_lecture_list.length ; lesson++)
                                     {
                                         if(lesson_edit_up_video_lecture_list[lesson].checked === true)
                                         {
                                          
                                           $(lesson_isAction[lesson]).stop();
                                           $(lesson_isAction[lesson]).slideDown();
                                           $(lesson_edit_isActionlinked[lesson]).fadeOut();
                                         }
                                     }

                                     
                                   
                                    
                       
                    }   
                    
                    
                    var get_edit_test_form_id = document.getElementById("edit_test_form_"+ i);
                    if(get_edit_test_form_id != null)
                    {
                        var edit_test_name = get_edit_test_form_id.getAttribute('name');
                        var edit_list_form = document.getElementsByName(edit_test_name)
                       

                       for (let indexFrom = 0; indexFrom < edit_list_form.length; indexFrom++) {

                        var edit_answer_checkbox = document.getElementById("edit_answer_checkbox_"+ indexFrom);
                        var edit_answer_checkbox_class = edit_answer_checkbox.getAttribute('class');
                        var class_list = document.getElementsByClassName(edit_answer_checkbox_class)
                        
                        var edit_checkbox_value = document.getElementById("edit_checkbox_value_"+ indexFrom);
                        var edit_checkbox_value_name = edit_checkbox_value.getAttribute('name');
                        var text_span_attr_list = document.getElementsByName(edit_checkbox_value_name)
                            
                               for (let index = 0; index < class_list.length; index++) 
                               {
                                  
                                
                                      if(class_list[index].checked === true)
                                      {
                                        text_span_attr_list[index].innerHTML =  "صح"  ;
                                        text_span_attr_list[index].style.color = '#0b990e' ;
                                      }
                                 
                                }
                           
                       }
             
                        
                    
                       
                    }
         
                  
                    

             
    } // end for
          


 
}); // end document

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

            @if ($errors->any())
                 <div class="alert alert-danger">
                     <ul>
                         @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                         @endforeach
                     </ul>
                 </div>
            @endif
            @include('sites..profile.layout_ontant')
            
            <div class="left_tap-box col-md-9 col-xs-12 pull-left">
                <div class="left_box-inner">
                    <!-- Tab panes -->
                    <div class="tab-content">
                       
                        <div role="tabpanel" class="tab-pane fade active in" id="coursesDetalis">
                            <div class="home-head">
                                <h1>
                                    <i class="fa fa-database"></i>
                                    الدورات
                                </h1>
                                @if(auth()->guard('web')->user()->is_stop === 0)
                                <a class="add1_course" href="{{route('profile.course.add')}}">
                                    <i class="fa fa-plus"></i>إضافة دورة
                                </a>
                                @endif
                            </div>
                           
                            <!-- /.home-head -->
                            <div class="home-content  pass-content col-xs-12">
                               
                                <div class="home_data col-md-12 pull-right text-right">

                                    @php
                                    $months = [
                                                'January' => "يناير" ,
                                                'February' => "فبراير",
                                                
                                                'March' => "مارس" ,
                                                'April' => "أبريل",
                                                
                                                'May' => "مايو" ,
                                                'June' => "يونيو",
                                                
                                                'July' => "يوليو" ,
                                                'August' => "أغسطس",
                                                
                                                'September' => "سبتمبر" ,
                                                'October' => "أكتوبر",
                                                
                                                'November' => "نوفمبر" ,
                                                'December' => "ديسمبر",
                                                
                                                
                                                ];
                                        @endphp

                                @if(auth()->guard('web')->user()->is_stop === 0)
                                    @if(isset($instructor_info_course) && sizeof($instructor_info_course->course_instructor) >0 )
                                    @foreach ($instructor_info_course->course_instructor as $index_course  => $item)
                                  
                                    <div class="shop-wrapper col-xs-12">
            
                            
                                        
                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                      
                                            
                                    
                                            <div class="panel panel-default">
                                                <div class="panel-heading collapsed" role="button" id="heading_{{$item->id}}" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$item->id}}" aria-expanded="false" aria-controls="collapse">
                                                    <h4 class="panel-title">
                                                       <a>
                                                           <h5>
                                                               <i class="fa fa-group"></i>{{sizeof($item->studen_course)}}
                                                           </h5>
                                                            {{$item->title . " " .$item->id}}                            
                                                    
                                                        </a>
                                       
                                       
                                                       </h4>   
                                                      
                                                </div>
                                                <div id="collapse_{{$item->id}}" class="panel-collapse collapse" role="tabpanel"  aria-labelledby="heading_{{$item->id}}" aria-expanded="false" style="height: 0px;">
                                                    <div class="panel-body">
                                                        <div class="instructor-control text-center">
            
                                                            <a href="#" class="delete-course">
                                                                <i class="fa fa-trash"></i> حذف الدورة
                                                            </a>
                                                            <a href="#" class="add-course" onclick="add_lectur('add_lecture_{{$item->id}}')">
                                                                <i class="fa fa-plus"></i> إضافة محاضرة
                                                            </a>
                                                            <a href="#" class="message-course"  data-toggle="modal" data-target="#messageEmailForAllSudents_{{$item->id}}">
                                                                <i class="fa fa-envelope"></i> إرسال للجميع
                                                            </a>
                                                            <!-- =========================================================================================================================================== -->
            
                                                            <!-- =========================================================================================================================================== -->
                                                            <a href="#" class="edit-course" onclick="add_lectur('edit_course_{{$item->id}}')">
                                                                <i class="fa fa-pencil"></i> تعديل الدورة
                                                            </a>
                                                            <a href="#" class="edit-certifi" onclick="add_lectur('edit_certifi_{{$item->id}}')">
                                                                <i class="fa fa-pencil"></i> 
                                                                @if(empty($item->Certificate))
                                                                    اضافة شهاده
                                                                @else
                                                                تعديل الشهاده
                                                                @endif
                                                               
                                                            </a>
                                                            @if(isset($item->lessons) && sizeof($item->lessons) > 0)
                                                            <a href="#" class="edit-lecture" onclick="add_lectur('edit_lecture_{{$item->id}}')">
                                                                <i class="fa fa-pencil"></i> 
                                                               
                                                                تعديل محاضرة
                                                              
                                                            </a>
                                                            @endif
                                                            @if(isset($item->questions) && sizeof($item->questions) > 0)
                                                            <a href="#" class="edit-lecture" onclick="add_lectur('edit_test_{{$item->id}}')">
                                                                <i class="fa fa-pencil"></i> 
                                                               
                                                                   تعديل اختبار
                                                              
                                                               
                                                            </a>
                                                            @endif
                                                            <a href="#" style="background-color: #0ea789;)"  onclick="add_lectur('add_test_{{$item->id}}')">
                                                                <i class="fa fa-pencil"></i> 
                                                               
                                                                   اضافه اختبار
                                                              
                                                               
                                                            </a>
                                                             
                                                            <a href="#"  style="background-color: #e87d00;)"    data-toggle="modal" data-target="#gatewayModalCenter_{{$item->id}}">
                                                                <i class="fa fa-bullhorn"></i> إضافة تنويه
                                                            </a>
                                                            <a href="{{route('subscriber.show' , Crypt::encrypt($item->id))}}"  style="background: rgb(0, 255, 238);">
                                                                <i class="glyphicon glyphicon-folder-open"></i> 
                                                               
                                            اذهب الي الدورة
                                                               
                                                            </a>
                                                             
                                                            <!-- =========================================================================================================================================== -->
                                                           
                                                         
                                                            <!-- /.modal -->
                                                               <div class="add_notify_form add_notify_form_{{$item->id}}">
                                                                @include('sites.collective-html.course.details.add_notify_form_fields_form')
                                                               </div>
                                                            <!-- /.modal -->
                                                            <!-- =========================================================================================================================================== -->

                                                            <div class="message_course message_course_{{$item->id}}">
                                                                
                                                                @include('sites.collective-html.course.details.message_course_fields_form')

                                                            </div>
                                                            <!-- /.modal -->
                                                      
                                                            <div class="add_lecture add_test_{{$item->id}}">
                                                               
                                                                {!!  Form::open(['route' => 'profile.course.QuestionAnswer.add'  , 'method' => 'POST' ]) !!}
                                                               
                                                                    @include('sites.collective-html.course.details.add_test_fields_form')
                                                                  
                                                                    {!! Form::close() !!}
                                                             
                                                            </div>
                                                   
                                                            
                                                                  <div class="add_lecture edit_test_{{$item->id}}">
                                                               
                                                                  
                                                                      <div class="instructor-control text-center">

                                                                        @foreach ($item->questions as $index_questions => $questionItem)
                                                                        <a href="#" class="edit-lecture" style="width: 90%;" onclick="add_lectur('edit_inside_test_{{$questionItem->id}}')">
                                                                                
                                                                             
                                                                            <i class="fa fa-play-circle"></i>
                                                                           
                                                                            {{$questionItem->question}}    
                                                                          
                                                                            <a href="{{route('profile.course.QuestionAnswer.delete' , Crypt::encrypt($questionItem->id) )}}" class="edit-lecture"  data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف الدرس">
                                                                              <i class="fa fa-trash"></i>
                                                                            </a>
                                                                        </a>

                                                                       
                                                                             <div class="add_lecture edit_inside_test_{{$questionItem->id}}">

                                                                                {!!  Form::open(['route' => 'profile.course.QuestionAnswer.update'  , 'name' =>'edit_test_form_'.$index_course  ,'id' => 'edit_test_form_'.$index_course ,  'method' => 'PUT' ]) !!}
                                                                                
                                                                                @include('sites.collective-html.course.details.edit_test_fields_form')

                                                                                {!! Form::close() !!}
                                                                             </div>
                                
                                                                        @endforeach

                                                                      </div>
                                                                     
                                                                  </div>
                                                        

                                                            <div class="add_lecture add_lecture_{{$item->id}}">
                                                               
                                                                {!!  Form::open(['route' => 'profile.course.lesson.add'  , 'method' => 'POST' ,  'enctype'=>'multipart/form-data']) !!}
                                                               
                                                                    @include('sites.collective-html.course.details.add_lecture_fields_form')

                                                                  
                                                                    {!! Form::close() !!}
                                                             
                                                            </div>

                                                            <div class="add_lecture edit_lecture_{{$item->id}}">
                                                               @if(!empty($item->lessons ))
                                                               
                                                               <div class="instructor-control text-center">
                                                             
                                                                
                                                                       
                                                                        @foreach ($item->lessons as $index_lesson => $lesson)
                                                               
                                                                       
                                                                    
                                                                       
                                                                              <a href="#" class="edit-lecture" style="width: 90%;" onclick="add_lectur('edit_inside_lesson_{{$lesson->id}}')">
                                                                                
                                                                             
                                                                                  <i class="fa fa-play-circle"></i>
                                                                                 
                                                                                  {{$lesson->name . " " .$lesson->id}}    
                                                                                
                                                                                  <a href="{{route('profile.course.lesson.delete' , $lesson->id )}}" class="edit-lecture"  data-toggle="tooltip" data-placement="top" title="" data-original-title="حذف الدرس">
                                                                                    <i class="fa fa-trash"></i>
                                                                                  </a>
                                                                              </a>
                                                                            <!-- lesson_edit_up_video_lecture_list -->

                                                                              <div class="add_lecture edit_inside_lesson_{{$lesson->id}}">
                                                                                {!!  Form::model($lesson,['route' => 'profile.course.lesson.update'  , 'name' =>'edit_lesson_form_'.$index_course , 'value' => $item->id ,'id' => 'edit_lesson_form_'.$index_course ,  'method' => 'PUT' ,  'enctype'=>'multipart/form-data']) !!}

                                                                                
                                                                                @include('sites.collective-html.course.details.edit_lecture_fields_form')
                                                                                {!! Form::close() !!}
                                                                            </div>
                                                                        <!-- end shop-wrapper -->
                                                                      
                                                                     
                                                                        @endforeach
                                                                  
                                                                </div>
                                                                    <!-- ./home_data -->
                                                                    
                                                                    
                                                               
                                                                <!-- /.home-content -->

                                                               @endif
                                                         
                                                            </div>
                                                    
                                                            <!-- /.modal --> 
                                                            <div class="edit_course edit_course_{{$item->id}}">
                                                                <div class="up-form">    
                                                                    {!!  Form::model($item,['route' => ['profile.course.update.course' , 'id' => $item->id]  , 'name' =>'edit_course_form' , 'value' => $item->id ,'id' => 'edit_course_form_'.$item->id ,  'method' => 'PUT' ,  'enctype'=>'multipart/form-data']) !!}
                                                                @include('sites.collective-html.course.details.edit_coures_form_fields')
                               
                                                                <div class="up_form-item up-confirm">
                                                                    <input type="submit" value="تعديل الدورة">
                                                                </div>
                                                                <!-- /.up_form-item -->
                                                                {!! Form::close() !!}
                                                            </div>
                                                            </div>

                                                           

                                                            <div class="edit_certifi edit_certifi_{{$item->id}}">
                                                             
                                                                <div class="up-form">    
                                                                    <div class="up_form-item">
                                                                        <div class="up_form-item">
                                                                            @if(empty($item->Certificate))
                                                                            {!!  Form::open(['route' => ['profile.course.certifi' , ['certifi' => $item->id]]  , 'name' =>'certificate'  ,'id' => 'certificate_'.$item->id ,  'method' => 'POST']) !!}
                                                                            @include('sites.collective-html.course.details.update_or_add_certifi_form_fields')
                                                                            <div class="up_form-item up-confirm">
                                                                                <input type="submit" value="اضافة الشهاده">
                                                                            </div>
                                                                            {!! Form::close() !!}
                                                                            @else
                                                                            {!!  Form::model($item->Certificate,['route' => ['profile.course.certifi' , ['certifi' => $item->Certificate->id ] ]  , 'name' =>'certificate'  ,'id' => 'certificate_'.$item->id ,  'method' => 'PUT']) !!}
                                                                            @include('sites.collective-html.course.details.update_or_add_certifi_form_fields')
                                                                            <div class="up_form-item up-confirm">
                                                                                <input type="submit" value="تعديل الشهاده">
                                                                            </div>
                                                                            {!! Form::close() !!}
                                                                            @endif
                                                                           

                                                                        </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <!-- /.modal -->
                                                          
                                                            <!-- /.add_lecture -->
                                                        </div>
                                                        <!-- /.instructor-control -->
                                                        <ul>
                                                            <li>
                                                                <h1>
                                                                    <label>الوصف</label>
                                                                    <span class="par">
                                                                        {{$item->title}}
                                                            </li>
                                                            <li>
                                                                <h1>
                                                                    <label>المجال</label>
                                                                    <span>{{$item->coures_interest->name}}</span>
                                                                </h1>
                                                            </li>
            
                                                            <li>
                                                                <h1>
                                                                    <label>عدد المشتركين في الدورة</label>
                                                                    <span>{{ sizeof($item->studen_course)}}</span>
                                                                </h1>
                                                            </li>
                                                           
                                                            <li>
                                                                <h1>
                                                                    <label>نشرت / لم تنشر</label>
                                                                    @if($item->is_activation ===1)
                                                                    <span>نشرت</span>
                                                                    @else
                                                                    <span>لم تنشر</span>
                                                                    @endif
                                                                    
                                                                </h1>
                                                            </li>
                                                            <li>
                                                                <h1>
                                                                    <label>الشهادة</label>
                                                                    @if(!empty($item->Certificate))
                                                                    <span>{{$item->Certificate->name}}</span>
                                                                    @else
                                                                    <span>لا توجد شاهده !! كما يمكنك اضافة شهاده</span>
                                                                    @endif
                                                                </h1>
                                                            </li>
                                                            <li>
                                                                <h1>
                                                                    <label>السعر</label>
                                                                    @if($item->case_payment_course === 1)
                                                                    <span>$ {{$item->course_price}}</span>
                                                                    @else
                                                                    <span>مجانيه</span>
                                                                    @endif
                                                                </h1>
                                                            </li>
                                                            <li>
                                                                <h1>
                                                                    <label>التاريخ</label>
                                                                    @php
                                                                    $getSatrt_Date =  \Carbon\Carbon::parse(strtotime($item->start_date));
                                                                    $getEnd_Date =  \Carbon\Carbon::parse(strtotime($item->end_date));
                                                                     @endphp
                                                                    <span>
                                                                        من :                                {{$getSatrt_Date->format('d')}} {{$months[$getSatrt_Date->format('F')]}} {{$getSatrt_Date->format('Y')}}   الي :  {{$getEnd_Date->format('d')}}  {{$months[$getEnd_Date->format('F')]}}  {{$getEnd_Date->format('Y')}}                                                </span>

                                                                    </span>
                                                                </h1>
                                                            </li>
                                                          
                                                            <li>
                                                                <h1>
                                                                    <label>إسم المدرب</label>
                                                                    <span>{{$instructor_info_course->full_name}}</span>
                                                                </h1>
                                                            </li>
                                                        </ul>

                                                      
                                                        <div class="modal fade" id="gatewayModalCenter_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                </div>
                                                                <div class="modal-body" style="text-align: center">
                                                                   
                                                                     
                                                                    {!!  Form::open(['route' => 'profile.course.notify.Subscribers'  , "id" => "notify_".$item->id , 'method' => 'POST' ]) !!}

                                                                    
                                                                        <div class="lost-inner">
                                                                            <h1>
                                                                                <i class="fa fa-envelope"></i>
                                                                                اضافة تنويه للطلاب المشتركين في الدورة
                                                                            </h1>
                                                                            <div class="lost-item" id="alert-item">
                                                                                <input type="text" placeholder="عنوان التنويه" name="title">
                                                                            </div>
                                                                            <!-- /.lost-item -->
                                                                            <div class="lost-item" id="alert-item">
                                                                                <textarea placeholder="مضمون التنويه" name="body"></textarea>
                                                                            </div>

                                                                          
                                                                                <input type="hidden"  name="courseId" value="{{Crypt::encrypt($item->id)}}">
                                                                                <input type="hidden"  name="instructorId" value="{{Crypt::encrypt($item->instructor_id)}}">
                                                                            
                                                                            <!-- /.lost-item -->
                                                                            <div class="text-center">
                                                                                <input type="submit" value="نشر التنويه">
                                                                            </div>
                                                                            <!-- /.lost-item -->
                                                                        </div>
                                                                        <!-- /.lost-inner -->
                                                                    
                                                                    <!-- /.modal -->
                                                                    
                                                                      {!! Form::close() !!}
                                                                        
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">رفض</button>
                                                                  
                                                                  
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>


                                                        <div class="modal fade" id="messageEmailForAllSudents_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                </div>
                                                                <div class="modal-body" style="text-align: center">
                                                                   
                                                                     
                                                                    {!!  Form::open(['route' => 'subscriber.course.free'  , "id" => "payOrder" , 'method' => 'POST' ]) !!}

                                                                    
                                                                        <div class="lost-inner">
                                                                            <h1>
                                                                                <i class="fa fa-envelope"></i>
                                                                                إرسال رسالة الي جميع الطلبة المشتركين بهذه الدورة
                                                                            </h1>
                                                                           
                                                                            <!-- /.lost-item -->
                                                                            <div class="lost-item" id="alert-item">
                                                                                <textarea placeholder="مضمون التنويه">{{$item->id}}</textarea>
                                                                            </div>
                                                                            <!-- /.lost-item -->
                                                                            <div class="text-center">
                                                                                <input type="submit" value="ارسال ">
                                                                            </div>
                                                                            <!-- /.lost-item -->
                                                                        </div>
                                                                        <!-- /.lost-inner -->
                                                                    
                                                                    <!-- /.modal -->
                                                                    
                                                                      {!! Form::close() !!}
                                                                        
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">رفض</button>
                                                                  
                                                                  
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.panel-body -->
            
                                                </div>
                                                <!-- /#collapseOne -->
                                            </div>
                                        
                                        
            
                                        </div>
                                        <!-- /.panel-group -->
                                    
            
                                    </div>
                                    <!-- end shop-wrapper -->

                                   
                                    @endforeach
                                    @else
                                    <div class="flash_empty text-center">
                                        <h1 class="animated shake">
                                            <i class="fa fa-frown-o"></i>
                                            عفواً لا يوجد لديك دورات في هذا القسم
                                        </h1>
                                    </div>
                                    @endif
                                </div>
                            @else
                            <div class="flash_empty text-center">
                                <h1 class="animated shake">
                                    <i class="glyphicon glyphicon-minus-sign"></i>
                                   تم اقافك من قبل الادارة
                                </h1>
                            </div>
                            @endif
                                <!-- ./home_data -->
                                
                            </div>
                            <!-- /.home-content -->
                           
                        </div>
                  
                    </div>
                    <!-- /.tap-content -->
                </div>
                <!-- /.left_tap-box -->
            </div>

        </div>
        <!-- /.left_tap-box -->
</div>
@endsection

