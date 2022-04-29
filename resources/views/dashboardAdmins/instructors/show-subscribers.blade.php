
@extends('dashboardAdmins.layout_admin')

@section('title')
عرض جميع المدريب
@endsection
@section('css')
@endsection
@section('contents')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> عرض جميع الطلاب  <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

   

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>اسم المتدرب</th>
                    <th>الجنس</th>
                    <th>رقم الهاتف</th>
                    <th>البريد الالكتروني</th>
                    <th>عنوان الدورة</th>
                    <th>حالة الدورة</th>
                   
                   </tr>
            </thead>
            <tbody>
                @foreach ($subscribers as $item)
                    
              
                <tr>
                    <td>{{$item->user_student->username}}</td>
                    <td>
                        @if($item->user_student->gender == 1)
                            ذكر
                        @else
                           انثي
                        @endif
                       
                    </td>
                    <td>{{$item->user_student->phone}}</td>
                    <td>{{$item->user_student->email}}</td>
                    <td>{{$item->user_studen_course->title}}</td>
                    <td>
                        @if($item->user_studen_course->is_activation === 1)
                        <span class="label label-success">
                         نشرت
                        </span>
                        @else
                        <span class="label label-danger">لم تنشر</span>
                        @endif
                    </td>

            
                </tr>
                @endforeach
            </tbody>
        </table>


        <div class="datatable-footer"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 10 of 15 entries</div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" id="DataTables_Table_0_previous">→</a><span><a class="paginate_button current" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">1</a><a class="paginate_button " aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0">2</a></span><a class="paginate_button next" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" id="DataTables_Table_0_next">←</a></div></div>


    </div>
</div>
@endsection