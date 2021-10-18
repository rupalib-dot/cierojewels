$('.single-item').slick({
    dots: true,
    arrows: false
});



$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    asNavFor: '.slider-nav',
    responsive: [
        {
            breakpoint: 768,
            settings: {
                dots: true
            }
        }
    ]
});
$('.slider-nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: true,
    centerMode: true,
    focusOnSelect: true,
    vertical: true,
    verticalSwiping: true
});
if ($(window).width() < 768) {
    $(".footer-cltitle").click(function () {
        $(this).next(".footer-clbox").slideToggle();
        $(this).toggleClass("active");
        $(".footer-cltitle").not(this).next(".footer-clbox").slideUp();
        $(".footer-cltitle").not(this).removeClass("active");
    });
    $(".header").appendTo("#myHeader");
    $(".animated-arrow").appendTo("#myHeader");
}
//Plus Minus
$(".ddd").on("click", function () {

    var $button = $(this);
    var oldValue = $button.closest('.sp-quantity').find("input.quntity-input").val();

    if ($button.text() == "+") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below zero
        if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 0;
        }
    }

    $button.closest('.sp-quantity').find("input.quntity-input").val(newVal);

});
$(".filter-apply-btns").appendTo(".filter-part")
$(".filter-btn").click(function(){
    $(".product-category .filter-part").animate({left: "0"})
    $(".filter-apply-btns").animate({left: "0"})
})
$(".apply-btn").click(function(){
    $(".product-category .filter-part").animate({left: "-100%"})
    $(".filter-apply-btns").animate({left: "-100%"})
})

$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});





$('.multiple-items').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 812,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});








$('.projects-slider').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 812,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});





$('.whatsnew-slider').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 812,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});




 $(document).ready(function(){
  $(".submenuclick1").click(function(){
    $(".slideToggle1").slideToggle();
  });
  
  });


  $(document).ready(function () {
  $(".slideToggle1").hide();
  $(".show_hide").on("click", function () {
    var txt = $(".submenuclick1")
    $(".show_hide").text(txt);
    $(this).prev('.slideToggle1').slideToggle(200);
  });
});



  $(document).ready(function(){
  $(".submenuclick2").click(function(){
    $(".slideToggle2").slideToggle();
  });
  
  });


  $(document).ready(function () {
  $(".slideToggle2").hide();
  $(".show_hide").on("click", function () {
    var txt = $(".submenuclick2")
    $(".show_hide").text(txt);
    $(this).prev('.slideToggle2').slideToggle(200);
  });
});



    $(document).ready(function(){
  $(".submenuclick3").click(function(){
    $(".slideToggle3").slideToggle();
  });
  
  });


  $(document).ready(function () {
  $(".slideToggle3").hide();
  $(".show_hide").on("click", function () {
    var txt = $(".submenuclick3")
    $(".show_hide").text(txt);
    $(this).prev('.slideToggle3').slideToggle(200);
  });
});




   $(document).ready(function(){
  $(".submenuclick4").click(function(){
    $(".slideToggle4").slideToggle();
  });
  
  });


  $(document).ready(function () {
  $(".slideToggle4").hide();
  $(".show_hide").on("click", function () {
    var txt = $(".submenuclick4")
    $(".show_hide").text(txt);
    $(this).prev('.slideToggle4').slideToggle(200);
  });
});




   $(document).ready(function(){
  $(".submenuclick5").click(function(){
    $(".slideToggle5").slideToggle();
  });
  
  });


  $(document).ready(function () {
  $(".slideToggle5").hide();
  $(".show_hide").on("click", function () {
    var txt = $(".submenuclick5")
    $(".show_hide").text(txt);
    $(this).prev('.slideToggle5').slideToggle(200);
  });
});




   $(document).ready(function(){
  $(".submenuclick6").click(function(){
    $(".slideToggle6").slideToggle();
  });
  
  });


  $(document).ready(function () {
  $(".slideToggle6").hide();
  $(".show_hide").on("click", function () {
    var txt = $(".submenuclick6")
    $(".show_hide").text(txt);
    $(this).prev('.slideToggle6').slideToggle(200);
  });
});


   $(document).ready(function(){
  $(".submenuclick7").click(function(){
    $(".slideToggle7").slideToggle();
  });
  
  });


  $(document).ready(function () {
  $(".slideToggle7").hide();
  $(".show_hide").on("click", function () {
    var txt = $(".submenuclick7")
    $(".show_hide").text(txt);
    $(this).prev('.slideToggle7').slideToggle(200);
  });
});


