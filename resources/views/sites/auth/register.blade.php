@extends('sites.layout-site')

@section('title')
يرجي تسجيل حساب جديد
@endsection

@section('contacts')
<div class="up-box">
    @include('sites.includes.alerts.errors')
    @include('sites.includes.alerts.success')
    <div class="container">
        <div class="up-form">
            
            <form action="{{route('register.store')}}" method="POST">
                @csrf
                @include('sites.collective-html.register-form-Fields')
                <div class="up_form-item up-confirm">
                    <input type="submit" value="تسجيل">
                </div>
                <!-- /.up_form-item -->
            </form>

        </div>
        <!-- /.up-form -->
    </div>
    <!-- /.container -->
</div>


<div class="panel-pop modal" id="teacher-modal" >
    <div class="lost-inner">
        <h1>
            <i class="fa fa-cube"></i> تعرف علي سياسة الخصوصية كمدرب
        </h1>
        <div class="lost-item">
            <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال "lorem ipsum" في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.
            </p>
        </div>
        <!-- /.lost-item -->

    </div>
    <!-- /.lost-inner -->
</div>
<!-- /.modal -->
@endsection