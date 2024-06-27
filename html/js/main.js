function PageFunction() {
    var self = this;
    var ww = wh = 0;
    this.init = function () {
        // let $grid = $('.gallery__grid');

        // $grid.isotope({
        //     // options
        //     itemSelector: '.gallery__item',
        //     originLeft: true,
        // });

        // $grid.imagesLoaded().done(function (instance) {
        //     setTimeout(() => {
        //         $grid.isotope('layout');
        //     }, 200);

        // });

        if (ww > 1140) {
            let container = $(".container-fluid").width();
            let l_side_space = (ww - (container - 15)) / 2;
            let wrap = ww - l_side_space;
            $(".wrapper-left").css("width", wrap);

            $(window).resize(function () {
                let container = $(".container-fluid").width();
                let l_side_space = (ww - (container - 15)) / 2;
                let wrap = ww - l_side_space;
                $(".wrapper-left").css("width", wrap);
            });
        }

        $(document).on("click", ".f__end .dropdown-menu .dropdown-item", function () {
            var that = $(this);
            var src = that.attr("data-src");
            var text = that.text();
            var content = "<img src='" + src + "' alt='' />" + text;

            $(".btn--flag").empty();
            $(".btn--flag").append(content);
        });

        $(document).on("mouseenter", ".h-menu__item--submenu", function () {
            $("body").addClass("menu-moto-hover");
        }).on("mouseleave", ".h-menu__item--submenu", function () {
            $("body").removeClass("menu-moto-hover");
        });

        $(document).on("click", ".h-menu__category > li", function () {
            var that = $(this);
            var href = $(this).attr("data-scroll");

            $(".h-menu__category > li").removeClass("active");
            that.addClass("active");

            $('.h-menu__wrapper').animate({
                scrollTop: $(href).position().top
            }, 500);

            $(".h-menu__section").removeClass("active");
            $(href).addClass("active");
        });

        $(".h-menu__wrapper .h-menu__section").each(function (i, v) {
            var that = $(this);
            var mark = $(".h-menu__section").eq(i).position().top;

            that.attr("data-pos", mark);
        });

        $(".navmenu-drawer__content .h__drawer-item").each(function (i, v) {
            var that = $(this);
            var mark = $(".h__drawer-item").eq(i).position().top;

            that.attr("data-pos", mark);
        });

        $(".navmenu-drawer__content").on("scroll", function () {
            var sc = $(this).scrollTop();
            $(".navmenu-drawer__content .h__drawer-item").each(function (i, v) {
                var that = $(this);
                var mark_point = parseInt(that.attr("data-pos"));
                var title = that.attr("data-title");
                console.log(title);
                if (sc >= mark_point) {
                    $(".change-title-js").html(title);
                }
            });
        });
        $(".h-menu__wrapper").on("scroll", function () {
            var sc = $(this).scrollTop();

            $(".h-menu__wrapper .h-menu__section").each(function (i, v) {
                var that = $(this);
                var mark_point = parseInt(that.attr("data-pos"));
                var title = that.attr("data-title");
                if (sc >= mark_point) {
                    $(".change-title-js").html(title);
                    $(".h-menu__category > li").removeClass("active");
                    $(".h-menu__category > li").eq(i).addClass("active");
                }
            });
        });

        $(window).on("scroll", function () {
            var sc = $(this).scrollTop();
            var navbar = $(".h-box").height();

            if (sc > navbar) {
                $(".h-box").addClass("normal");
            } else {
                $(".h-box").removeClass("normal");
            }
        });

        $(document).on('click', ".icon-menu", function () {
            var that = $(this);

            that.toggleClass("open");
            $("body").toggleClass("open-menu-bar");
            $("body").toggleClass("menu-moto-hover");
            $(".navmenu-drawer").removeClass("open");
        });

        $(document).on('click', ".open-menu-bikes", function () {
            var that = $(this);

            $(".navmenu-drawer").addClass("open");
        });

        $(document).on('click', ".back-drawer", function () {
            var that = $(this);

            $(".navmenu-drawer").removeClass("open");
        });

        $('.h-menu__category .tab-item').click(function () {
            var index = $(this).index();
            var item = $('.preview-modal .h-menu__section');

            item.removeClass('active');
            item.eq(index).addClass('active');
        });


        if ($('.banner.banner-full').length) {
            $(window).scroll(function () {
                if ($(window).scrollTop() > 150) {
                    $('.toolbar-nav').addClass('is-active');
                } else {
                    $('.toolbar-nav').removeClass('is-active');
                }
            });
        } else {
            $('.toolbar-nav').addClass('is-active');
        }

        $(window).scroll(function () {
            var header = $('.h-box'),
                item = $('.banner .navigator__breadcrumbs'),
                offset = item.height() + header.height();

            if ($(window).scrollTop() > offset) {
                item.addClass('fixed').css({ 'top': $('.h-box').height() });
            } else {
                item.removeClass('fixed').css({ 'top': '0' });
            }
        });
    };

    this.products = function () {
        // $('.toolbar-nav__4').css({ "display": "block" });
        if ($(".category-menu__moto").length > 0) {
            $nav_left = $(".category-menu__nav").offset().top - 100;

            $(document).on("click", ".category-menu__category > li", function () {
                var that = $(this);
                var href = $(this).attr("data-scroll");

                $(".category-menu__category > li").removeClass("active");
                that.addClass("active");

                $('html, body').animate({
                    scrollTop: $(href).offset().top - 100
                }, 500);

                $(".category-menu__section").removeClass("active");
                $(href).addClass("active");
            });

            $(".category-menu__wrapper .category-menu__section").each(function (i, v) {
                var that = $(this);
                var mark = $(".category-menu__section").eq(i).offset().top - 100;

                that.attr("data-pos", mark);
            });

            $(window).on("scroll", function () {
                var sc = $(this).scrollTop();
                if (sc >= $nav_left) {
                    $(".category-menu__nav-stick").addClass("sticky");
                } else {
                    $(".category-menu__nav-stick").removeClass("sticky");
                }

                $(".category-menu__wrapper .category-menu__section").each(function (i, v) {
                    var that = $(this);
                    var mark_point = parseInt(that.attr("data-pos"));
                    var title = that.attr("data-title");

                    if (sc >= mark_point) {
                        $(".category-change-title-js").html(title);
                        $(".category-menu__category > li").removeClass("active");
                        $(".category-menu__category > li").eq(i).addClass("active");
                    }
                });
            });
        }

        if ($(".click-next-section").length > 0) {
            $(document).on('click', ".click-next-section", function () {
                let that = $(this);
                let pos = that.attr("data-pos");

                $('html,body').animate({
                    scrollTop: $(pos).offset().top
                }, 500);
            });
        }

        $(document).on('click', ".product__color li", function () {
            let that = $(this);
            let color = that.attr("data-color");
            let price = that.attr("data-price");
            

            $(".product__color li").removeClass("active");
            that.addClass("active");

            $(".product .background-image").css("background-image", "url(" + color + ")");
            $("#price-bike").html(price);
        });

        $(document).on('click', ".product__color-mb li", function () {
            let that = $(this);
            let color = that.attr("data-img");
            let price = that.attr("data-price");

            $(".product__color-mb li").removeClass("active");
            that.addClass("active");

            $(".product .background-image--product-mb").css("background-image", "url(" + color + ")");
            $("#price-bike").html(price);
        });

        $(document).on('click', ".product__accordion-btn", function () {
            if (!$(this).hasClass('collapsed')) {
                $('.product__accordion-btn').addClass('collapsed');
                $('.product__accordion-content').removeClass('show');
                $(this).removeClass('collapsed');
                $(this).next().addClass('show');
                window.scrollTo({ top: $("#product__accordion").offset().top - 200, behavior: 'smooth' });
            }
        });

        var swiper = new Swiper('.product__featured .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 8,
            navigation: {
                nextEl: '.swiper-navi-product .swiper-button-next',
                prevEl: '.swiper-navi-product .swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'fraction',
            },
            on: {
                slideChangeTransitionEnd: function (e) {
                    let length = $(".product__featured .swiper-slide").length;
                    if (e.activeIndex == (length - 3)) {
                        $(".swiper-navi-product").addClass("active");
                    }
                },
            },
            breakpoints: {
                // when window width is >= 640px
                960: {
                    slidesPerView: 3,
                    spaceBetween: 8,
                    navigation: {
                        nextEl: '.top-slide .swiper-navi-product .swiper-button-next',
                        prevEl: '.top-slide .swiper-navi-product .swiper-button-prev',
                    },
                    pagination: {
                        el: '.top-slide .swiper-pagination',
                        type: 'fraction',
                    },
                }
            }
        });

        $(window).scroll(function () {
            if ($('.product__engine').length > 0) {
                if (($(window).scrollTop() + $('.product__engine').height() + 500) > $('.product__engine').offset().top) {
                    animateNumber();
                }
            }
        });
    }

    this.booking = function () {
        $(document).on('click', ".dropdown--selected .dropdown-item", function () {
            let that = $(this);
            let val = that.attr("data-val");

            that.closest(".dropdown--selected").find(".title").text(val);
        });
    }

    this.resizeWindow = function () {
        ww = $(window).width();
        wh = $(window).height();
        $(window).resize(function () {
            var w_that = $(this);
            ww = w_that.width();
            wh = w_that.height();
        });
    };

    this.resizeWindow();
}

var PageFunction = new PageFunction();

$(document).ready(function () {
    PageFunction.init();
});

function animateNumber() {
    $('.animate-number').each(function () {
        $(this).prop('Counter',-1).animate({
            Counter: $(this).attr('data-number')
        }, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
}

//----- Active navigation menu ----
// const limitLoop = 5
// function getParent(elem, className, count = 0) {
//     let parentElem

//     if (elem && count < limitLoop) {
//         if (elem.parentElement.classList.contains(className)) {
//             parentElem = elem.parentElement
//         } else {
//             parentElem = getParent(elem.parentElement, className, count + 1)
//         }
//     }

//     return parentElem
// }

// document.querySelectorAll(".h-menu a.link").forEach(a => {
//     if (a.href == window.location.href) {
//         if (a.parentElement.nodeName == "H6") {
//             // root menu
//             let navItem = getParent(a, "h-menu__item")
//             navItem.classList.add("active")
//         } else {
//             // sub menu
//             let navItem = getParent(a, "h-menu__item")
//             navItem.classList.add("active")
//         }
//     }
// })