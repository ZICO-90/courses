
@section('js')
<script>
    //  اختيار شهاده للكورس او عدم اختياره بحيث اقدر اجيب قيمه من الشيك بوكس لو هوا رقم واحد يبقي اختار شهاده  واقدر من خلاله اعطي قيود علي الشهاده 
  function myFunction() {
    var x = document.getElementById('show-advanced-home');
    console.log(x.checked);
    if (x.checked) {
      x.checked = false;
    } else {
      x.checked = true;
    }
  };
  </script>
@endsection
<div class="search-box">
    <div class="container">
        <div class="search-inner">
            <h1 class="text-center">تستطيع من خلال موقعنا البحث  عن كل ما تريد من كورسات </h1>
            {!!  Form::open(['route' => 'home.searsh'  , 'method' => 'GET' ]) !!}
                <div class="form-item col-xs-12">
                    <div class="input-container col-md-10 col-xs-12 input-lft pull-right">
                        <input type="text" name="searsh" id="search_input" placeholder="ابحث عن جميع الكورسات من هنا">
                    </div>
                    <!-- /.input-container -->
                    <div class="btn-container col-md-1 btn-right">
                        <a class="show-advanced"   onclick="myFunction()" >
                    بحث متقدم
                </a>
                {!! Form::checkbox('searsh_advanced' , null , null , ['id'=> "show-advanced-home" , 'style' => "display:none" ]) !!}
                
                    </div>
                    <!-- end btn-container -->
                    <div class="btn-container col-md-1">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <!-- end btn-container -->
                </div>
                <!-- /.form-item -->
                <div class="form-advanced col-xs-12 adv-left">
                    <div class="advanced-item col-md-3 col-xs-12 pull-right">
                        <h2>ابحث بإسم المدرس</h2>
                    

                        {!! Form::text('searsh_instructor' , null , ['placeholder' => "ابحث بإسم المدرس" ] ) !!}
                    </div>
                    <!-- /.advanced-item -->
                    <div class="advanced-item col-md-3 col-xs-12 pull-right">
                        <h2>ابحث بإسم الكورس</h2>
                        {!! Form::text('name_course' , null , ['placeholder' => "ابحث بإسم الكورس" ] ) !!}
                    </div>
                    <!-- /.advanced-item -->
                    <div class="advanced-item col-md-3 col-xs-12 pull-right">
                        <h2>ابحث بنوع الكورس</h2>
                        
                        {!! Form::text('type_course' , null , ['placeholder' => "ابحث بنوع الكورس"] ) !!}

                    </div>
                    <!-- /.advanced-item -->
                    <div class="advanced-item col-md-3 col-xs-12 adv-right pull-right">
                        <h2>ابحث بسعر الكورس</h2>

                      
                        {!! Form::number('price_form' , null , ['placeholder' => "من" , 'class' => "price-to" , 'data-toggle' => "tooltip" , 'data-placement' => "top" , 'title' => "" ,'data-original-title' => "مـن" ] ) !!}
                        {!! Form::number('price_to' , null , ['placeholder' => "إلـي" , 'class' => "price-to" , 'data-toggle' => "tooltip" , 'data-placement' => "top" , 'title' => "" ,'data-original-title' => "إلـي" ] ) !!}

                        <div class="text-right price-spec">
                            <label id="ko">
                                {!! Form::checkbox('free' , null  , null , ['class'=> "price-free"  ]) !!}
                               
                            </label>
                        </div>
                    </div>
                    <!-- /.advanced-item -->
                </div>
                <!-- /.form-advanced -->
                {!! Form::close() !!}
        </div>
        <!-- /.search-inner -->
    </div>
    <!-- /.container -->
</div>