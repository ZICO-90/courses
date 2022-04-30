
@extends('sites.layout-site')

@section('title')
معلومات عن الموقع
@endsection

@section('contacts')
<div class="profile-content empty-course">
     <div class="container">
                   
        <div class="up-box about-box">
            <div class="container">
                <div class="about-img col-md-4 col-xs-12 pull-left">
                    <img src="{{asset($about->url_img)}}" class="img-responsive" alt="">
                </div>
                <!-- end about-img -->
                <div class="about-data col-md-8 col-xs-12 pull-right text-right">
                    <p>
                        {{$about->body}}

                    </p>
                </div>
                <!-- end about-data -->
            </div>
            <!-- /.container -->
        </div>
                
     </div>
</div>

@endsection