/************* Main Js File ************************
    Template Name: Jobguru - Job Board HTML Template
    Author: Themescare
    Version: 1.0
    Copyright 2018
*************************************************************/


/*------------------------------------------------------------------------------------
    
JS INDEX
=============

01 - Load More
02 - Range-Slider
03 - Darepicker
04 - Dropdown Arrow
05 - Banner-Slider
06 - Select-2
07 - Responsive Menu
08 - Youtube Popup
09 - Jarralax
10 - Testimonial SLider
11 - Sticky Header
12 - Btn To Top

-------------------------------------------------------------------------------------*/


(function ($) {
	"use strict";

	jQuery(document).ready(function ($) {


		/* 
		=================================================================
		01 - Load More Function Setup
		=================================================================	
		*/

		$(".moreBox").slice(0, 6).show();
		$(".moreBox2").slice(0, 3).show();
		if ($(".companyBox:hidden").length != 0) {
			$("#loadMore").show();
		};
		if ($(".companyBox2:hidden").length != 0) {
			$("#loadMore2").show();
		}
		$("#loadMore, #loadMore2").on('click', function (e) {
			e.preventDefault();
			$(".moreBox:hidden").slice(0, 3).slideDown();
			$(".moreBox2:hidden").slice(0, 3).slideDown();
			if ($(".moreBox:hidden").length == 0) {
				$("#loadMore").fadeOut('slow');
			};
			if ($(".moreBox2:hidden").length == 0) {
				$("#loadMore2").fadeOut('slow');
			}
		});

		/* 
		=================================================================
		02 - Range-Slider Setup
		=================================================================	
		*/


		$("#slider").slider({
			range: true,
			min: 500,
			max: 20000,
			values: [1500, 20000],
			slide: function (event, ui) {
				$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
			}
		});
		$("#amount").val("$" + $("#slider").slider("values", 0) +
			" - $" + $("#slider").slider("values", 1));


		/* 
		=================================================================
		03 - Darepicker Setup
		=================================================================	
		*/

		$(function () {
			$('.datepicker').datepicker({
				format: 'mm-dd-yyyy'
			});
		});

		/* 
		=================================================================
		04 - Dropdown Arrow
		=================================================================	
		*/

		if ($(".dropdown-menu li").length) {
			$(".dropdown-menu li").on('click', function () {
				$(this).parents(".dropdown").find('.btn-dropdown').html($(this).text());
				$(this).parents(".dropdown").find('.btn-dropdown').val($(this).data('value'));
			});
		};


		/* 
		=================================================================
		05 - Banner-Slider
		=================================================================	
		*/

		$(".banner-slider").owlCarousel({
			smartSpeed: 300,
			autoplayTimeout: 7000,
			animateOut: 'fadeOut',
			animateIn: 'fadeIn',
			items: 1,
			nav: false,
			dots: true,
			autoplay: true,
			loop: true,
			navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
			mouseDrag: true,
			touchDrag: true
		});


		/* 
		=================================================================
		06 - Select-2
		=================================================================	
		*/


		$('.banner-select').select2()

		$('.sidebar-category-select').select2({
			placeholder: 'e.g. job title'
		});
		$('.sidebar-category-select-2').select2({
			placeholder: 'Choose Category'
		});


		/* 
		=================================================================
		07 - Responsive Menu
		=================================================================	
		*/
		$("ul#jobguru_navigation").slicknav({
			prependTo: ".jobguru-responsive-menu"
		});


		/* 
		=================================================================
		08 - Youtube Popup
		=================================================================	
		*/

		$('.popup-youtube').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});
		/* 
		=================================================================
		09 - Jarralax
		=================================================================	
		*/

		//$('.parallax').jarallax();


		/* 
		=================================================================
		10 - Testimonial SLider
		=================================================================	
		*/
		$(".happy-freelancer-slider").owlCarousel({
			autoplay: true,
			loop: true,
			margin: 20,
			touchDrag: true,
			mouseDrag: true,
			nav: false,
			dots: true,
			autoplayTimeout: 5000,
			autoplaySpeed: 1200,
			autoplayHoverPause: true,
			responsive: {
				0: {
					items: 1
				},
				480: {
					items: 1
				},
				600: {
					items: 1
				},
				750: {
					items: 2
				},
				1000: {
					items: 3
				},
				1200: {
					items: 3
				}
			}
		});


	});

	   /* 
		=================================================================
		11 -Sticky Header
		=================================================================	
		*/

        $(window).on('scroll', function () {
            var scroll = $(window).scrollTop();
            if (scroll >= 50) {
                $(".forsticky").addClass("sticky");
            } else {
                $(".forsticky").removeClass("sticky");
                $(".forsticky").addClass("");
            }
        });

	   /* 
		=================================================================
		12 - Btn To Top
		=================================================================	
		*/
        if ($("body").length) {
            var btnUp = $('<div/>', {
                'class': 'btntoTop'
            });
            btnUp.appendTo('body');
            $(document).on('click', '.btntoTop', function () {
                $('html, body').animate({
                    scrollTop: 0
                }, 700);
            });
            $(window).on('scroll', function () {
                if ($(this).scrollTop() > 200) $('.btntoTop').addClass('active');
                else $('.btntoTop').removeClass('active');
            });
        }




}(jQuery));



