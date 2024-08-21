!(function (t) {
  "use strict";
  function n() {
    for (
      var e = document
          .getElementById("topnav-menu-content")
          .getElementsByTagName("a"),
        t = 0,
        a = e.length;
      t < a;
      t++
    )
      "nav-item dropdown active" === e[t].parentElement.getAttribute("class") &&
        (e[t].parentElement.classList.remove("active"),
        e[t].nextElementSibling.classList.remove("show"));
  }
  function a(e) {
    1 == t("#light-mode-switch").prop("checked") && "light-mode-switch" === e
      ? (t("html").removeAttr("dir"),
        t("#dark-mode-switch").prop("checked", !1),
        t("#rtl-mode-switch").prop("checked", !1),
        t("#bootstrap-style").attr(
          "href",
          "/public/admin/assets/css/bootstrap.min.css"
        ),
        t("#app-style").attr("href", "/public/admin/assets/css/app.min.css"),
        document.body.setAttribute("data-bs-theme", "light"),
        "light" == document.body.getAttribute("data-bs-theme") &&
        "light" == document.body.getAttribute("data-topbar")
          ? (document.body.setAttribute("data-topbar", "light"),
            (topbarLight = !0))
          : "light" == document.body.getAttribute("data-bs-theme") &&
            "dark" == document.body.getAttribute("data-topbar")
          ? document.body.setAttribute("data-topbar", "dark")
          : document.body.setAttribute("data-topbar", "light"),
        sessionStorage.setItem("is_visited", "light-mode-switch"))
      : 1 == t("#dark-mode-switch").prop("checked") && "dark-mode-switch" === e
      ? (t("html").removeAttr("dir"),
        t("#light-mode-switch").prop("checked", !1),
        t("#rtl-mode-switch").prop("checked", !1),
        t("#bootstrap-style").attr(
          "href",
          "/public/admin/assets/css/bootstrap.min.css"
        ),
        t("#app-style").attr("href", "/public/admin/assets/css/app.min.css"),
        document.body.setAttribute("data-bs-theme", "dark"),
        document.body.setAttribute("data-topbar", "dark"),
        sessionStorage.setItem("is_visited", "dark-mode-switch"))
      : 1 == t("#rtl-mode-switch").prop("checked") &&
        "rtl-mode-switch" === e &&
        (t("#light-mode-switch").prop("checked", !1),
        t("#dark-mode-switch").prop("checked", !1),
        t("#bootstrap-style").attr(
          "href",
          "/public/admin/assets/css/bootstrap-rtl.min.css"
        ),
        t("#app-style").attr(
          "href",
          "/public/admin/assets/css/app-rtl.min.css"
        ),
        t("html").attr("dir", "rtl"),
        document.body.setAttribute("data-bs-theme", "light"),
        document.body.setAttribute("data-topbar", "light"),
        sessionStorage.setItem("is_visited", "rtl-mode-switch"));
  }
  function e() {
    document.webkitIsFullScreen ||
      document.mozFullScreen ||
      document.msFullscreenElement ||
      (console.log("pressed"), t("body").removeClass("fullscreen-enable"));
  }
  var s;
  t("#side-menu").metisMenu(),
    t("#vertical-menu-btn").on("click", function (e) {
      e.preventDefault(),
        t("body").toggleClass("sidebar-enable"),
        992 <= t(window).width()
          ? t("body").toggleClass("vertical-collpsed")
          : t("body").removeClass("vertical-collpsed");
    }),
    t("#sidebar-menu a").each(function () {
      var e = window.location.href.split(/[?#]/)[0];
      this.href == e &&
        (t(this).addClass("active"),
        t(this).parent().addClass("mm-active"),
        t(this).parent().parent().addClass("mm-show"),
        t(this).parent().parent().prev().addClass("mm-active"),
        t(this).parent().parent().parent().addClass("mm-active"),
        t(this).parent().parent().parent().parent().addClass("mm-show"),
        t(this)
          .parent()
          .parent()
          .parent()
          .parent()
          .parent()
          .addClass("mm-active"));
    }),
    t(".navbar-nav a").each(function () {
      var e = window.location.href.split(/[?#]/)[0];
      this.href == e &&
        (t(this).addClass("active"),
        t(this).parent().addClass("active"),
        t(this).parent().parent().addClass("active"),
        t(this).parent().parent().parent().addClass("active"),
        t(this).parent().parent().parent().parent().addClass("active"),
        t(this)
          .parent()
          .parent()
          .parent()
          .parent()
          .parent()
          .addClass("active"));
    }),
    t(document).ready(function () {
      var e;
      0 < t("#sidebar-menu").length &&
        0 < t("#sidebar-menu .mm-active .active").length &&
        300 < (e = t("#sidebar-menu .mm-active .active").offset().top) &&
        ((e -= 300),
        t(".vertical-menu .simplebar-content-wrapper").animate(
          { scrollTop: e },
          "slow"
        ));
    }),
    t('[data-bs-toggle="fullscreen"]').on("click", function (e) {
      e.preventDefault(),
        t("body").toggleClass("fullscreen-enable"),
        document.fullscreenElement ||
        document.mozFullScreenElement ||
        document.webkitFullscreenElement
          ? document.cancelFullScreen
            ? document.cancelFullScreen()
            : document.mozCancelFullScreen
            ? document.mozCancelFullScreen()
            : document.webkitCancelFullScreen &&
              document.webkitCancelFullScreen()
          : document.documentElement.requestFullscreen
          ? document.documentElement.requestFullscreen()
          : document.documentElement.mozRequestFullScreen
          ? document.documentElement.mozRequestFullScreen()
          : document.documentElement.webkitRequestFullscreen &&
            document.documentElement.webkitRequestFullscreen(
              Element.ALLOW_KEYBOARD_INPUT
            );
    }),
    document.addEventListener("fullscreenchange", e),
    document.addEventListener("webkitfullscreenchange", e),
    document.addEventListener("mozfullscreenchange", e),
    t(".right-bar-toggle").on("click", function (e) {
      t("body").toggleClass("right-bar-enabled");
    }),
    t(document).on("click", "body", function (e) {
      0 < t(e.target).closest(".right-bar-toggle, .right-bar").length ||
        t("body").removeClass("right-bar-enabled");
    }),
    (function () {
      if (document.getElementById("topnav-menu-content")) {
        for (
          var e = document
              .getElementById("topnav-menu-content")
              .getElementsByTagName("a"),
            t = 0,
            a = e.length;
          t < a;
          t++
        )
          e[t].onclick = function (e) {
            "#" === e.target.getAttribute("href") &&
              (e.target.parentElement.classList.toggle("active"),
              e.target.nextElementSibling.classList.toggle("show"));
          };
        window.addEventListener("resize", n);
      }
    })(),
    t(function () {
      t('[data-bs-toggle="tooltip"]').tooltip();
    }),
    t(function () {
      t('[data-bs-toggle="popover"]').popover();
    }),
    window.sessionStorage &&
      ((s = sessionStorage.getItem("is_visited"))
        ? (t(".right-bar input:checkbox").prop("checked", !1),
          t("#" + s).prop("checked", !0),
          a(s))
        : sessionStorage.setItem("is_visited", "light-mode-switch")),
    t("#light-mode-switch, #dark-mode-switch, #rtl-mode-switch").on(
      "change",
      function (e) {
        a(e.target.id),
          "light" == document.body.getAttribute("data-bs-theme") &&
            "light" == document.body.getAttribute("data-topbar") &&
            (topbarLight = !0),
          1 == topbarLight &&
            "light" == document.body.getAttribute("data-bs-theme") &&
            document.body.setAttribute("data-topbar", "light");
      }
    ),
    t(window).on("load", function () {
      t("#status").fadeOut(), t("#preloader").delay(350).fadeOut("slow");
    }),
    Waves.init();
})(jQuery);
