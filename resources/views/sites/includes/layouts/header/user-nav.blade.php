<div class="nav-left hidden-nav col-md-4 col-xs-12 pull-left">
    <div class="user-logged">
        <ul>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" class="hvr-underline-reveal">
                    <span class="cont-img">
                        @if(empty(auth()->user()->avatar))
                     
                        @if(auth()->user()->gender === 1)
                        <img src="{{asset('site/assets/images/avatar04.png')}}" width="35" height="35" alt="User-Img">
                        @else
                        <img src="{{asset('site/assets/images/avatar3.png')}}" width="35" height="35" alt="User-Img">
                        @endif
                    
                @else
                <img src="{{asset(auth()->user()->avatar)}}" width="35" height="35" alt="User-Img">
                @endif
            </span>
                    <b>{{auth()->user()->username}}</b>
                    <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                    <div class="drop drop-links col-xs-12">
                        <div class="drop-links">
                            <ul>
                                <li>
                                    <a href="{{route('profile.show.acounts' , Crypt::encrypt( auth()->user()->id) )}}">
                                        <i class="fa fa-user"></i>&nbsp; حسابي
                                    </a>
                                </li>
                                <li>
                                    <form action="{{route('login.logout')}}" method="POST">
                                        @csrf
                                        <a href="#" onclick='this.parentNode.submit(); return false';>
                                            <i class="fa fa-power-off"></i>&nbsp; خروج
                                        </a>
                                    </form>
                                   
                                </li>
                            </ul>
                        </div>
                        <!-- end drop-links -->
                    </div>
                    <!-- end drop -->
                </ul>
            </li>
         
            <li>
                <a href="#" class="show-notification" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell"></i>
                </a>
                <ul class="dropdown-menu notification-box" role="menu" aria-labelledby="dropdownMenu">
                    <div class="drop drop-links col-xs-12">
                        <ul>
                         
                            @foreach(auth()->user()->unreadnotifications as $notify)
                            @if($notify->type == "App\Notifications\SendStudentsInSubscribersCourseNotify")
                            <li>
                                <a href="{{route('profile.course.notify.Subscribers.show' , Crypt::encrypt( $notify->data['courseId'] ) )}}">
                                    @if(empty($notify->data['instructorImg']))
                                    <img src="/site/assets/images/avatar5.png" alt="" class="img-circle pull-right">
                                    @else
                                   
                                    <img src="{{asset($notify->data['instructorImg'])}}" alt="" class="img-circle pull-right">
                                    @endif
                                    <h4>
                                        {{$notify->data['instructorName']}}
                                        @php
                                            \Carbon\Carbon::setLocale('ar');
                                        @endphp
                                        <small><i class="fa fa-clock-o"></i>{{$notify->created_at->diffForHumans()}}</small>
                                    </h4>
                                    <p> {{$notify->data['title']}}</p>
                                </a>
                            </li>
                            @endif
                            @endforeach
                            
                   
                        </ul>
                    </div>
                    <!-- end drop -->
                </ul>
            </li>

        </ul>
    </div>
    <!-- /.user-controls -->
</div>
<!-- /.nav-user -->