$( document ).ready(function() {

	$("#phone").mask("+7 (999) 999 99 99");
	$("#phone_call_input").mask("+7 (999) 999 99 99");

	jQuery.noConflict();

	//Прогрес бар
	//PageScrollIndicator.createProgressBar("#container", "#wrapper");

	//Слайдер
	 var swiper = new Swiper({
	    el: '.swiper-container',
	    initialSlide: 0,
	    spaceBetween: 50,
	    slidesPerView: 1,
	    centeredSlides: true,
	    slideToClickedSlide: true,
	    effect: 'coverflow',
	    disableOnInteraction: false,
	    grabCursor: true,
	    scrollbar: {
	      el: '.swiper-scrollbar',
	    },
	    mousewheel: {
	      enabled: false,
	    },
	    keyboard: {
	      enabled: true,
	    },
	    pagination: {
	        el: '.swiper-pagination',
	        clickable: true,
	        renderBullet: function (index, className) {
	          return '<span class="' + className + '"></span>';
	        },
	      },
	    navigation: {
	      nextEl: '.swiper-button-next',
	      prevEl: '.swiper-button-prev',
	    },
	  });

	 swiper.autoplay.start();

	 $( function() {
	 	$( "#date" ).datepicker({
			 monthNames: ['Январь', 'Февраль', 'Март', 'Апрель',
			'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
			'Октябрь', 'Ноябрь', 'Декабрь'],
			 dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
			 firstDay: 1,
			});
	 	$( "#date" ).datepicker("option", "dateFormat", 'dd.mm.yy' );
	 } );


	$('#gruz_yes').click(function() {
		 $(".group3").attr('disabled',false);
	});

	$('#gruz_no').click(function() {
		 $(".group3").attr('disabled',true);
	});

	var massa, sum = 0, date_val, day_of_week;

	$('#price-btn').click(function() {
		sum = 0
		 var date_val = new Date($("#date").val().replace(/(\d+).(\d+).(\d+)/,"$3/$2/$1"));
		 var day_of_week = date_val.getDay(); //0 - вс, 6 - сб

		 //Груз стандартный или хрупкий
		if($('#standart_gruz').is(':checked')) 
	 	{ 
	 		
	 	}
	 	else
	 	{
	 		sum += 3000;
	 	}

	 	//Нужна охрана или нет
	 	if($('#ohr_yes').is(':checked')) 
	 	{ 
	 		sum += 7000;
	 	}

	 	//Нужны ли грузчики
	 	if($('#gruz_yes').is(':checked')) 
	 	{ 
	 		sum += 5000;
	 		//Нужна ли спецтехника
	 		if($('#spec_yes').is(':checked')) 
		 	{ 
		 		sum += 2000;
		 	}
	 	}

	 	massa = $("#mass").val();
		if (day_of_week == 6 || day_of_week == 0)
		{
			sum += 2000;
		}

	});

	//Авторесайз изображения
	jQuery(function ($) {
    function fix_size() {
	        var images = $('.swiper-slide img');
	        images.each(setsize);

	        function setsize() {
	            var img = $(this),
	                img_dom = img.get(0),
	                container = img.parents('.img-container');
	            if (img_dom.complete) {
	                resize();
	            } else img.one('load', resize);

	            function resize() {
	                if ((container.width() / container.height()) < (img_dom.width / img_dom.height)) {
	                    img.width('100%');
	                    img.height('auto');
	                    return;
	                }
	                img.height('100%');
	                img.width('auto');
	            }
	        }
	    }
	    $(window).on('resize', fix_size);
	    fix_size();
	});

ymaps.ready(init);

function init() {
    // Стоимость за километр.
    var DELIVERY_TARIFF = 20,
    // Минимальная стоимость.
        MINIMUM_COST = 500,
        myMap = new ymaps.Map('maps', {
            center: [54.1948144,37.6126348],
            zoom: 12,
            controls: []
        }),
    // Создадим панель маршрутизации.
        routePanelControl = new ymaps.control.RoutePanel({
            options: {
                // Добавим заголовок панели.
                showHeader: true,
                autofocus: false,
                title: 'Расчёт доставки'
            }
        }),
        zoomControl = new ymaps.control.ZoomControl({
            options: {
                size: 'small',
                float: 'none',
                position: {
                    bottom: 145,
                    right: 10
                }
            }
        });
    // Пользователь сможет построить только автомобильный маршрут.
    routePanelControl.routePanel.options.set({
        types: {auto: true}
    });

    myMap.controls.add(routePanelControl).add(zoomControl);

    // Получим ссылку на маршрут.
    routePanelControl.routePanel.getRouteAsync().then(function (route) {

        // Зададим максимально допустимое число маршрутов, возвращаемых мультимаршрутизатором.
        route.model.setParams({results: 1}, true);

        // Повесим обработчик на событие построения маршрута.
        route.model.events.add('requestsuccess', function () {

            var activeRoute = route.getActiveRoute();
            if (activeRoute) {

            	var x = route.getActiveRoute().properties.get("distance").value/1000, res;

            	if (x < 200)
            	{
            		res = 1;
            	}
            	else
            	{
            		res = Math.ceil(x/200);
            	}

                // Получим протяженность маршрута.
                var length = route.getActiveRoute().properties.get("distance"),
                // Вычислим стоимость доставки.
                    price = calculate(Math.round(length.value / 1000), sum, massa),
                // Создадим макет содержимого балуна маршрута.
                    balloonContentLayout = ymaps.templateLayoutFactory.createClass(
                        '<span>Расстояние: ' + length.text + '.</span><br/>' +
                        '<span style="font-weight: bold; font-style: italic">Стоимость доставки от: ' + price + ' р.</span><br>' +
                        '<span style="font-weight: bold;">Примерное время доставки в днях: ' + res + '.</span>');
                // Зададим этот макет для содержимого балуна.
                route.options.set('routeBalloonContentLayout', balloonContentLayout);
                // Откроем балун.
                activeRoute.balloon.open();
            }
        });

    });
    // Функция, вычисляющая стоимость доставки.
    function calculate(routeLength, summ, mass) {
        return Math.max(routeLength * (DELIVERY_TARIFF * mass) + sum, MINIMUM_COST);
    }
}


	//Форма регистрации

	  $("#view1_btn").on("click", function(){
	  	var pass1 = $('#view1_input');
	  	var pass_btn1 = $('#view1_btn');
	  	
	  	if (pass1.attr('type') === "password")
	  	{
	  		pass1.attr('type', 'text');
	  		pass_btn1.css('background-position','0 -23px');
	  	}
	  	else
	  	{
	  		pass1.attr('type', 'password');
	  		pass_btn1.css('background-position','0 0');
	  	}
	  });


	$("#view2_btn").on("click", function(){
	  	var pass2 = $('#view2_input');
	  	var pass_btn2 = $('#view2_btn');
	  	
	  	if (pass2.attr('type') === "password")
	  	{
	  		pass2.attr('type', 'text');
	  		pass_btn2.css('background-position','0 -23px');
	  	}
	  	else
	  	{
	  		pass2.attr('type', 'password');
	  		pass_btn2.css('background-position','0 0');
	  	}
	  });

	$("#view3_btn").on("click", function(){
	  	var pass3 = $('#view3_input');
	  	var pass_btn3 = $('#view3_btn');
	  	
	  	if (pass3.attr('type') === "password")
	  	{
	  		pass3.attr('type', 'text');
	  		pass_btn3.css('background-position','0 -23px');
	  	}
	  	else
	  	{
	  		pass3.attr('type', 'password');
	  		pass_btn3.css('background-position','0 0');
	  	}
	  });

});