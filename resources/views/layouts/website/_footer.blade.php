
<footer class="container pt-5 px-lg-0 px-5">

    <div class="d-flex justify-content-between align-items-center">
        <div class="" id="social-icons">
            <p class="contact-us-text" style="color: #667B83">@lang('site.social_media')</p>
            <div class="d-flex">
                <a><img src="{{ URL::asset('assets/website/images/facebook.png') }}" alt=""></a>
                <a><img src="{{ URL::asset('assets/website/images/instagram.png') }}" alt=""></a>
                <a><img src="{{ URL::asset('assets/website/images/twitter.png') }}" alt=""></a>
                <a><img src="{{ URL::asset('assets/website/images/linkedin.png') }}" alt=""></a>
            </div>
        </div>
        <div class="">
            <a href="#" class="btn btn-info btn-md arrow-up"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
        </div>
    </div>
    <div class="d-flex justify-content-center mb-5 mt-lg-0 mt-5">
        <div id="footer-links">
            @if (isset($guardName) && auth()->guard($guardName)->check())
            <a class="mx-1" href="{{ route('dashboard') }}">@lang('site.personal_account')</a>
            @else
            <a class="mx-1" href="{{ route('patient.login') }}">@lang('site.login')</a>
            @endif
            {{-- <a class="mx-2" href="">اتصل بنا</a>
            <a class="mx-2" href="">الدعم و المساعدة</a> --}}
            <a class="mx-1" href="#about-us-link">@lang('site.about_us')</a>
        </div>
    </div>
    <div class="d-flex justify-content-center text-center">
        <span><img src="{{ URL::asset('assets/website/images/favicon.png')}}" alt="" width="25"></span>
        <p class="mx-2 ">@lang('site.footer_text')</p>
    </div>

</footer>
