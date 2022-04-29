



@extends('dashboardAdmins.layout_admin')

@section('title')
عرض اختبار الطالب
@endsection
@section('css')
@endsection
@section('contents')
<div class="panel panel-flat">
    <div class="panel-heading">
        
        <h5 class="panel-title"> اختبار الطالب : {{$studentTest->student->full_name }}<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <h5 class="panel-title">الدورة : {{$studentTest->course->title }}<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
       محلوظه : لكل سؤال اجابة واحده فقط صحيحه 
      </div>

    <div class="table-responsive">
        <table class="table">
            <tbody>
                @foreach ($question as $item)
                    
              
                <tr>
                    <th class="text-center" style="background: lightgray; font-size: large;" colspan="3">{{$item->question}}</th>
                   
                </tr>
                <tr style="font-size: large;">
                    <th>الاختيارات</th>
                    <th>خطأ / صحيحة</th>
                    <th>اختيارات الطالب</th>
                   
                </tr>
                @foreach ($item->QuestionAnswers as $answer)
                <tr style="{{$studentTest->details_answer[$item->id] == $answer->id ? $answer->true_false === 0 ? 'background: #F1948A' : 'background: #DAF7A6' : '' }}">
                    <td>{{$answer->answer}}</td>
                    <td>
                        @if ($answer->true_false === 0)
                        خطأ
                        @else
                        صحيحة
                        @endif
                      
                    </td>
               
                    <td>
                        @if($studentTest->details_answer[$item->id] == $answer->id)
                           @if($answer->true_false === 0)
                           <li>{{$answer->answer}}</li>
                           <li>اجابة خاطئة</li>
                           @else
                           <li>{{$answer->answer}}</li>
                           <li>اجابة صحيحة</li>
                           @endif
                        @else
                        ---------------------
                        @endif
                    </td>
                   
                </tr>
                @endforeach

                @endforeach
               
            </tbody>
            <br>
            <br>
                <tr style="background: #212F3D ; color: #52BE80; font-size: large;">
                    <th colspan="2">عدد الاجابات الصحيحه</th>
                    <td>{{$studentTest->true}}</td>
                   
                </tr>
                <tr style="background: #212F3D ; color: #C0392B ; font-size: large;">
                    <th colspan="2">عدد الاجابات الخاطئة</th>
                    <td>{{$studentTest->false}}</td>
                </tr>

                <tr style="background: #2980B9 ; color: #212F3D  ; font-size: large;">
                    <th colspan="2">عدد الاسئله</th>
                    <td>{{$studentTest->question}}</td>
                </tr>
        </table>


        <div class="datatable-footer"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 10 of 15 entries</div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" id="DataTables_Table_0_previous">→</a><span><a class="paginate_button current" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">1</a><a class="paginate_button " aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0">2</a></span><a class="paginate_button next" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" id="DataTables_Table_0_next">←</a></div></div>


    </div>
</div>
@endsection