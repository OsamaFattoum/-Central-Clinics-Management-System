<!-- JQuery min js -->
<script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/ionicons/ionicons.js')}}"></script>

<!-- Eva-icons js -->
<script src="{{URL::asset('assets/js/eva-icons.min.js')}}"></script>


@yield('js')

<!-- Animate package js -->
<script src="https://unpkg.com/scrollreveal"></script>
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>


<script>
        $(function () {
    const loader = document.querySelector(".loader-wrapper");
    const content = document.querySelector(".content");

    // Hide loader and show content
    loader.style.display = "none";
    content.style.display = "block";

    /***************************************************** */

    new Typed("#favicon-text", {
        strings: ["{{__('site.title_header')}}"],
        typeSpeed: 25,
        rtl: true,
        cursorChar: "",
    });

    /***************************************************** */

    ScrollReveal({ reset: true, distance: "80px", duration: 2000, delay: 100 });
    ScrollReveal().reveal(
        "#banner,.about-us-text,.feature-one-text,.feature-two-text,.feature-three-text,footer",
        { origin: "top" }
    );
    ScrollReveal().reveal(
        ".about-us-image,.feature-one-image,.feature-two-image,.feature-three-image",
        { origin: "bottom" }
    );

    /***************************************************** */

    $(".custom-dropdown").on("show.bs.dropdown", function () {
        var that = $(this);
        setTimeout(function () {
            that.find(".dropdown-menu").addClass("active");
        }, 100);
    });
    $(".custom-dropdown").on("hide.bs.dropdown", function () {
        $(this).find(".dropdown-menu").removeClass("active");
    });
});

</script>

