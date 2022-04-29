
@extends('dashboardAdmins.layout_admin')

@section('title')
عرض جميع المدريب
@endsection
@section('css')
@endsection
@section('contents')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> عرض جميع المدربين <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
                    <th>اسم المدرب</th>
                    <th>الجنس</th>
                    <th>رقم الهاتف</th>
                    <th>البريد الالكتروني</th>
                    <th>مدرب / طالب</th>
                    <th>اقاف / استمرار</th>
                    <th class="text-center" style="width: 30px;"><i class="icon-menu-open2"></i></th>
                   </tr>
            </thead>
            <tbody>
                @foreach ($instructor as $item)
                    
              
                <tr>
                    <td>{{$item->username}}</td>
                    <td>
                        @if($item->gender == 1)
                            ذكر
                        @else
                           انثي
                        @endif
                       
                    </td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->email}}</td>
                    <td>
                        @if($item->is_work == 3)
                       كلاهما
                       @else
                           مدرب
                       @endif
                    </td>
                    <td>
                        @if($item->is_stop === 0)
                        <span class="label label-success">
                           استمرار
                        </span>
                        @else
                        <span class="label label-danger">إقاف مؤقت</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">

                               
                                        <li><a href="{{route('dashboard.instructor.stop' , $item->id)}}"><i class="{{$item->is_stop === 0 ? 'icon-user-check' : 'icon-user-minus' }}"></i> استمرار / إقاف </a></li>
                                  
                               
                    
                                   
                                    <li><a href="{{route('dashboard.instructor.course' , $item->id)}}"><i class="icon-calendar3"></i> عرض الدورات</a></li>
                                    <li><a href="#"><i class="icon-user-cancel"></i> حذف المدرب</a></li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <div class="datatable-footer"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 10 of 15 entries</div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" id="DataTables_Table_0_previous">→</a><span><a class="paginate_button current" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">1</a><a class="paginate_button " aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0">2</a></span><a class="paginate_button next" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" id="DataTables_Table_0_next">←</a></div></div>


    </div>
</div>
@endsection