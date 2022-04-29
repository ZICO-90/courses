<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">

            <!-- Main -->
            <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
            <li class="active"><a href="index.html"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
            <li>
                <a href="#"><i class="icon-stack2"></i> <span>المدرب</span></a>
                <ul>
                    <li><a href="{{route('dashboard.instructor.show')}}">عرض المدربين</a></li>
                    
                </ul>
            </li>
        
        
            <li>
                <a href="#"><i class="icon-stack"></i> <span>الدورات</span></a>
                <ul>
                    <li><a href="{{route('dashboard.test.show')}}">عرض الاختبارات</a></li>
                    <li><a href="{{route('dashboard.course.show')}}">عرض الدورات</a></li>
                   
                   
                </ul>
            </li>


        </ul>
    </div>
</div>