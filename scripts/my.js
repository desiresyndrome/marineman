// POPUP + CF 7
jQuery(document).ready(function($){$(document).on("click",".click-pop",function(){$("#window").toggleClass("active-pop");$("#bg-popup").toggleClass("active-pop");titleSert=$(this).attr("data-title-sert");$("#title-sert").val(titleSert)});$(".wpcf7").on('wpcf7:mailsent',function(event){setTimeout(function(){document.querySelector('.click-pop').click()},1500);setTimeout(function(){$(".wpcf7-response-output").hide()},2000)})});

// Задаем класс при скроле
$(window).scroll(function(){var height=$(window).scrollTop();if(height>10){$('.header-wrap').addClass('activete')}else{$('.header-wrap').removeClass('activete')}});

// Плавная прокрутка Вверх
(function(){var $totop=$('.tops');var isScrolling=false;var scrollThreshold=450;var scrollDuration=900;var showedClass='tops-active';$(window).on('scroll',function(){if($(window).scrollTop()>scrollThreshold){$totop.addClass(showedClass)}else{$totop.removeClass(showedClass)}});$totop.on('click',function(e){e.preventDefault();if(!isScrolling){isScrolling=true;$("html, body").animate({scrollTop:0},scrollDuration,function(){isScrolling=false})}})})();

// Выпадающий список
function languagesFunction(){document.getElementById("myDropdown").classList.toggle("show")}window.onclick=function(event){if(!event.target.matches('.dropbtn')){var dropdowns=document.getElementsByClassName("dropdown-content");var i;for(i=0;i<dropdowns.length;i++){var openDropdown=dropdowns[i];if(openDropdown.classList.contains('show')){openDropdown.classList.remove('show')}}}}

// Предупреждение о куки
function checkCookies(){let cookieDate=localStorage.getItem('cookieDate');let cookieNotification=document.getElementById('cookie_notification');let cookieBtn=cookieNotification.querySelector('.cookie_accept');if(!cookieDate||(+cookieDate+31536000000)<Date.now()){cookieNotification.classList.add('show')}cookieBtn.addEventListener('click',function(){localStorage.setItem('cookieDate',Date.now());cookieNotification.classList.remove('show')})}checkCookies();

// Стилизация селекта
$('.select').each(function(){const _this=$(this),selectOption=_this.find('option'),selectOptionLength=selectOption.length,selectedOption=selectOption.filter(':selected'),duration=450;_this.hide();_this.wrap('<div class="select"></div>');$('<div>',{class:'new-select',text:_this.children('option:nth-child(1)').text()}).insertAfter(_this);const selectHead=_this.next('.new-select');$('<div>',{class:'new-select__list'}).insertAfter(selectHead);const selectList=selectHead.next('.new-select__list');for(let i=1;i<selectOptionLength;i++){$('<div>',{class:'new-select__item',html:$('<span>',{text:selectOption.eq(i).text()})}).attr('data-value',selectOption.eq(i).val()).appendTo(selectList)}const selectItem=selectList.find('.new-select__item');selectList.slideUp(0);selectHead.on('click',function(){if(!$(this).hasClass('on')){$(this).addClass('on');selectList.slideDown(duration);selectItem.on('click',function(){let chooseItem=$(this).data('value');$('select').val(chooseItem).attr('selected','selected');selectHead.text($(this).find('span').text());selectList.slideUp(duration);selectHead.removeClass('on')})}else{$(this).removeClass('on');selectList.slideUp(duration)}})});

