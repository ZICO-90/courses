
@extends('sites.layout-site')
@section('title')
الاهتمامات
@endsection

@section('css')
    <style>
        @media print {
            footer {
                display: none;
            }
        }
    </style>
@endsection
@section('contacts')

<div class="up-box">
    <div class="container">
        <div class="up-form certf-container" >
        

            <button type="button" class="btn btn-primary btn-lg btn-block" id="print_Button" onclick="printDiv()">طباعه</button>
            

            <button type="button" class="btn btn-secondary btn-lg btn-block" onclick="window.location.href='{{route('profile.course.print.certif.snappyBdf' , request()->route()->parameters['id'] )}}'">إطبع</button>
            
            <button type="button" class="btn btn-secondary btn-lg btn-block" onclick="window.location.href='{{route('profile.course.print.certif.snappyBdf.test' , request()->route()->parameters['id'] )}}'">test print</button>

        </div>
    
    


    </div>

    </div>
</div>

    <div class="up-box" >
        <div class="container" id="CertifPrint">
         
       
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
            
            <!-- /.up-form -->
        </div>
        <!-- /.container -->
    </div>
  
             
    @endsection

    @section('js_course')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('site/assets/js/chart.js/Chart.bundle.min.js') }}"></script>

   
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('CertifPrint').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

@endsection