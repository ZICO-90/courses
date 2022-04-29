
<!DOCTYPE html>
<html lang="en">
<head>
    
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ public_path('site/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ public_path('site/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
   
    <script>
        function subst() {
            var vars = {};
            var query_strings_from_url = document.location.search.substring(1).split('&');
            for (var query_string in query_strings_from_url) {
                if (query_strings_from_url.hasOwnProperty(query_string)) {
                    var temp_var = query_strings_from_url[query_string].split('=', 2);
                    vars[temp_var[0]] = decodeURI(temp_var[1]);
                }
            }
            var css_selector_classes = ['page', 'frompage', 'topage', 'webpage', 'section', 'subsection', 'date', 'isodate', 'time', 'title', 'doctitle', 'sitepage', 'sitepages'];
            for (var css_class in css_selector_classes) {
                if (css_selector_classes.hasOwnProperty(css_class)) {
                    var element = document.getElementsByClassName(css_selector_classes[css_class]);
                    for (var j = 0; j < element.length; ++j) {
                        element[j].textContent = vars[css_selector_classes[css_class]];
                    }
                }
            }
        }
        </script>

</head>
<body style="border:0; margin: 0;" onload="subst()">
   
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
    {!!Html::script('public/site/assets/js/jquery-2.2.2.min.js') !!}
    
</body>
</html>
 
