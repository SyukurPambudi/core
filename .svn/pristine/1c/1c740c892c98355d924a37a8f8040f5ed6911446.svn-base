// Jfunction Create By Husnul Aspiana
$(function(){
	var menu = $('#boxMenu'),
	pos = menu.offset();

	$(window).scroll(function(){
		if($(this).scrollTop() > pos.top+menu.height() && menu.hasClass('boxHead')){
			menu.fadeOut('fast', function(){
				$(this).removeClass('boxHead').addClass('fixed').fadeIn('fast');
			});
		} else if($(this).scrollTop() <= pos.top && menu.hasClass('fixed')){
			menu.fadeOut('fast', function(){
				$(this).removeClass('fixed').addClass('boxHead').fadeIn('fast');
			});
		}
	});
});

$(document).ready(function() {
	$(window).scroll(function(){
		if ($(this).scrollTop() > 200) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
	});
});

jQuery(document).ready(function($){
	/* prepend menu icon */
	$('#nav-wrap').prepend('<div id="menu-icon"><div style="padding:15px; z-index:9999;">MENU</div></div>');
	
	/* toggle nav */
	$("#menu-icon").on("click", function(){
		$("#nav").slideToggle();
		$(this).toggleClass("active");
	});

});

$(function(){
	var menu = $('#boxProdukList'),
	pos = menu.offset();

	$(window).scroll(function(){
		if($(this).scrollTop() > pos.top+menu.height() && menu.hasClass('menuProduk')){
			menu.fadeOut('fast', function(){
				$(this).removeClass('menuProduk').addClass('fixedProduk').fadeIn('fast');
			});
		} else if($(this).scrollTop() <= pos.top && menu.hasClass('fixedProduk')){
			menu.fadeOut('fast', function(){
				$(this).removeClass('fixedProduk').addClass('menuProduk').fadeIn('fast');
			});
		}
	});
});

jQuery(document).ready(function($){
	/* prepend menu icon */
	$('#nav-wrapProd').prepend('<div id="menu-iconProd">Daftar Produk &raquo;</div>');
	
	/* toggle nav */
	$("#menu-iconProd").on("click", function(){
		$("#navProd").slideToggle();
		$(this).toggleClass("active");
	});

});