/*============================ESNEK TABLO=====================================*/
if($( window ).width()<800 ){
s=0;
$('.esnektablo>tbody>tr').each(function() {
$(this).css({"border":"1px solid #ddd","margin":"5px"}); 
s=s+1;
i=0;
$('.esnektablo>thead>tr>th').each(function() {
i=i+1;
    var baslik = '<span>'+$(this).text()+'</span>';
	var veri = $('.esnektablo tbody tr:nth-child('+s+') td:nth-child('+i+')').html(); 
	var yeni = '<b>'+baslik + '</b><br>' + veri;
	$('.esnektablo tbody tr:nth-child('+s+') td:nth-child('+i+')').html(yeni).css({"display":"block","border":"none"}); 
	
	$(this).css("display","none");  
});
});
}
/*=================================================================*/


$('#katmanset').on('keyup', function () {
	var katmanset = $(this).val();
	if(katmanset.length<2){
	$("#katmansetsonuc").html("");
	}else{
		$.post("/katcek", {
        kat: katmanset
        }, function (cevap) {
            $("#katmansetsonuc").html(cevap);
        });
	}
});
	
$(document).on("change click","#adimlar .adim-secenek input, #adimlar .adim-secenek label",function(){
	if($(this).is(":checked")){
		if($(this).closest(".adim-sorular").attr("data-tur")=="radio"){
		$(this).closest(".adim-sorular").find(".adim-secenek").removeClass("active");
		}
		$(this).closest("label").addClass("active");
	}else{
		$(this).closest("label").removeClass("active");
	}
	
	if($(this).closest(".adim-sorular").find(".adim-soru").text()=="Ne Zaman?"){
		if( $(this).val()=="Belli bir zaman"){
			$(".adim-sorular .tarihsaat").show();
		}else{
			$(".adim-sorular .tarihsaat").hide();
		}
	}
	
	$.post("/talepislem?islem=ucretcek", $("#talepformu").serialize(), function (data) {
		if(data.indexOf('TL -  TL')<0){
		$("#teklifal .ucretler").html(data);
		$("#teklifal .ucretler").closest("p").show();
		}
	});
	
});






var adim=0;
$(document).on("click",".sonuclar,.katsec",function(){
	adim=0;
	$(".ilerleme").css("width","5%");
	$(".talepkaydet").hide();
	$("#teklifal .ucretler").closest("p").hide();
	$(".ileriadim").show();
	
$("#katmanset").val($(this).attr("data-baslik"));
$("#teklifal #katid").val($(this).attr("data-katid"));
$("#teklifal .baslik").html($(this).attr("data-baslik"));
if($(this).attr("data-ozelid")){
$("#teklifal #ozelid").val($(this).attr("data-ozelid"));
}else{
$("#teklifal #ozelid").val("0");
}
$("#teklifal").modal("show");
	$.post("/talepislem?islem=formcek", $("#talepformu").serialize(), function (data) {
		$("#adimlar").html(data);
		adimsayisi=parseInt($("#adimlar .adim-sorular").last().attr("data-adim"));
		var uyeil=$("#uyeil").val();
		var uyeilce=$("#uyeilce").val();
		$("#til").val(uyeil);
		$.post("/ilceler", {il: uyeil}, function (cevap) {
			$("#tilce").html(cevap);
			$("#tilce").show("slow");
			$("#tilce").val(uyeilce);
		});

	});
	$.post("/talepislem?islem=ucretcek", $("#talepformu").serialize(), function (data) {
		if(data.indexOf('TL -  TL')<0){
		$("#teklifal .ucretler").html(data);
		$("#teklifal .ucretler").closest("p").show();
		}
	});
});

