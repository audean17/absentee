"use strict";

//  i Check plugin
$('.i-check, .i-radio').iCheck({
    checkboxClass: 'i-check',
    radioClass: 'i-radio'
});


// price slider
var txtFrom = $(".js-from");
var txtTo = $(".js-to");
$("#price-slider").ionRangeSlider({
    min: 25000,
    max: 300000,
    from: 25000,
    to: 300000,
    type: 'double',
	step: 5000,
    prefix: "Rp. ",
    prettify: false,
    hasGrid: false,
	
	/*ADD FAUZAN*/
	onFinish: function (obj) {      // callback is called on every slider change
        //alert("from: " + obj.fromNumber+ "   to: "+ obj.toNumber);
		txtFrom.prop("value", obj.fromNumber);
		txtTo.prop("value", obj.toNumber);
	   var myObj = $('input[name=hidMyObj]').val();
	   var myCat = $('input[name=hidMyCat]').val();
	   var mySort = $('select[name=sortBy]').val();
	   var page = "";
	   var strCatChecked="";
	   var strBrandChecked="";
	   var strDiscountChecked="";
	   strCatChecked=getStrCatChecked();
	   strBrandChecked=getStrBrandChecked();
	   strDiscountChecked=getStrDiscountChecked();
	   doViewPage(myObj,myCat,page,mySort,strCatChecked,strBrandChecked,strDiscountChecked,obj.fromNumber,obj.toNumber); 
 
 
    }
});
var slider = $("#price-slider").data("ionRangeSlider");


$('#jqzoom').jqzoom({
    zoomType: 'standard',
    lens: true,
    preloadImages: false,
    alwaysOn: false,
    zoomWidth: 460,
    zoomHeight: 460,
    // xOffset:390,
    yOffset: 0,
    position: 'left'
});


$('.form-group-cc-number input').payment('formatCardNumber');
$('.form-group-cc-date input').payment('formatCardExpiry');
$('.form-group-cc-cvc input').payment('formatCardCVC');

// Register account on payment
$('#create-account-checkbox').on('ifChecked', function() {
    $('#create-account').removeClass('hide');
});

$('#create-account-checkbox').on('ifUnchecked', function() {
    $('#create-account').addClass('hide');
});

$('#shipping-address-checkbox').on('ifChecked', function() {
    $('#shipping-address').removeClass('hide');
});

$('#shipping-address-checkbox').on('ifUnchecked', function() {
    $('#shipping-address').addClass('hide');
});



$('.owl-carousel').each(function(){
  $(this).owlCarousel();
});



// Lighbox gallery
$('#popup-gallery').each(function() {
    $(this).magnificPopup({
        delegate: 'a.popup-gallery-image',
        type: 'image',
        gallery: {
            enabled: true
        }
    });
});

// Lighbox image
$('.popup-image').magnificPopup({
    type: 'image'
});

// Lighbox text
$('.popup-text').magnificPopup({
    removalDelay: 500,
    closeBtnInside: true,
    callbacks: {
        beforeOpen: function() {
            this.st.mainClass = this.st.el.attr('data-effect');
        }
    },
    midClick: true
});



$(".product-page-qty-plus").on('click', function() {
    var currentVal = parseInt($(this).prev(".product-page-qty-input").val(), 10);

    if (!currentVal || currentVal == "" || currentVal == "NaN") currentVal = 0;

    $(this).prev(".product-page-qty-input").val(currentVal + 1);
});

$(".product-page-qty-minus").on('click', function() {
    var currentVal = parseInt($(this).next(".product-page-qty-input").val(), 10);
    if (currentVal == "NaN") currentVal = 1;
    if (currentVal > 1) {
        $(this).next(".product-page-qty-input").val(currentVal - 1);
    }
});