// Плавный скрол к якорю
$(document).ready(function(){$(".anhor1").on("click",function(event){event.preventDefault();var id=$(this).attr('href'),top=$(id).offset().top;$('body,html').animate({scrollTop:top},900)});


// Ajax
$(document).on('click', '.all-filter .all-filter-form-flex .select:nth-child(1) .new-select__item span, .all-filter .all-filter-form-flex .select:nth-child(2) .new-select__item span, .all-filter .all-filter-form-flex .select:nth-child(3) .new-select__item span', function (event) {
	event.preventDefault();

	var posFF = $('.all-filter .all-filter-form-flex .select:nth-child(1) .new-select').text();
	var vesFF = $('.all-filter .all-filter-form-flex .select:nth-child(2) .new-select').text();
	var natFF = $('.all-filter .all-filter-form-flex .select:nth-child(3) .new-select').text();

	if(posFF == 'All Position') {
		posFF = '';
	}
	if(vesFF == 'All Vesel Type') {
		vesFF = '';
	}
	if(natFF == 'All Nationality') {
		natFF = '';
	}
	if(posFF == 'Wszystkie Pozycje') {
		posFF = '';
	}
	if(vesFF == 'Wszystkie typy Statkow') {
		vesFF = '';
	}
	if(natFF == 'Wszystkie Narodowosci') {
		natFF = '';
	}
	if(posFF == 'Должность') {
		posFF = '';
	}
	if(vesFF == 'Тип судна') {
		vesFF = '';
	}
	if(natFF == 'Национальность') {
		natFF = '';
	}

	$.ajax({
		url: '/wp-admin/admin-ajax.php',
		type: 'POST',
		data: {
			action: "myfilter1", posFF: posFF, vesFF: vesFF, natFF: natFF
		}, beforeSend: function () {
				},
				success: function (data) {
				 $('.gl-jobs-block').html(data);
				}
			});
});

$(document).on('click', '#pagin', function (event) {
	event.preventDefault();

	var posFF = $('.all-filter .all-filter-form-flex .select:nth-child(1) .new-select').text();
	var vesFF = $('.all-filter .all-filter-form-flex .select:nth-child(2) .new-select').text();
	var natFF = $('.all-filter .all-filter-form-flex .select:nth-child(3) .new-select').text();

	if(posFF == 'All Position') {
		posFF = '';
	}
	if(vesFF == 'All Vesel Type') {
		vesFF = '';
	}
	if(natFF == 'All Nationality') {
		natFF = '';
	}
	if(posFF == 'Wszystkie Pozycje') {
		posFF = '';
	}
	if(vesFF == 'Wszystkie typy Statkow') {
		vesFF = '';
	}
	if(natFF == 'Wszystkie Narodowosci') {
		natFF = '';
	}
	if(posFF == 'Должность') {
		posFF = '';
	}
	if(vesFF == 'Тип судна') {
		vesFF = '';
	}
	if(natFF == 'Национальность') {
		natFF = '';
	}

	var current = $(this).attr('data-page-c');
	var maxim = $(this).attr('data-page-m');

	var page = Number(current)+1;

	console.log(current);
	console.log(maxim);

	$.ajax({
		url: '/wp-admin/admin-ajax.php',
		type: 'POST',
		data: {
			action: "myfilter2", posFF: posFF, vesFF: vesFF, natFF: natFF, current: current
		}, beforeSend: function () {
				},
				success: function (data) {
				
				 $('.gl-job-item-wrapp').append(data);

				 $('#pagin').attr('data-page-c', page);
				 if(page == maxim) {
				 	$('#pagin').css('display', 'none');
				 }
				}
			});
});

$(document).on('click', '.all-ships-filter .select:nth-child(1) .new-select__item span', function (event) {
	event.preventDefault();

	var typeFF = $('.all-ships-filter .select:nth-child(1) .new-select').text();

	if(typeFF == 'All type') {
		typeFF = '';
	}
	if(typeFF == 'Wszystkie typy') {
		typeFF = '';
	}
	if(typeFF == 'Все типы') {
		typeFF = '';
	}

	$.ajax({
		url: '/wp-admin/admin-ajax.php',
		type: 'POST',
		data: {
			action: "myfilter3", typeFF: typeFF
		}, beforeSend: function () {
				},
				success: function (data) {
				 $('.all-ships-block').html(data);
				}
			});
});

$(document).on('click', '#pagin-s', function (event) {
	event.preventDefault();

	var typeFF = $('.all-ships-filter .select:nth-child(1) .new-select').text();

	if(typeFF == 'All type') {
		typeFF = '';
	}
	if(typeFF == 'Wszystkie typy') {
		typeFF = '';
	}
	if(typeFF == 'Все типы') {
		typeFF = '';
	}


	var current = $(this).attr('data-page-c');
	var maxim = $(this).attr('data-page-m');

	var page = Number(current)+1;

	console.log(current);
	console.log(maxim);


	$.ajax({
		url: '/wp-admin/admin-ajax.php',
		type: 'POST',
		data: {
			action: "myfilter4", typeFF: typeFF, current: current
		}, beforeSend: function () {
				},
				success: function (data) {
				 console.log(data);

				 $('.all-ships-block-wrapp').append(data);

				 $('#pagin-s').attr('data-page-c', page);
				 if(page == maxim) {
				 	$('#pagin-s').css('display', 'none');
				 }
				}
			});
});
});