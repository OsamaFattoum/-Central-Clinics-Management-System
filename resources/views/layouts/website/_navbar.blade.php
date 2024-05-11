<!--Nav Bar -->
<nav class=" navbar sticky-top navbar-expand-lg  bg-white" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src="{{ URL::asset('assets/website/images/logo_ar.png') }}" alt="Logo" width="220" height="60"
                class="img-fluid">
        </a>
        <div class="d-flex align-items-center">
            <a href="" class="nav-link btn btn-outline-info btn-lang">
                <button type="button" class="btn btn-outline-info btn-lang"><span
                        class="fw-bold text-btn-lang">EN</span></button>
            </a>
            @if (isset($guardName) && auth()->guard($guardName)->check())
            <div class="dropdown custom-dropdown">
                <a href="#" data-toggle="dropdown" class="d-flex align-items-center dropdown-link text-left"
                    aria-haspopup="true" aria-expanded="false" data-offset="0, 20">
                    <div class="profile-pic mx-2">
                        <img src="{{URL::asset(auth()->guard($guardName)->user()->image_path)}}" alt="Image">
                    </div>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="{{ route('dashboard') }}" class="dropdown-item"><i class="fa fa-circle-user"></i><span class="mx-2">الملف الشخصي</span></a>
                    <a href="#" class="dropdown-item"><i class="fa fa-address-book"></i><span class="mx-2">اتصل بنا</span></a>
                    <a href="#" class="dropdown-item"><i class="fa fa-headset"></i><span class="mx-2">الدعم والمساعدة</span></a>
                    <a href="#" class="dropdown-item"
                        onclick="event.preventDefault();document.getElementById('logoutForm').submit()"
                        href="{{ route('logout') }}"><i class="fa fa-sign-out"></i><span class="mx-2">تسجيل
                            الخروج</span></a>
                    <form action="{{route('logout')}}" method="POST" id="logoutForm" style="display: none">
                        @csrf
                        <input type="hidden" name="guard" value="{{ $guardName }}">
                    </form>
                </div>
            </div>
            @endif





        </div>
</nav>
<!--Nav Bar End-->