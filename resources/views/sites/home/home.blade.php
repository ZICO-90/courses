@extends('sites.layout-site')


@section('title')
    
@endsection


@section('contacts')

<div class="search-box">
    <div class="container">
        <div class="search-inner">
            <h1 class="text-center">تستطيع من خلال موقعنا البحث  عن كل ما تريد من كورسات </h1>
            <form action="#" method="get">
                <div class="form-item col-xs-12">
                    <div class="input-container col-md-10 col-xs-12 input-lft pull-right">
                        <input type="text" placeholder="ابحث عن جميع الكورسات من هنا">
                    </div>
                    <!-- /.input-container -->
                    <div class="btn-container col-md-1 btn-right">
                        <a class="show-advanced">
                    بحث متقدم
                </a>
                    </div>
                    <!-- end btn-container -->
                    <div class="btn-container col-md-1">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <!-- end btn-container -->
                </div>
                <!-- /.form-item -->
                <div class="form-advanced col-xs-12 adv-left">
                    <div class="advanced-item col-md-3 col-xs-12 pull-right">
                        <h2>ابحث بسعر الكورس</h2>
                        <input type="text" placeholder="ابحث بإسم المدرس">
                    </div>
                    <!-- /.advanced-item -->
                    <div class="advanced-item col-md-3 col-xs-12 pull-right">
                        <h2>ابحث بسعر الكورس</h2>
                        <input type="text" placeholder="ابحث بإسم الكورس">
                    </div>
                    <!-- /.advanced-item -->
                    <div class="advanced-item col-md-3 col-xs-12 pull-right">
                        <h2>ابحث بسعر الكورس</h2>
                        <input type="text" placeholder="ابحث بنوع الكورس">
                    </div>
                    <!-- /.advanced-item -->
                    <div class="advanced-item col-md-3 col-xs-12 adv-right pull-right">
                        <h2>ابحث بسعر الكورس</h2>

                        <input placeholder="من" type="number" class="pull-right price-from" data-toggle="tooltip" data-placement="top" title="مـن">
                        <input placeholder="إلي" type="number" class="price-to" data-toggle="tooltip" data-placement="top" title="إلـي">
                        <div class="text-right price-spec">
                            <label id="ko">
                                <input type="checkbox" class="price-free"> مجاني
                            </label>
                        </div>
                    </div>
                    <!-- /.advanced-item -->
                </div>
                <!-- /.form-advanced -->
            </form>
        </div>
        <!-- /.search-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.search-box -->

@include('sites.home.includes.container')
@include('sites.home.includes.testominal')

@endsection