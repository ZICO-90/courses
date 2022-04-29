@extends('sites.layout-site')

@section('title')
 عنوان الدرس: {{$thisLesson->name}}
@endsection

@section('css')
<link href="{{asset('site/assets/css/video-js.css')}}" rel="stylesheet" type="text/css">


<style>
  .hit-voting:hover {
    color: blue
}

.hit-voting {
    cursor: pointer
}
  .img-sm {
    direction: rtl;
    width: 46px;
    height: 46px;
}

.panel {
    box-shadow: 0 2px 0 rgba(0,0,0,0.075);
    border-radius: 0;
    border: 0;
    margin-bottom: 15px;
}

.panel .panel-footer, .panel>:last-child {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}

.panel .panel-heading, .panel>:first-child {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

.panel-body {
    padding: 25px 20px;
}


.media-block .media-left {
    display: block;
    float: left
}

.media-block .media-right {
    float: right
}

.media-block .media-body {
    display: block;
    overflow: hidden;
    width: auto
}

.middle .media-left,
.middle .media-right,
.middle .media-body {
    vertical-align: middle
}

.thumbnail {
    border-radius: 0;
    border-color: #e9e9e9
}

.tag.tag-sm, .btn-group-sm>.tag {
    padding: 5px 10px;
}

.tag:not(.label) {
    background-color: #fff;
    padding: 6px 12px;
    border-radius: 2px;
    border: 1px solid #cdd6e1;
    font-size: 12px;
    line-height: 1.42857;
    vertical-align: middle;
    -webkit-transition: all .15s;
    transition: all .15s;
}
.text-muted, a.text-muted:hover, a.text-muted:focus {
    color: #acacac;
}
.text-sm {
    font-size: 0.9em;
}
.text-5x, .text-4x, .text-5x, .text-2x, .text-lg, .text-sm, .text-xs {
    line-height: 1.25;
}

.btn-trans {
    background-color: transparent;
    border-color: transparent;
    color: #929292;
}

.btn-icon {
    padding-left: 9px;
    padding-right: 9px;
}

.btn-sm, .btn-group-sm>.btn, .btn-icon.btn-sm {
    padding: 5px 10px !important;
}

.mar-top {
    margin-top: 15px;
}
</style>
@endsection
@section('js')
<script>

  function reply(Classed) {
    var x = document.getElementById(Classed);
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  };
  
  
  </script>
    
@endsection


@section('contacts')
<div class="intro-container">
            <!-- /.intro-head -->
            <div class="corse-indv">
                <div class="container">
                                                              
                    <!-- end mob-episodes -->
                    <div class="corse_indv-video col-md-12 col-xs-12 text-center">
                        <div class="intro-video col-xs-12 text-center">

                            @if($thisLesson->url_type === 0)
                            <iframe width="100%" height="520" src="https://www.youtube.com/embed/{{$thisLesson->youtube_id}}" frameborder="0" allowfullscreen></iframe>
                            @else
                            <video id="example_video_1" class="video-js vjs-default-skin" controls="true" width="100%" height="420" poster="{{asset('site/assets/images/3lom.jpg')}}">
                                <source src="{{asset($thisLesson->url_video)}}" type="video/mp4">
                            </video>
                            @endif
                          
                           
                      
                           
                            <div class="finish-corse text-left col-xs-12">
                                @php
                                 $endLesson =     auth()->guard('web')->user()->lessone_course()->where('lesson_id' ,$thisLesson->id )->where('cource_id' , $thisLesson->cource_id )->first();           
                                
                                @endphp
                                    @if($allLessons->instructor_id != auth()->guard('web')->user()->id )
                                @if(!empty($endLesson) && $endLesson->lesson_id == $thisLesson->id &&  $endLesson->cource_id == $thisLesson->cource_id)
                                      <a style="pointer-events: none;"  onclick="return false" >
                                         نعم قد انهيت الدرس
                                      </a>
                                @else
                                      <a href="javascript:void()" onclick="document.getElementById('endLeesonForm').submit();">
                                          لقد انهيت هذا الدرس
                                      </a>
                                      {!!  Form::open(['route' => 'subscriber.individual.endLesson'  , "id" => "endLeesonForm" , 'method' => 'POST' ]) !!}
                                      <input type="hidden" name="studentID" value="{{Crypt::encrypt(auth()->guard('web')->user()->id)}}"/>
                                      <input type="hidden" name="courceID" value="{{Crypt::encrypt($thisLesson->cource_id)}}"/>
                                      <input type="hidden" name="lessonID" value="{{Crypt::encrypt($thisLesson->id)}}"/> 
                                      {!! Form::close() !!}
                                @endif
                                @else
                                   <a style="pointer-events: none;"  onclick="return false" >
                                       المدرب
                                    </a>
                                @endif
                                

                                @include('sites.includes.alerts.errors')
                                <div class="lesson-desc col-xs-12 text-right">
                                    <h1>وصف المحاضرة</h1>
                                    <p> 
                                            {{$thisLesson->detalis}}
                                    </p>
                                </div>
                            </div>
                            <!-- end finish-corse -->
                        </div>
                        <!-- end corse_indv-inner -->
                    </div>
                    <!-- end corse_indv-video -->
                    
                        <div class="corse-episodes col-md-3 col-xs-12 text-right">
                          <div class="corse_episodes-inner">
                              <ul>
                                  <li>
                                        <h1>
                                           <i class="fa fa-tasks"></i> محاضرات الدورة
                                        </h1>
                                  </li>
                                  
                                 
                                 
                                  @foreach ($allLessons->lessons as $item)
                                  <li>
                                      <a href="{{route('subscriber.individual.show' ,Crypt::encrypt($item->id))}}" class="{{Crypt::decrypt(request()->route()->parameters['id']) == $item->id ? 'active' : '' }}">
                                       @if( $item->student_lessone_course->contains(function ($val) use ($item ) { return $val->lesson_id  == $item->id && $val->cource_id == $item->cource_id &&  $val->student_id  == auth()->guard('web')->user()->id;}))  <i class="glyphicon glyphicon-check"></i>  @endif <i class="fa fa-play-circle"></i>{{$item->name}}
                                      </a>
                                      
                                  </li>
                                  @endforeach
                               
                              </ul>
                          </div>
                        </div>



                    
                    <!-- end corse-comments -->
                </div>
                <!-- end container -->
            </div>
            <!-- end corse-indv -->
</div>
@php
\Carbon\Carbon::setLocale('ar');
@endphp

<div class="container bootdey" >
<div class="col-md-12 bootstrap snippets">
           <div class="panel">
             <div class="panel-body">
               {!!  Form::open(['route' => 'subscriber.course.comments'  , "id" => "comments" , 'method' => 'POST' ]) !!}
               <input type="hidden"  name="lessonId" value="{{request()->route()->parameters['id']}}">
               <textarea class="form-control" rows="2" name="comments" placeholder="What are you thinking?"></textarea>
               <div class="mar-top clearfix">
                 <button class="btn btn-sm btn-primary pull-right" type="submit"><i class="fa fa-pencil fa-fw"></i> أضف تعليق</button>
                 {!! Form::close() !!}
               </div>
             </div>
           </div>
    <div class="panel">
        <div class="panel-body" >
        <!-- Newsfeed Content -->
        <!--===================================================-->
        @if(sizeof($thisLesson->comments) > 0)
        @foreach($thisLesson->comments as $item)
    
        <div class="media-block">
          @if(!empty($item->user->avatar))
               <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="{{$item->user->avatar}}"></a>
         @else
               @if($item->user->gender === 1)
          
               <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="{{asset('site/assets/images/avatar04.png')}}"></a>
               @else
               <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="{{asset('site/assets/images/avatar3.png')}}"></a>
    
               @endif
          @endif
          <div class="media-body">
            <div class="mar-btm">
            
              <p class="text-muted text-sm"><i class="glyphicon glyphicon-pencil"></i> - {{$item->user->username}} - {{$item->created_at->diffForHumans()}}</p>
            </div>
            <p>{{$item->comments}}</p>
            <div class="pad-ver">
              <a class="btn btn-sm btn-default btn-primary" onclick="reply('comment-master-reply-{{$item->id}}')" >رد</a>
              @if($item->student_id === auth()->user()->id)
              <a class="btn btn-sm btn-default btn-primary" onclick="reply('comment-master-edit-{{$item->id}}')" >تعديل</a>
              <a class="btn btn-sm btn-default btn-primary" style="background-color: red"  href="{{route('subscriber.course.comments.delete' , Crypt::encrypt($item->id) )}}" >حذف</a>
              @endif
              
              @if(sizeof($item->replies) > 0)
              <a class="btn btn-sm btn-default btn-primary" onclick="reply('show-rply-{{$item->id}}')" >العرض الردود</a>
              @endif
    
           
                <div class="panel-body"  id="comment-master-reply-{{$item->id}}"  style="display: none;">
                  {!!  Form::open(['route' => 'subscriber.course.reply'  , "id" => "rempy-{{$item->id}}" , 'method' => 'POST' ]) !!}
                  <input type="hidden"  name="commentId" value="{{Crypt::encrypt($item->id)}}">
                  <textarea class="form-control" rows="2" name="comment_reply" placeholder="What are you thinking?"></textarea>
                  <div class="mar-top clearfix">
                    <button class="btn btn-sm btn-primary pull-right" type="submit"><i class="fa fa-pencil fa-fw"></i> اضف رد</button>
                  
                  </div>
                  {!! Form::close() !!}
    
                  
                </div>
    
                <div class="panel-body"  id="comment-master-edit-{{$item->id}}"  style="display: none;">
                  {!!  Form::open(['route' => 'subscriber.course.comments.edit'  , "id" => "edit-{{$item->id}}" , 'method' => 'put' ]) !!}
                  <input type="hidden"  name="editCommentId" value="{{Crypt::encrypt($item->id)}}">
    
                  <textarea class="form-control" rows="2" name="edit_comment" placeholder="What are you thinking?"></textarea>
                  <div class="mar-top clearfix">
                    <button class="btn btn-sm btn-primary pull-right" type="submit"><i class="fa fa-pencil fa-fw"></i> تعديل تعليقك </button>
                  
                  </div>
                  {!! Form::close() !!}
               </div>
      
            </div>
            <hr>
    
            <!-- Comments -->
            <div  id="show-rply-{{$item->id}}" style="display: none;" >
                @foreach ($item->replies as $reply)
                    
                
              <div class="media-block pad-all" style="margin-left: 50px">
               
                @if(!empty($reply->user->avatar))
                <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="{{$reply->user->avatar}}"></a>
          @else
                @if($reply->user->gender === 1)
           
                <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="{{asset('site/assets/images/avatar04.png')}}"></a>
                @else
                <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="{{asset('site/assets/images/avatar3.png')}}"></a>
     
                @endif
           @endif
                <div class="media-body">
                  <div class="mar-btm">
                   
                    <p class="text-muted text-sm"><i class="fa fa-globe fa-lg"></i> - {{$reply->user->username}} - {{$reply->created_at->diffForHumans()}}</p>
                  </div>
                  <p>{{$reply->reply_comments}}</p>
                  <div>
                    @if($reply->student_id == auth()->user()->id)
                    <div class="btn-group">
                      <a class="btn btn-sm btn-default btn-primary" style="background-color: red"   href="{{route('subscriber.course.reply.delete' , Crypt::encrypt($reply->id) )}}" >حذف</a>
                      <a class="btn btn-sm btn-default btn-primary" onclick="reply('comment-edit-{{$reply->id}}')" >تعديل</a>
                    </div>
                    @endif
                    <div class="panel-body"  id="comment-edit-{{$reply->id}}"  style="display: none;">
                      {!!  Form::open(['route' => 'subscriber.course.reply.edit'  , "id" => "edit-{{$reply->id}}" , 'method' => 'put' ]) !!}
                      <input type="hidden"  name="editReplyId" value="{{Crypt::encrypt($reply->id)}}">
        
                      <textarea class="form-control" rows="2" name="edit_reply" placeholder="What are you thinking?"></textarea>
                      <div class="mar-top clearfix">
                        <button class="btn btn-sm btn-primary pull-right" type="submit"><i class="fa fa-pencil fa-fw"></i> تعديل الرد </button>
                      
                      </div>
                      {!! Form::close() !!}
                   </div>
                  
                  </div>
                </div>
              </div>
              <hr>
              @endforeach
            </div>
            <br>
    
          </div>
         
      
    
    
         
        </div>
        <!--===================================================-->
        <!-- End Newsfeed Content -->
       @endforeach

       @else
       <div class="corse-comments col-xs-12">
         <div class="disqus-comments">
             <div class="empty-msg text-center animated shake">
                 <h1>
                     <i class="fa fa-commenting-o"></i>
                     عفوا لا توجد تعليقات علي هذا الدرس  
                  </h1>
             </div>
         </div>
         <!-- end disqus-comments -->
       </div>
       
       @endif
       
      </div>
    </div>
  </div>
</div>
@endsection
    

@section('js_course')
<script src="{{asset('site/assets/js/video.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    var myPlayer = videojs("example_video_1");

    $('#show-l10').click(function () {
        $('#l10').show();
        $('#example_video_1').hide();
        myPlayer.pause();
    });
</script>

@endsection