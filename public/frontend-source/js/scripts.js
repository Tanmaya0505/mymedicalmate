"use scrict";

$(document).ready(function () {
    preloaderFadeOutTime = 500;
    function hidePreloader() {
        var preloader = $('.load-container');
        preloader.fadeOut(preloaderFadeOutTime);
    }
    hidePreloader();
    
    /*
     * @purpose : Mobile menu toggle
     * @author : Trideep Dakua
     * @email  : <trideepdakua@gmail.com>
     */
    $('.hamburger').on('click', function () {
        $(this).toggleClass('clicked');
        $(this)
            .next('.popup-shadow').toggleClass('active')
            .next('.pop-out-menu').toggleClass('open');
        $('body').toggleClass('scroll-off');
    });

    $('.modify-search').on('click', function () {
        $('.filter.stickey').toggleClass('open');
    });
    
    /*
     * End Trideep script
     */
});

/**
 * Slider js
 */
var slideshowDuration = 4000;
var slideshow = $('.main-content .slideshow');
function toggleAwardSection() {
    var newAward = document.getElementById("newAward");
    var awardToggleIcon = document.getElementById("awardToggleIcon");
    if (newAward.classList.contains("hidden")) {
      newAward.classList.remove("hidden");
      awardToggleIcon.classList.remove("fa-angle-down");
      awardToggleIcon.classList.add("fa-angle-up");
    } else {
      newAward.classList.add("hidden");
      awardToggleIcon.classList.remove("fa-angle-up");
      awardToggleIcon.classList.add("fa-angle-down");
    }
  }
  function toggleSection() {
    var content = document.getElementById("content");
    var toggleIcon = document.getElementById("toggleIcon");
    var newQual = document.getElementById("newQual");
    if (content.classList.contains("hidden")) {
      content.classList.remove("hidden");
      toggleIcon.classList.remove("fa-angle-down");
      toggleIcon.classList.add("fa-angle-up");
      newQual.classList.remove("hidden");
    } else {
      content.classList.add("hidden");
      toggleIcon.classList.remove("fa-angle-up");
      toggleIcon.classList.add("fa-angle-down");
      newQual.classList.add("hidden");
    }
  }
  //popup section start
    function openPopup() {
        var popup = document.getElementById("popup");
        popup.style.visibility = "visible";
    }

    function closePopup() {
        var popup = document.getElementById("popup");
        popup.style.visibility = "hidden";
    }
    function openPopup1() {
        var popup = document.getElementById("popup1");
        popup.style.visibility = "visible";
    }

    function closePopup1() {
        var popup = document.getElementById("popup1");
        popup.style.visibility = "hidden";
    }
    function openComment() {
        var div = document.getElementById("myComment");
        div.style.display = "block";
      }
function openSubmitButton() {
  var submitButton = document.getElementById("submitButton");
  submitButton.style.display = "inline-block";
}
//popup section end

function slideshowSwitch(slideshow, index, auto) {
    if (slideshow.data('wait'))
        return;

    var slides = slideshow.find('.slide');
    var pages = slideshow.find('.pagination');
    var activeSlide = slides.filter('.is-active');
    var activeSlideImage = activeSlide.find('.image-container');
    var newSlide = slides.eq(index);
    var newSlideImage = newSlide.find('.image-container');
    var newSlideContent = newSlide.find('.slide-content');
    var newSlideElements = newSlide.find('.caption > *');
    if (newSlide.is(activeSlide))
        return;

    newSlide.addClass('is-new');
    var timeout = slideshow.data('timeout');
    clearTimeout(timeout);
    slideshow.data('wait', true);
    var transition = slideshow.attr('data-transition');
    if (transition == 'fade') {
        newSlide.css({
            display: 'block',
            zIndex: 2
        });
        newSlideImage.css({
            opacity: 0
        });

        TweenMax.to(newSlideImage, 1, {
            alpha: 1,
            onComplete: function () {
                newSlide.addClass('is-active').removeClass('is-new');
                activeSlide.removeClass('is-active');
                newSlide.css({display: '', zIndex: ''});
                newSlideImage.css({opacity: ''});
                slideshow.find('.pagination').trigger('check');
                slideshow.data('wait', false);
                if (auto) {
                    timeout = setTimeout(function () {
                        slideshowNext(slideshow, false, true);
                    }, slideshowDuration);
                    slideshow.data('timeout', timeout);
                }
            }});
    } else {
        if (newSlide.index() > activeSlide.index()) {
            var newSlideRight = 0;
            var newSlideLeft = 'auto';
            var newSlideImageRight = -slideshow.width() / 8;
            var newSlideImageLeft = 'auto';
            var newSlideImageToRight = 0;
            var newSlideImageToLeft = 'auto';
            var newSlideContentLeft = 'auto';
            var newSlideContentRight = 0;
            var activeSlideImageLeft = -slideshow.width() / 4;
        } else {
            var newSlideRight = '';
            var newSlideLeft = 0;
            var newSlideImageRight = 'auto';
            var newSlideImageLeft = -slideshow.width() / 8;
            var newSlideImageToRight = '';
            var newSlideImageToLeft = 0;
            var newSlideContentLeft = 0;
            var newSlideContentRight = 'auto';
            var activeSlideImageLeft = slideshow.width() / 4;
        }

        newSlide.css({
            display: 'block',
            width: 0,
            right: newSlideRight,
            left: newSlideLeft
            , zIndex: 2
        });

        newSlideImage.css({
            width: slideshow.width(),
            right: newSlideImageRight,
            left: newSlideImageLeft
        });

        newSlideContent.css({
            width: slideshow.width(),
            left: newSlideContentLeft,
            right: newSlideContentRight
        });

        activeSlideImage.css({
            left: 0
        });

        TweenMax.set(newSlideElements, {y: 20, force3D: true});
        TweenMax.to(activeSlideImage, 1, {
            left: activeSlideImageLeft,
            ease: Power3.easeInOut
        });

        TweenMax.to(newSlide, 1, {
            width: slideshow.width(),
            ease: Power3.easeInOut
        });

        TweenMax.to(newSlideImage, 1, {
            right: newSlideImageToRight,
            left: newSlideImageToLeft,
            ease: Power3.easeInOut
        });

        TweenMax.staggerFromTo(newSlideElements, 0.8, {alpha: 0, y: 60}, {alpha: 1, y: 0, ease: Power3.easeOut, force3D: true, delay: 0.6}, 0.1, function () {
            newSlide.addClass('is-active').removeClass('is-new');
            activeSlide.removeClass('is-active');
            newSlide.css({
                display: '',
                width: '',
                left: '',
                zIndex: ''
            });

            newSlideImage.css({
                width: '',
                right: '',
                left: ''
            });

            newSlideContent.css({
                width: '',
                left: ''
            });

            newSlideElements.css({
                opacity: '',
                transform: ''
            });

            activeSlideImage.css({
                left: ''
            });

            slideshow.find('.pagination').trigger('check');
            slideshow.data('wait', false);
            if (auto) {
                timeout = setTimeout(function () {
                    slideshowNext(slideshow, false, true);
                }, slideshowDuration);
                slideshow.data('timeout', timeout);
            }
        });
    }
}

