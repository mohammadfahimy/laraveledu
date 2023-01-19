(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:6
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

//wishylist
    $(document).ready(function() {

        $('body').on('click','.wishlist', function(e){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            e.preventDefault();
        
            var $product_id = $(this).data('product_id');
            $.ajax({
                url: 'ajaxUrl',
                type: 'POST',
                dataType: 'json',
                data : {product_id: $product_id},

                success: function(response){
                    iziToast.success({
                        title: 'OK',
                        message: response.msg,
                    });
                    return;
                },
                error: function(error){

                    iziToast.error({
                        title: 'Error',
                        message: error.responseJSON.msg,
                    });
                    return;
                }
            });

        });
    });

    //compare

    $(document).ready(function(){

        $('body').on('click','.comare',function(e){
            e.preventDefault();
            var $product_id = $(this).data('product_id');

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'compare',
                data: {product_id: $product_id},
                
                success: function(response){
                    console.log(response);
                },

                error: function(jqXHR, textStatus, errorThrown)
                {
                    
                }
            });
        });

    });
    
})(jQuery);

