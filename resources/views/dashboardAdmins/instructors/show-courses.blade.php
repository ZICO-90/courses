
@extends('dashboardAdmins.layout_admin')

@section('title')
دورات المدرب
@endsection
@section('css')
@endsection
@section('contents')
<div class="panel panel-body">
    <div class="content-group">
        @if(!empty($instructor->avatar))
        <a href="#"><img src="{{asset($instructor->avatar)}}" class="img-responsive img-rounded" alt=""></a>

        @else
                @if($instructor->gender === 1)
                <a href="#"><img src="{{asset('site/assets/images/avatar04.png')}}" class="img-responsive img-rounded" alt=""></a>
               
                @else
                <a href="#"><img src=" {{asset('site/assets/images/avatar3.png')}}" class="img-responsive img-rounded" alt=""></a>
               
                @endif

        @endif
    </div>

    <h5 class="text-semibold">السيرة الذاتية<small class="display-block"></small></h5>
    @if(!empty($instructor->biography))
        @if(!empty($instructor->biography->biography))
        <p class="content-group">{{$instructor->biography->biography}}</p>
        @endif

        @if(!empty($instructor->biography->biography_link))
        <a href="{{$instructor->biography->biography_link}}">ملف السيرة الذاتيه</a>
        @endif
    <hr>
    @else
    <p class="content-group">لا توجد سيرة ذاتيه</p>
    <hr>
    @endif
    <ul class="list content-group">
        <li><span class="text-semibold">الاسم : {{$instructor->full_name}} </span> </li>
        <li><span class="text-semibold">البريد الالكتروني : {{$instructor->email}} </span></li>
        <li><span class="text-semibold">الهاتف : {{$instructor->phone}}</span> </li>
        <li><span class="text-semibold">الجنس :  {{$instructor->gender === 1 ? 'ذكر' : 'انثي'}} </span></li>
        <li><span class="text-semibold">تاريخ الانضمام : {{ $instructor->created_at->format('Y-m-d')  }}</span></li>
        <li><span class="text-semibold">عدد سنين الانضمام : {{ $instructor->created_at->diffInYears(now())}}</span></li>
    </ul>

  
</div>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">  عرض دورات المدرب <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
      اسم المدرب : {{$instructor->full_name}}
    </div>
  @php
        
                                    $months = [
                                                'January' => "يناير" ,
                                                'February' => "فبراير",
                                                
                                                'March' => "مارس" ,
                                                'April' => "أبريل",
                                                
                                                'May' => "مايو" ,
                                                'June' => "يونيو",
                                                
                                                'July' => "يوليو" ,
                                                'August' => "أغسطس",
                                                
                                                'September' => "سبتمبر" ,
                                                'October' => "أكتوبر",
                                                
                                                'November' => "نوفمبر" ,
                                                'December' => "ديسمبر",
                                                
                                                
                                                ];
$gender = [
    '1' => 'ذكر' ,
    '2' => 'انثي' ,

];
                                        
  @endphp
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>العنوان</th>
                    <th>السعر</th>
                    <th>السماح بالاشتراك</th>
                    <th>عدد المشتركين</th>
                    <th>تاريخ البدأ</th>
                    <th>تاريخ الانتهاء</th>
                    <th>زمن البدأ</th>
                    <th>حالة الدورة</th>
                    <th class="text-center" style="width: 30px;"><i class="icon-menu-open2"></i></th>
                   </tr>
            </thead>
            <tbody>
                @foreach ($instructor->course_instructor as $item)
                    
              
                <tr>
                    <td>{{$item->title}}</td>
                    <td>
                        @if($item->case_payment_course === 1)
                        {{$item->course_price}}
                        @else
                        مجاني
                        @endif
                    
                    </td>
                    <td>
                        @for($i = 0 ; $i< sizeof( (array) $item->is_subscribe) ; $i++ )
                            <li>{{$gender [ $item->is_subscribe[$i] ]}}</li>
                        @endfor
                       
                       
                    </td>
                    <td>
                       
                      {{sizeof($item->studen_course)}}
                       
                    </td>
                    @php
                         $getSatrt_Date =  \Carbon\Carbon::parse(strtotime($item->start_date));
                         $getEnd_Date =  \Carbon\Carbon::parse(strtotime($item->end_date));
                    @endphp
                   
                    <td>
                       
                        {{$getSatrt_Date->format('d')  . "-" . $months[$getSatrt_Date->format('F')]  . "-" .   $getSatrt_Date->format('Y')  }}
                    </td>
                    <td>
                        {{$getEnd_Date->format('d')  . "-" . $months[$getEnd_Date->format('F')]  . "-" .   $getEnd_Date->format('Y')  }}
                    </td>
                    <td>
                        @if($getSatrt_Date->diffInWeeks($getEnd_Date) != 0)
                         {{$getSatrt_Date->diffInWeeks($getEnd_Date) }} اسبوع
                        @else
                        {{$getSatrt_Date->diffInDays($getEnd_Date) }} يوم 
                        @endif
                       
                    </td>
                    <td>
                        @if($item->is_activation === 1)
                        السماح بالنشر
                        @else
                        لم تنشر
                        @endif
                       
                    </td>

                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('dashboard.instructor.details' , $item->id )}}"><i class="icon-users4"></i> عرض الدورة</a></li>
                                    <li><a href="#"><i class="icon-user-cancel"></i> حذف الدورة</a></li>
                                    <li><a href="{{route('dashboard.instructor.subscribers' , $item->id)}}"><i class="icon-users4"></i> المشتركين بالدورة</a></li>

                                   
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