$(document).on("click",".ileriadim",function(){
var secim='';
var secenek='';
$("#teklifal .adim"+adim+" input[type=radio], #teklifal .adim"+adim+" input[type=checkbox]").each(function(){
secenek='1';
if($(this).is(":checked")){
	secim='evet';
}
});

var secim2='';
var secenek2='';
$("#adimlar .adim"+adim+" input[type=text], #adimlar .adim"+adim+" textarea").each(function(){
secenek2='1';
if($(this).val()!==''){
	secim2='evet';
}
});

var ililce="";
if($("#adimlar #til").closest(".adim-sorular").attr("data-adim")==adim){
ililce="1";
if($("#adimlar #til option:selected").val()==''){
	secim3='';
	$("#adimlar #til").addClass("input-hata");
}else{
	$("#adimlar #til").removeClass("input-hata");
	secim3='evet';
}

if($("#adimlar #tilce option:selected").val()==''){
	secim4='';
	$("#adimlar #tilce").addClass("input-hata");
}else{
	$("#adimlar #tilce").removeClass("input-hata");
	secim4='evet';
}
}

if(secenek!=='' && secim==''){
$("#talepformu .adimuyari").html("Size uygun seçeneği işaretleyiniz!");
}else if(secenek2!=='' && secim2==''){
$("#talepformu .adimuyari").html("Sizden istenen bilgileri doldurunuz!");
}else if(ililce=='1' && secim3==''){
$("#talepformu .adimuyari").html("İl seçiniz!");
}else if(ililce=='1' && secim4==''){
$("#talepformu .adimuyari").html("İlçe seçiniz!");
}else{
if(adim<=adimsayisi){
	adim=adim+1;
	$("#talepformu .adim-sorular").hide();
	$("#talepformu .adim"+adim).show("slide", { direction: "right" }, 500);
}
if(adim===adimsayisi){
	$("#talepformu .ileriadim").hide();
	var giris=$("#uyeid").val();
	if(giris!==''){
	$("#talepformu .talepkaydet").show();
	}else{
	$("#talepformu .hizligiris").show();
	}
}
ilerleme=100/adimsayisi*adim;
$("#talepformu .ilerleme").css("width",ilerleme+"%");
}
});

$(document).on("click","#talepformu .geriadim",function(){
if(adim>0){
	adim=adim-1;
	$("#talepformu .adim-sorular").hide();
	$("#talepformu .adim"+adim).show("slide", { direction: "left" }, 500);
}
if(adim<adimsayisi){
	$("#talepformu .talepkaydet").hide();
	$("#talepformu .ileriadim").show();
}
ilerleme=100/adimsayisi*adim;
$("#talepformu .ilerleme").css("width",ilerleme+"%");
});

$(document).on("click keyup","#adimlar label,#adimlar textarea,#adimlar select",function(){
	$("#talepformu .adimuyari").html("");
});

$(document).on("click","#talepformu .talepkaydet",function(){
$("#talepformu .talepkaydet").prop("disabled",true);
	$.post("/talepislem?islem=kaydet", $("#talepformu").serialize(), function (data) {
		$("#adimlar").html(data);
		$("#talepformu .talepkaydet").hide();
		$("#talepformu .sonbuton").show();
		$("#talepformu .talepkaydet").prop("disabled",false);
	});
});

$(document).on("click",".hizligiris",function(){
$('.adimuyari').html("");
bosluk='';
$("#girisbilgileri .zorunlu").each(function() {
if($(this).val()==''){
bosluk='bos';
$(this).addClass("input-hata");
}else{
$(this).removeClass("input-hata");
}
});

if(bosluk=='bos'){
$('.adimuyari').html("Lütfen zorunlu alanları doldurunuz!");
}else{

$.post("/talepislem?islem=hizligiris", $("#talepformu").serialize(), function (veri) {
	if(veri.trim()=='ok'){
	$.post("/talepislem?islem=kaydet", $("#talepformu").serialize(), function (data) {
		$("#adimlar").html(data);
		$("#talepformu .hizligiris").hide();
		$("#talepformu .sonbuton").show();
	});
	}else{
	$("#girisbilgileri").html(veri);
	}
});
}
});




$(document).ready(function() {
$(".bildirimler").load("/bildirimler");
$(".mesajlar").load("/bildirimlermesaj");
});
setInterval(function() {
$(".bildirimler").load('/bildirimler');
$(".mesajlar").load('/bildirimlermesaj');
}, 20000);

$('.bildirimler').click(function () {
$.get("/bildirimler?bild=sustur");
});



$('.tarihsec').datepicker({
      autoclose: true,
	  language: 'tr'
});




$(document).on('change','#til', function () {
	var il = $('#til option:selected').val();
    $.post("/ilceler", {il: il}, function (cevap) {
        $("#tilce").html(cevap);
		$("#tilce").show("slow");
		
    });
});




$('.togglemenu').click(function () {
var menuid=$(this).attr("id");
$('.'+menuid).toggle("slow");
});



