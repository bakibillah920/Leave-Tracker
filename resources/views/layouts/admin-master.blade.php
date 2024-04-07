@include('partials.header')
@include('partials.top-navbar')
<div class="inner-wrapper">
@include('partials.side-navbar')
        <section role="main" class="content-body" id="replaceContent">
                @yield('content')
        </section>
</div>
@include('partials.footer')   
