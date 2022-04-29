 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="utf-8">
    <title> العلوم العصرية للتدريب </title>
    <meta name="author" content="Amir Nageh">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
  
    @include('sites.includes.layouts.head-link')
  

    @yield('css')
    @yield('js')

{{--
    <script>
        //  اختيار شهاده للكورس او عدم اختياره بحيث اقدر اجيب قيمه من الشيك بوكس لو هوا رقم واحد يبقي اختار شهاده  واقدر من خلاله اعطي قيود علي الشهاده 
      function myFunction() {
        var x = document.getElementById('show-advanced-home');
       
        if (x.checked) {
          x.checked = false;
        } else {
          x.checked = true;
        }
        console.log(x.checked);
      };
      </script>
   --}}
 </head>
 <body>
     
   <!-- start the loading screen -->
 
   <div class="wrap">
    <div class="loading">
        <div class="bounceball"></div>
        <div class="text">NOW LOADING</div>
    </div>
</div>

    <!-- start the loading screen -->


    <div class="wrapper st-container" id="st-container">
        <!-- content push wrapper -->
        <div class="st-pusher">

            @include('sites.includes.layouts.header.nav-menu')

            <div class="st-content">
                <div class="dividers">
                    <a name="top" style="visibility:hidden">
                               
                    </a>
                    <span name="top" class="t1"></span>
                    <span class="t2"></span>
                    <span class="t3"></span>
                    <span class="t4"></span>
                    <span class="t5"></span>
                    <span class="t1"></span>
                    <span class="t2"></span>
                    <span class="t3"></span>
                    <span class="t4"></span>
                    <span class="t5"></span>
                </div>
                <!-- /.dividers -->

                <div id="st-trigger-effects" class="column">

                    <button data-effect="st-effect-8" class="st_show">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <header>
                  
                    
                
               
                    @include('sites.includes.auth.login_area')

                    <div class="header-nav">
                        <div class="container">

                                <!-- logo -->
                                @include('sites.includes.layouts.header.logo-nav')
                                <!-- /.logo -->

                         <!-- nav-user -->
                    @if(Auth::check())
                             
                             @include('sites.includes.layouts.header.user-nav')
                       
                     @else   
                          <div class="nav-left col-md-4 col-xs-12 pull-left">
                              <div class="user-controls">
                                  <ul>
                                      <li>
                                          <a href="#"   class="show-login">
                                              <i class="fa fa-user"></i> منطقة تسجيل الدخول
                                          </a>
                                      </li>
                                     
                                  </ul>
                              </div>                              
                          </div>

                    @endif
               <!-- /.nav-user --> 

                        </div>
                        <!-- /.container -->
                    </div>
                    <!-- /.header-nav -->
                </header>
                <!-- /header -->
                @if(url()->current() != url('/') )
                     <div class="up-container">
                         <div class="up-header text-center">
                             <div class="container">
                                 <h1> @yield('title')</h1>
                             </div>
                             <!-- /.container -->
                     </div>
                @endif
                @if( url()->current() == url('/')  || url()->current() == route('home.searsh') )
                     @include('sites.includes.layouts.searsh.home_page_searsh')
                     @include('sites.includes.layouts.home.home_contact_course')
                  
                @endif

              <!--contacts -->
              @yield('contacts')
              <!-- /. contacts -->

            @if(Request::is('profile*'))
          
                @include('sites.profile.partial_course')
            @endif
              @include('sites.includes.layouts.footer')
            </div>
            <!-- /st-content -->
         
        </div>
        <!-- /st-pusher -->
       
      
    </div>
    <!-- /.wrapper -->
    <div class="toTop col-xs-12 text-center">
        <i class="fa fa-angle-up"></i>
    </div>

    <!-- /.toTop -->





@include('sites.includes.layouts.Javascript')
@yield('js_course')

@if( url()->current() == url('/')  || url()->current() == route('home.searsh') )

<script type="text/javascript">
$('body').on('keyup' , '#search_input',function(){
    var texetQuery = $(this).val();
  
      
    $.ajax({
        method:'post',
        url: '{{route("search.ajax.home")}}',
        dataType:'json',
        data:{
            '_token': '{{csrf_token()}}' ,
            texetQuery : texetQuery 
        },
        success: function(res){

            console.log(res)
            var html = '';

            $('#row-course').html('');

            $.each(res,function(index,value){
                html = `
            
         <div class="block col-md-4 col-sm-6">
            <figure>
                <div><img src="/site/assets/images/event_1.jpg" alt="img05" class="img-responsive"></div>
                <figcaption class="text-right">
                    <h1>
                <label>اسم الكورس</label>
                <span>${value.title}</span>
            </h1>
                    <h1>
                <label>اسم المدرس</label>
                <span> ${value.coures_instructor.username}</span>
                
            </h1>
                    <h1>
                 <label>عدد الطلبة المشتركة</label>
                <span>${value.studen_course.length} </span>
                
            </h1>
                    <h1>
                <label>تاريخ بداية الكورس</label>
               
           
                <span id="datepicker" class="datepicker">
               ${ new Date(value.start_date).toLocaleDateString( 'ar-EG',  { day:"numeric", month:"short"})}


                </span>
                
            </h1>
                    <h1>
                <label>تقييم الكورس</label>
                <span>${value.degree}</span>
                
            </h1>
        
                    <a href="{{ URL::to('courses/intro/${value.encrypt_id_ajax}') }}">
                        <i class="fa fa-eye"></i> مشاهدة الكورس
                    </a>
                </figcaption>
            </figure>
        </div>
      
                
                `;
                $('#row-course').append(html );
            });
        }

    });

}); 



</script>
@endif
 </body>
 </html>