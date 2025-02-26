jQuery(document).ready(function(){
    _swiperSlider();
    _navScroll();
    _activePage();
    _navImageSwitch();
    _tabsforEventsListing();
    _countDown();
    _tabChange();
});

var $ = jQuery;

function _swiperSlider(){
    var swiper = new Swiper(".events-slider", {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".button-next",
            prevEl: ".button-prev",
        },
        breakpoints: {
            640: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            1100: {
              slidesPerView: 3,
              spaceBetween: 20,
            },
            1500: {
              slidesPerView: 3,
              spaceBetween: 20,
            },
        },
    });

    var swiper = new Swiper(".thumbCarouselSmall", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    
    var swiper2 = new Swiper(".largeCarousel", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".button-next",
            prevEl: ".button-prev",
        },
        thumbs: {
          swiper: swiper,
        },
    });

    var swiper = new Swiper(".imageCarousel", {
        spaceBetween: 0,
        slidesPerView: 1,
        freeMode: true,
        watchSlidesProgress: true,
        grabCursor: true,
        speed: 900,
        navigation: {
            nextEl: ".button-next",
            prevEl: ".button-prev",
        },
    });

    var swiper = new Swiper(".logoCarousel", {
        autoplay: true,
        pauseOnMouseEnter: true,
        loop: true,
        delay: 1000,
        spaceBetween: 40,
        slidesPerView: 1,
        freeMode: true,
        watchSlidesProgress: true,
        grabCursor: true,
        speed: 900,
        centerInsufficientSlides: true,
        breakpoints: {
            640: {
              slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
              },
            1200: {
              slidesPerView: 4,
            },
            1500: {
              slidesPerView: 5,
            },
        },
        navigation: {
            nextEl: ".button-next",
            prevEl: ".button-prev",
        },
    });
} 

if($(window).scrollTop() > 50) {
    _navScroll();
}

function _navScroll(){
    $(window).scroll(function(event){
        if($(window).scrollTop() > 50) {
            $('.site-header').addClass('scroll')
            $('.site-header .site-branding img').addClass('resize')
        } else {
            $('.site-header').removeClass('scroll')
            $('.site-header .site-branding img').removeClass('resize')
        }
    });
} 

// Accordion Filter
function _filterFunction(){

  var input, filter, i, accordionTitle, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();

    accordionItem = $('.accordion-body').length

    for (i = 0; i < accordionItem; i++) {
            
        txtValue = $('.accordion-body p')[i].innerText
        accordionTitle = $('.accordion-item')[i]

        if (txtValue.toUpperCase().indexOf(filter) > -1 || accordionTitle.innerText.toUpperCase().indexOf(filter) > -1 ) {
            accordionTitle.style.opacity = '1'
        } else {
            accordionTitle.style.opacity = '0.1'
        }
    }
} 

//Active Page
function _activePage() {
    var current = location.pathname.replace(/\/$/, '');
    var curretSeg = current.substr(current.lastIndexOf('/') + 1);

    $('#inner-page-navigation li a').each(function(){
        var $this = $(this);
        var url= $this.attr('href').replace(/\/$/, '');
        var lastSeg = url.substr(url.lastIndexOf('/') + 1);

        // if the current path is like this link, make it active
        if(lastSeg.indexOf(curretSeg) !== -1){
            $this.addClass('active');
        }
    })
}

//Navigation Image Switch
function _navImageSwitch(){

    function toggleImageVisibility(imageId) {
        // Hide all images
        var megaMenu = document.querySelectorAll('.sub-menu-level-0');
        
        megaMenu.forEach(function (menu) {
            imagesInMenu = menu.querySelectorAll('.target-image')
            $i = 0;
            if(imagesInMenu.length > 0){
                imagesInMenu.forEach(function(image) {
                    if ($i == 0){
                        // image.style.display = 'block';
                        image.classList.add('visible'); // Add visible class for fade-in effect
                    } else {
                        // image.style.display = 'none';
                        image.classList.remove('visible'); // Remove visible class
                    }
                    $i++;
                });
            }
        })
        // Show the selected image
        var imageToShow = document.getElementById(imageId);
        if (imageToShow) {
        //   imageToShow.style.display = 'block';
            imageToShow.classList.add('visible'); // Remove visible class
        }
    }

    toggleImageVisibility()

    // Add event listeners to each link
    var links = document.querySelectorAll('.navigation-link');
    
    links.forEach(function(link) {
        link.addEventListener('mouseover', function() {
            var imageId = this.id.replace('link', 'image');
            toggleImageVisibility(imageId);
        });
    });
    
} 


//Tab Changes
function _tabChange(){

    //hides dropdown content
    $(".facility-map-section .tab-pane").hide();
    
    //unhides first option content
    $("#tab_1").show();
    
    //listen to dropdown for change
    $("#location_select").change(function(){
        //rehide content on change
        $('.tab-pane').hide();
        //unhides current item
        $('#'+$(this).val()).show();
    });
}

function _tabsforEventsListing() {
    $('.tab-nav a').click(function(e) {
        e.preventDefault();

        var tabId = $(this).data('tab');

        // Remove active classes
        $('.tab-nav li').removeClass('active');
        $('.tab-pane').removeClass('active');

        // Add active class to clicked tab and corresponding pane
        $(this).parent().addClass('active');
        $('#' + tabId).addClass('active');
    });
}

function _countDown() {
    $('.countdown-timer').each(function () {
        var timerElement = $(this);
        var eventDate = timerElement.data('date');

        if (eventDate) {
            var countDownDate = new Date(eventDate).getTime();

            var countdownFunction = setInterval(function () {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                if (distance >= 0) {
                    // Time calculations
                    var totalDays = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var months = Math.floor(totalDays / 30); // Approximate months
                    var weeks = Math.floor((totalDays % 30) / 7); // Remaining weeks
                    var days = (totalDays % 30) % 7; // Remaining days

                    // Optional time units
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Update the DOM
                    timerElement.find('.months').text(months < 10 ? '0' + months : months);
                    timerElement.find('.weeks').text(weeks < 10 ? '0' + weeks : weeks);
                    timerElement.find('.days').text(days < 10 ? '0' + days : days);

                    // Optional: Uncomment to display hours, minutes, seconds
                    timerElement.find('.hours').text(hours < 10 ? '0' + hours : hours);
                    // timerElement.find('.minutes').text(minutes < 10 ? '0' + minutes : minutes);
                    // timerElement.find('.seconds').text(seconds < 10 ? '0' + seconds : seconds);

                } else {
                    clearInterval(countdownFunction);
                    timerElement.html('<strong>Event Started!</strong>');
                }
            }, 1000);
        }
    });
}