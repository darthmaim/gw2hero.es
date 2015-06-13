@section('wrapper')
    <div class="wrapper" id="wrapper" role="main">
        <div class="content">
            @section('content')
                <div class="content__container clearfix">
                    <div class="content__left">@yield('content.left')</div>
                    <div class="content__right">@yield('content.right')</div>
                </div>
            @show
        </div>
    </div>
@show
