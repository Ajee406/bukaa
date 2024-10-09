(function ($) {
    "use strict";

    // $(".counter").countUp();
    var Medi = {
        init: function () {
            this.Basic.init();
        },

        Basic: {
            init: function () {
                this.Preloader();
                this.BackgroundImage();
                this.ImageGallery();
                this.UpcomingEvent();
                this.Countdown();
                this.PopupGallery();
                this.UpCount();
                this.DateRangePicker();
                this.Select();
            },
            Preloader: function () {
                $("#preloader-status").fadeOut();
                $("#preloader").delay(350).fadeOut("slow");
                $("body").delay(350);
            },
            BackgroundImage: function () {
                $("[data-background]").each(function () {
                    $(this).css(
                        "background-image",
                        "url(" + $(this).attr("data-background") + ")"
                    );
                });
            },
            ImageGallery: function () {
                var swiper = new Swiper(".imageGallery", {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 24,
                        },
                    },
                });
            },
            UpcomingEvent: function () {
                var swiper = new Swiper(".upcomingEvent", {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            },
            Countdown: function () {
                var countdown = (function () {
                    var timers = document.querySelectorAll(".event-duration");
                    if (timers.length === 0) return;

                    for (var i = 0; i < timers.length; i++) {
                        var date = timers[i].dataset.countdownDate;
                        timezz(timers[i], {
                            date: date, // add more options here
                        });
                    }
                })();
            },
            PopupGallery: function () {
                $(".galleryMain").each(function () {
                    $(this).magnificPopup({
                        delegate: "a",
                        type: "image",
                        showCloseBtn: true,
                        preloader: false,
                        gallery: {
                            enabled: true,
                        },
                        callbacks: {
                            elementParse: function (item) {
                                if (item.el[0].className == "video") {
                                    item.type = "iframe";
                                } else {
                                    item.type = "image";
                                }
                            },
                        },
                    });
                });
            },
            UpCount: function () {
                $(document).ready(function () {
                    $(".counter").countUp({
                        time: 2000,
                        delay: 10,
                    });
                });
            },
            DateRangePicker: function () {
                $(".date-picker").daterangepicker({
                    autoApply: true,
                    autoUpdateInput: false,
                    locale: {
                        format: "D-M-Y",
                    },
                });
                $(".date-picker").on("apply.daterangepicker", function (ev, picker) {
                    $(this).val(picker.startDate.format("MM-DD-YYYY") + ' - ' + picker.endDate.format('MM-DD-YYYY'));
                });
            },
            Select: function () {
                // when need select with search field
                // $(".sf-select").select2({
                //     dropdownCssClass: "sf-select-dropdown",
                //     selectionCssClass: "sf-select-section",
                //     // minimumResultsForSearch: -1,
                // });
                // when don't need search field but can't use in modal
                // $(".sf-select-two").select2({
                //     dropdownCssClass: "sf-select-dropdown",
                //     selectionCssClass: "sf-select-section",
                //     minimumResultsForSearch: -1,
                // });
                // when don't need search field and can use in modal
                $(".sf-select-without-search").niceSelect();
                // when need search in modal
                // $(".sf-select-modal").select2({
                //     dropdownCssClass: "sf-select-dropdown",
                //     selectionCssClass: "sf-select-section",
                //     dropdownParent: $(".modal"),
                // });
            },
        },
    };
    jQuery(document).ready(function () {
        Medi.init();
    });
})(jQuery);
