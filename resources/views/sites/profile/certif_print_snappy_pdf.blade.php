
<!DOCTYPE html>
<html lang="en">
<head>
    
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ public_path('site/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ public_path('site/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

</head>
<body>
   
        <div class="container">
            <div class="up-form certf-container" style="border-left: 0 ;border-right:0">
                
                <div class="certficat-box text-center" id="Certification">
                    <span>كود : {{$data['code']}}</span>
                    <span>تمنح الي الطالب</span>
                    <h2>{{$data['name_student']}}</h2>
                    <h4>لإجتيازه اختبار </h4>
                    <p>{{$data['title_course']}}</p>

                    <div class="admin-log">
                        <div class="cer-date">
                            تاريخ
                        </div>
                        <div class="date">
                            {{$data['date']}}
                        </div>
                    </div>
                    <div class="admin-log1">
                        <div class="cer-date">
                            توقيع
                        </div>
                        <div class="date">
                            {{$data['name_instructor']}}
                        </div>
                    </div>

                </div>
                <!-- end certificate-box -->
            </div>
            <!-- /.up-form -->
        </div>
        <!-- /.container -->
    </div>
</body>
</html>
 
