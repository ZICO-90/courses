<div class="search-categories text-center">
    <div class="container">
        <div class="cat-item">
            
            <div class="cat-inner col-md-6 col-sm-6 col-xs-6 pull-right">
                <a href="#" class="show-cat">البحث السريع عن الدورات<i class="fa fa-caret-down"></i></a>
                <div class="hidden-cat">
                    <ul>
                        <li>
                            <a href="{{route('courses.allCourse')}}"> عرض جميع الدورات </a>
                        </li>
                    @foreach ($interest_list as $key => $item)
                    <li style="background-color: {{isset(request()->route()->parameters['id']) ? $key === Crypt::decrypt(request()->route()->parameters['id']) ? '#0c8142' : '' : '' }}">
                        <a  href="{{route('courses.search.ByIDinterests' , Crypt::encrypt($key) )}}">{{$item}}</a>
                    </li>
                    @endforeach

                       

                    </ul>
                </div>
            </div>
            

            <div class="cat-inner col-md-6 col-sm-6 col-xs-6 pull-left">

                {!!  Form::open(['route' => 'courses.search.interests'  , 'method' => 'GET' ]) !!}
                      <input type="search" name="search" id="search_input" placeholder="ابحث عن كورسات أخري">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
            
                {!! Form::close() !!}
              
            </div>
           
            <!-- /. cat-inner -->
            
        </div>

       
       
        
        <!-- /.cat-item -->
    </div>
    
    <!-- /.container -->
</div>