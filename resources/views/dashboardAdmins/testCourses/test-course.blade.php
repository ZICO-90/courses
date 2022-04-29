
@extends('dashboardAdmins.layout_admin')

@section('title')
عرض جميع المدريب
@endsection
@section('css')
@endsection
@section('contents')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> عرض الاختبارات <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <h5 class="panel-title"> ملحوظات <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
 
      
        <li> لكل سؤال اجابة واحده فقط صحيحه </li>
        <li>طلبات الشهاده  هي التي عدي عليها اسبوعان</li>
      
  
      </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>اسم الدورة</th>
                    <th>اسم الطالب</th>
                    <th>اجابات صحيحه</th>
                    <th>اجابات خاطئه</th>
                    <th>عدد الاسئله</th>
                    <th>طلبات الشهاده</th>
                    <th>استلم الشهاده</th>
                    <th>حالة طباعه الشهاده</th>
                    <th class="text-center" style="width: 30px;"><i class="icon-menu-open2"></i></th>
                   </tr>
            </thead>
            <tbody>
                @foreach ($test as $item)
                    
              
                <tr>
                    <td>{{$item->course->title}}</td>
                    <td>
                      
                        {{$item->student->username}}
                    </td>
                    <td>{{$item->true}}</td>
                    <td>{{$item->false}}</td>
                    <td>
                        {{$item->question}}
                    </td>
                   

                    <td>
                        @if($item->certif_request === 0)
                        <span class="label label-danger">
                            لم يطلب
                          
                        </span>
                        @else
                        <span class="label label-success">طلب  </span>
                        @endif
                    </td>
                    <td>
                        @if($item->certif_receive === 0)
                        <span class="label label-danger">
                          
                         لم يستلم
                        </span>
                        @else
                        <span class="label label-success"> استلم </span>
                        @endif
                    </td>
                    <td>
                        @if($item->allow_print === 0)
                        <span class="label label-danger">
                          
                           إقاف الطبع
                        </span>
                        @else
                        <span class="label label-success"> إطبع</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">

                               
                                        <li><a href="{{route('dashboard.test.finished.print' , $item->id)}}"><i class="{{$item->allow_print === 0 ? 'icon-lock2' : 'icon-unlocked' }}"></i>{{$item->allow_print === 0 ? 'إطبع' : 'إقاف'}}</a></li>
                                  
                               
                    
                            
                                    <li><a href="{{route('dashboard.test.finished.student' ,[$item->student_id  , $item->cource_id ] )}}"><i class="icon-calendar3"></i>عرض الاختبار</a></li>
                                   
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