function slideshowNext(slideshow, previous, auto) {
    var slides = slideshow.find('.slide');
    var activeSlide = slides.filter('.is-active');
    var newSlide = null;
    if (previous) {
        newSlide = activeSlide.prev('.slide');
        if (newSlide.length === 0) {
            newSlide = slides.last();
        }
    } else {
        newSlide = activeSlide.next('.slide');
        if (newSlide.length == 0)
            newSlide = slides.filter('.slide').first();
    }

    slideshowSwitch(slideshow, newSlide.index(), auto);
}

function homeSlideshowParallax() {
    var scrollTop = $(window).scrollTop();
    if (scrollTop > windowHeight)
        return;
    var inner = slideshow.find('.slideshow-inner');
    var newHeight = windowHeight - (scrollTop / 2);
    var newTop = scrollTop * 0.8;

    inner.css({
        transform: 'translateY(' + newTop + 'px)', height: newHeight
    });
}

function toggleFee() {
        var newFee = document.getElementById("newFee");
        var toggleIconFee = document.getElementById("toggleIconFee");
        if (newFee.style.display === "none") {
          newFee.style.display = "block";
          toggleIconFee.classList.remove("fa-eye");
          toggleIconFee.classList.add("fa-eye-slash");
        } else {
          newFee.style.display = "none";
          toggleIconFee.classList.remove("fa-eye-slash");
          toggleIconFee.classList.add("fa-eye");
        }
      }
function toggleTime() {
        var newTime = document.getElementById("newTime");
        var toggleIconTime = document.getElementById("toggleIconTime");
        if (newTime.style.display === "none") {
          newTime.style.display = "block";
          toggleIconTime.classList.remove("fa-eye");
          toggleIconTime.classList.add("fa-eye-slash");
        } else {
          newTime.style.display = "none";
          toggleIconTime.classList.remove("fa-eye-slash");
          toggleIconTime.classList.add("fa-eye");
        }
      }	  

$(document).ready(function () {
    $('.slide').addClass('is-loaded');

    $('.slideshow .arrows .arrow').on('click', function () {
        slideshowNext($(this).closest('.slideshow'), $(this).hasClass('prev'));
    });

    $('.slideshow .pagination .item').on('click', function () {
        slideshowSwitch($(this).closest('.slideshow'), $(this).index());
    });

    $('.slideshow .pagination').on('check', function () {
        var slideshow = $(this).closest('.slideshow');
        var pages = $(this).find('.item');
        var index = slideshow.find('.slides .is-active').index();
        pages.removeClass('is-active');
        pages.eq(index).addClass('is-active');
    });

    /* Lazyloading
     $('.slideshow').each(function(){
     var slideshow=$(this);
     var images=slideshow.find('.image').not('.is-loaded');
     images.on('loaded',function(){
     var image=$(this);
     var slide=image.closest('.slide');
     slide.addClass('is-loaded');
     });
     */

    var timeout = setTimeout(function () {
        slideshowNext(slideshow, false, true);
    }, slideshowDuration);

    slideshow.data('timeout', timeout);
});

if ($('.main-content .slideshow').length > 1) {
    $(window).on('scroll', homeSlideshowParallax);
}