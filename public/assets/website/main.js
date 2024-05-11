$(function () {
    const loader = document.querySelector(".loader-wrapper");
    const content = document.querySelector(".content");

    // Hide loader and show content
    loader.style.display = "none";
    content.style.display = "block";

    /***************************************************** */

    new Typed("#favicon-text", {
        strings: ["معا في الصحة, متصلون من اجل الحياة"],
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
