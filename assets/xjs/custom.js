CKEDITOR.on( 'instanceReady', function( evt ) {
	var editor = evt.editor;

	// Apply focus class name.
	editor.on( 'focus', function() {
		editor.container.addClass( 'cke_focused' );
	});
	editor.on( 'blur', function() {
		editor.container.removeClass( 'cke_focused' );
	});

	// Put startup focus on the first editor in tab order.
	if ( editor.tabIndex == 1 )
		editor.focus();
});
function initTooltips(){
	$('.bottom_tooltip').tooltip({
		placement: 'bottom'
	});
	$('.left_tooltip').tooltip({
		placement: 'left'
	});
	$('.right_tooltip').tooltip({
		placement: 'right'
	});
	$('.top_tooltip').tooltip();
}
function initPopover() {
    var keepPopover,
        delay = function() { keepPopover = setTimeout( function() { $('.popover').hide(); }, 500); };
	$('.pop_hover').each(function(){
		$(this).popover({
			trigger: 'manual',
			placement:$(this).attr('data-placement'),
			content:$('#'+$(this).attr('data-contentdiv')).html()
		})	
		.mouseenter(function(e) {
			var $popover = $('.popover');
			(keepPopover) && clearTimeout(keepPopover);
			($popover.length) && $popover.remove();
			$(this).popover('show');
		})	
		.mouseleave(function(e) {
			var $smarttip = $(this);
			delay();
			$('.popover')
				.mouseenter(function(e) { clearTimeout(keepPopover); })
				.mouseleave(function(e) { delay(); });
		}).click(function(e) {
			e.preventDefault();
		});
	});

};
function typeaheadDropdown(){
	$('.typeahead-icon').each(function() {
		var myInput = $(this);
		var allData = eval(myInput.attr('data-content'));			
		allData.sort();
		var myItems = Number(myInput.attr('data-items'));
		myInput.typeahead({
			source: allData,
			items:myItems,
			menu: '<ul class="typeahead dropdown-menu with-icon '+myInput.attr('data-class')+'"></ul>',
			highlighter: function(item){
				return '<div><i class="'+myInput.attr('data-icon')+' icon-large"></i> '+item+'</div>';
			}
		});
		var lebar = (myInput.width()+12);
		$('.typeahead.dropdown-menu.with-icon.'+myInput.attr('data-class')).width(lebar);
	});
	
	$('.typeahead-thumbnail').each(function() {
		var myInput1 = $(this);
		var allData1 = eval(myInput1.attr('data-content'));			
		allData1.sort();
		var myItems1 = Number(myInput1.attr('data-items'));
		myInput1.typeahead({
			source: allData1,
			items:myItems1,
			menu: '<ul class="typeahead dropdown-menu with-thumbnail '+myInput1.attr('data-class')+'"></ul>',
			highlighter: function(item1){
				var imageName = item1.toLowerCase().split(' ').join('-');
				return '<div><img src="'+myInput1.attr('data-folder')+imageName+'.jpg" class="avatar img-polaroid" /> '+item1+'</div>';
			}
		});
		var lebar1 = (myInput1.width()+12);
		$('.typeahead.dropdown-menu.with-thumbnail.'+myInput1.attr('data-class')).width(lebar1);
	});
}
function formAddOns(){
	if ($(".elastic").length > 0){
		$(".elastic").elastic();
	}
    $("input:checkbox, input:radio, input:file").uniform();
	$('.datePicker').each(function() {
		$(this).datepicker({
                    format: 'yyyy-mm-dd'
                });
	});
	$('.timePicker').each(function(){
		$(this).timePicker({
		show24Hours: false,
		separator:'.',
		step: 5});
		$('.time-picker').width($(this).width()+12);
	});	
	$('.colorPicker').each(function(){
		$(this).simpleColorPicker({ colorsPerLine: 16 });
	});	
	$(".chzn-select").chosen();	
	$('.twys').wysihtml5();
	var cleft = document.getElementById('charsLeft');
	if (typeof(cleft) != 'undefined' && cleft != null){
		$('.tlimit').limit($('.tlimit').attr('data-limit'),'#charsLeft');
	}
	$(".wizardForm").formToWizard({ submitButton: 'submitWizard' });
}
function cpPagination(){
	$(function(){
		$("div.holder").jPages({
			containerID : "itemContainer",
			perPage      : 1,
			startPage    : 1,
			startRange   : 1,
			midRange     : 5,
			endRange     : 1
		});			
	});
	$(function(){
		$("div.holdername").jPages({
			containerID : "itemContainer",
			perPage      : 1,
			startPage    : 1,
			startRange   : 1,
			midRange     : 5,
			endRange     : 1,
			links       : "title"
		});			
	});
	$(function(){
		var dataPerPage = Number($("div.pgholder").attr('data-perPage'));
		var dataStartPage = Number($("div.pgholder").attr('data-startPage'));
		var dataStartRange = Number($("div.pgholder").attr('data-startRange'));
		var dataMidRange = Number($("div.pgholder").attr('data-midRange'));
		var dataEndRange = Number($("div.pgholder").attr('data-endRange'));
		var dataButtonClass = $("div.pgholder").attr('data-buttonClass');
		var dataButtonSize = $("div.pgholder").attr('data-buttonSize');
		var dataContentID = $("div.pgholder").attr('data-contentID');
		
		if($('#'+dataContentID).hasClass('grid-stream')){
			$("div.pgholder").jPages({
				containerID : dataContentID,
				perPage     : dataPerPage,
				startPage   : dataStartPage,
				startRange  : dataStartRange,
				midRange    : dataMidRange,
				endRange    : dataEndRange,
				callback	: function(){
					$('#'+dataContentID).masonry( 'destroy' );
					$('#'+dataContentID).masonry({
						itemSelector: '.lm.jshow',
						gutterWidth: 10
					});
				}
			});
		}else{
			$("div.pgholder").jPages({
				containerID : dataContentID,
				perPage      : dataPerPage,
				startPage    : dataStartPage,
				startRange   : dataStartRange,
				midRange     : dataMidRange,
				endRange     : dataEndRange
			});
		}
		if (typeof dataButtonClass !== 'undefined' && dataButtonClass !== false) {
			$('div.pgholder .btn').each(function() {
				$(this).removeClass('btn-info').addClass(dataButtonClass);
			});
		}
		if (typeof dataButtonSize !== 'undefined' && dataButtonSize !== false) {
			$('div.pgholder .btn').each(function() {
				$(this).addClass(dataButtonSize);
			});
		}
	});
	$('.ijump').click(function(){
		var nilai = parseInt($(this).attr('data-value'));
		$("div.holder").jPages( nilai );
	});
}
function sliderDefault(){
	$('.sliderDefault').each(function(){
		var containerID = $(this).attr('id');
		var dataMin = parseInt($(this).attr('data-min'));
		var dataMax = parseInt($(this).attr('data-max'));
		var dataValue = parseInt($(this).attr('data-value'));
		var dataDesc = $(this).attr('data-text');
		$('#'+containerID).append('<div class="desc">'+dataDesc+' <span>'+dataValue+'</span></div><div class="sliderContainer"></div>');
		$('#'+containerID+' .sliderContainer').slider({
			value:dataValue,
			min: dataMin,
			max: dataMax,
			slide: function( event, ui ) {
				$('#'+containerID+' .desc span').html( ui.value );
			}
		});
	});
}
function sliderVertical(){
	$('.sliderVertical').each(function(){
		var containerID = $(this).attr('id');
		var dataMin = parseInt($(this).attr('data-min'));
		var dataMax = parseInt($(this).attr('data-max'));
		var dataValue = parseInt($(this).attr('data-value'));
		var dataDesc = $(this).attr('data-text');
		$('#'+containerID).append('<div class="desc">'+dataDesc+' <span>'+dataValue+'</span></div><div class="sliderContainer"></div>');
		$('#'+containerID+' .sliderContainer').slider({
			orientation: 'vertical',
			value:dataValue,
			min: dataMin,
			max: dataMax,
			slide: function( event, ui ) {
				$('#'+containerID+' .desc span').html( ui.value );
			}
		});
	});
}
function sliderRange(){
	$('.sliderRange').each(function(){
		var containerID = $(this).attr('id');
		var dataMin = parseInt($(this).attr('data-min'));
		var dataMax = parseInt($(this).attr('data-max'));
		var dataValue = eval($(this).attr('data-values'));
		var dataDesc = $(this).attr('data-text');
		
		$('#'+containerID).append('<div class="desc">'+dataDesc+' <span>'+dataValue[0]+' - '+dataValue[1]+'</span></div><div class="sliderContainer"></div>');
		$('#'+containerID+' .sliderContainer').slider({
			range: true,
			values:dataValue,
			min: dataMin,
			max: dataMax,
			slide: function( event, ui ) {
				$('#'+containerID+' .desc span').html(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
			}
		});
	});
}
function sliderRangeVertical(){
	$('.sliderRangeVertical').each(function(){
		var containerID = $(this).attr('id');
		var dataMin = parseInt($(this).attr('data-min'));
		var dataMax = parseInt($(this).attr('data-max'));
		var dataValue = eval($(this).attr('data-values'));
		var dataDesc = $(this).attr('data-text');
		
		$('#'+containerID).append('<div class="desc">'+dataDesc+' <span>'+dataValue[0]+' - '+dataValue[1]+'</span></div><div class="sliderContainer"></div>');
		$('#'+containerID+' .sliderContainer').slider({
			orientation: 'vertical',
			range: true,
			values:dataValue,
			min: dataMin,
			max: dataMax,
			slide: function( event, ui ) {
				$('#'+containerID+' .desc span').html(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
			}
		});
	});
}
function sliderDateRange(){
	$('.dateRangeSlider').each(function(){
		var containerID = $(this).attr('id');
		var dminDate = $(this).attr('data-min-range').split('-');
		var dmaxDate = $(this).attr('data-max-range').split('-');
		var tempVal = $(this).attr('data-values').split(',');
		
		var dminVal = tempVal[0].split('-');
		var dmaxVal = tempVal[1].split('-');
		
		var minDate = new Date(dminDate[0], dminDate[1]-1, dminDate[2]);
		var maxDate = new Date(dmaxDate[0], dmaxDate[1]-1, dmaxDate[2]);
		var minVal = new Date(dminVal[0], dminVal[1]-1, dminVal[2]);
		var maxVal = new Date(dmaxVal[0], dmaxVal[1]-1, dmaxVal[2]);
		
		var akhirT = Math.floor((maxDate.getTime() - minDate.getTime()) / 86400000);
		var theStart = (akhirT - (Math.floor((maxDate.getTime() - minVal.getTime()) / 86400000)))+1;
		var theEnd = (akhirT - (Math.floor((maxDate.getTime() - maxVal.getTime()) / 86400000)))+1;
		
		$('#'+containerID).append('<div class="desc">Start date: <span class="one"><strong>'+tempVal[0]+'</strong></span>, end date: <span class="two"><strong>'+tempVal[1]+'</strong></span></div><div class="sliderContainer"></div>');
		
		$('#'+containerID+' .sliderContainer').slider({
			range: true,
			values: [theStart, theEnd],
			max: akhirT,
			min:1,
			slide: function(event, ui) { 
					var date1 = new Date(minDate.getTime());
					var date2 = new Date(minDate.getTime());
					
					date1.setDate(date1.getDate() + (ui.values[0]-1));
					var date1a = date1.getFullYear()+'-'+(date1.getMonth()+1)+'-'+date1.getDate();
					
					date2.setDate(date2.getDate() + (ui.values[1]-1));
					var date2a = date2.getFullYear()+'-'+(date2.getMonth()+1)+'-'+date2.getDate();
					
					$('#'+containerID+' .desc span.one strong').html(date1a);
					$('#'+containerID+' .desc span.two strong').html(date2a);
			}
		});
	});
}
function initKnob(){
	$('.circleP').each(function() {
		$(this).attr('data-width', $(this).width()).attr('data-height', ($(this).width()+20)).knob();
	});
}
function initPeity(){
	$('span.barP').each(function() {
		$.fn.peity.defaults.bar = {
		  colour: $(this).attr('data-color'),
		  delimeter: ",",
		  height: (($(this).width())-($(this).width()*(50/100))),
		  max: null,
		  min: 0,
		  width: $(this).width()
		}
		$(this).peity("bar");
	});
	$("span.pieP").peity("pie", {
	  colours: function() {
		return ["#dedede", this.getAttribute("data-color")]
	  },
	  diameter: function() {
		return this.getAttribute("data-diameter")
	  }
	});
	
	$('span.lineP').each(function() {
		$.fn.peity.defaults.line = {
		  colour: $(this).attr('data-color'),
		  strokeColour: "rgba(0,0,0,0.6)",
		  delimeter: ",",
		  strokeWidth: 1,
		  height: (($(this).width())-($(this).width()*(50/100))),
		  max: null,
		  min: 0,
		  width: $(this).width()
		}
		$(this).peity("line");
	});
}
function singleLineChart(){
	$('.singleLineChart').each(function() {
		var line1=eval($(this).attr('data-content'));
		var plot1 = $.jqplot($(this).attr('id'), [line1], {
		  animate: !$.jqplot.use_excanvas,
		  seriesColors:[$(this).attr('data-line-color')],
		  axes:{
			xaxis:{
			  renderer:$.jqplot.DateAxisRenderer,
			  tickOptions:{
				formatString:'%b&nbsp;%#d'
			  } 
			},
			yaxis:{
			  tickOptions:{
				formatString:''
				}
			}
		  },
		  highlighter: {
			show: true,
			sizeAdjust: 7.5
		  },
		  cursor: {
			show: false
		  },
			grid: {
				shadow:false,
				backgroundColor: '#ffffff',
				borderWidth: 0,
				gridLineColor: 'rgba(0,0,0,0.4)',
				gridLineWidth: 0.4,
				borderColor: '#ffffff'
			}
		});
  });
}
function barChart(){
	$('.barChart').each(function() {
		plot2 = $.jqplot($(this).attr('id'), eval($(this).attr('data-content')), {
			animate: !$.jqplot.use_excanvas,
			seriesColors:eval($(this).attr('data-bar-colors')),
			seriesDefaults: {
				renderer:$.jqplot.BarRenderer,
				pointLabels: { show: true }
			},
			axes: {
				xaxis: {
					renderer: $.jqplot.CategoryAxisRenderer,
					ticks: eval($(this).attr('data-xaxis'))
				}
			},
			grid: {
				shadow:false,
				backgroundColor: '#ffffff',
				borderWidth: 0,
				gridLineColor: 'rgba(0,0,0,0.4)',
				gridLineWidth: 0.4,
				borderColor: '#ffffff'
			}
		});
	});
}
function barStackedChart(){
	$('.barstackedChart').each(function() {
		plot2 = $.jqplot($(this).attr('id'), eval($(this).attr('data-content')), {
			animate: !$.jqplot.use_excanvas,
			stackSeries: true,
			seriesColors:eval($(this).attr('data-bar-colors')),
			seriesDefaults: {
				renderer:$.jqplot.BarRenderer,
				pointLabels: { show: true }
			},
			axes: {
				xaxis: {
					renderer: $.jqplot.CategoryAxisRenderer,
					ticks: eval($(this).attr('data-xaxis'))
				}
			},
			grid: {
				shadow:false,
				backgroundColor: '#ffffff',
				borderWidth: 0,
				gridLineColor: 'rgba(0,0,0,0.4)',
				gridLineWidth: 0.4,
				borderColor: '#ffffff'
			}
		});
	});
}
function barHChart(){
	$('.barHChart').each(function() {
		plot2 = $.jqplot($(this).attr('id'), eval($(this).attr('data-content')), {
			animate: !$.jqplot.use_excanvas,
			seriesColors:eval($(this).attr('data-bar-colors')),
			seriesDefaults: {
				renderer:$.jqplot.BarRenderer,
				pointLabels: { show: true },
				rendererOptions: {
					barDirection: 'horizontal'
				}
			},
			axes: {
				yaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer
                }
			},
			grid: {
				shadow:false,
				backgroundColor: '#ffffff',
				borderWidth: 0,
				gridLineColor: 'rgba(0,0,0,0.4)',
				gridLineWidth: 0.4,
				borderColor: '#ffffff'
			}
		});
	});
}
function barStackedHChart(){
	$('.barstackedHChart').each(function() {
		plot2 = $.jqplot($(this).attr('id'), eval($(this).attr('data-content')), {
			animate: !$.jqplot.use_excanvas,
			stackSeries: true,
			seriesColors:eval($(this).attr('data-bar-colors')),
			seriesDefaults: {
				renderer:$.jqplot.BarRenderer,
				pointLabels: { show: true },
				rendererOptions: {
					barDirection: 'horizontal'
				}
			},
			axes: {
				yaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer
                }
			},
			grid: {
				shadow:false,
				backgroundColor: '#ffffff',
				borderWidth: 0,
				gridLineColor: 'rgba(0,0,0,0.4)',
				gridLineWidth: 0.4,
				borderColor: '#ffffff'
			}
		});
	});
}
function multiDonutChart(){
	$('.multiDonutChart').each(function() {
		var s1 = eval($(this).attr('data-content'));  
		var plot3 = $.jqplot($(this).attr('id'), [s1], {
			seriesColors:eval($(this).attr('data-pie-colors')),
			seriesDefaults: {
			  renderer:$.jqplot.DonutRenderer,
			  rendererOptions:{
				sliceMargin: 2,
				startAngle: -70,
				showDataLabels: true,
				shadow:false
			  }
			},
			grid: {
				shadow:false,
				backgroundColor: '#ffffff',
				borderWidth: 0,
				borderColor: '#ffffff'
			},
			legend: {show:true,location:''}
		});
  });
}
function multiPieChart(){
	$('.multiPieChart').each(function() {
		var s1 = eval($(this).attr('data-content'));  
		var plot3 = $.jqplot($(this).attr('id'), [s1], {
			seriesColors:eval($(this).attr('data-pie-colors')),
			seriesDefaults: {
			  renderer:$.jqplot.PieRenderer,
			  rendererOptions:{
				showDataLabels: true,
				shadow:false
			  }
			},
			grid: {
				shadow:false,
				backgroundColor: '#ffffff',
				borderWidth: 0,
				borderColor: '#ffffff'
			},
			legend: {show:true,location:''}
		});
  });
}
/** DATATABLES **/
/* Default class modification */
$.extend( $.fn.dataTableExt.oStdClasses, {
	"sWrapper": "dataTables_wrapper form-inline"
} );

/* API method to get paging information */
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
	return {
		"iStart":         oSettings._iDisplayStart,
		"iEnd":           oSettings.fnDisplayEnd(),
		"iLength":        oSettings._iDisplayLength,
		"iTotal":         oSettings.fnRecordsTotal(),
		"iFilteredTotal": oSettings.fnRecordsDisplay(),
		"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
		"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
	};
}

/* Bootstrap style pagination control */
$.extend( $.fn.dataTableExt.oPagination, {
	"bootstrap": {
		"fnInit": function( oSettings, nPaging, fnDraw ) {
			var oLang = oSettings.oLanguage.oPaginate;
			var fnClickHandler = function ( e ) {
				e.preventDefault();
				if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
					fnDraw( oSettings );
				}
			};

			$(nPaging).addClass('pagination').append(
				'<ul>'+
					'<li class="prev disabled"><a href="#"><i class="icon-caret-left"></i></a></li>'+
					'<li class="next disabled"><a href="#"><i class="icon-caret-right"></i></a></li>'+
				'</ul>'
			);
			var els = $('a', nPaging);
			$(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
			$(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
		},

		"fnUpdate": function ( oSettings, fnDraw ) {
			var iListLength = 5;
			var oPaging = oSettings.oInstance.fnPagingInfo();
			var an = oSettings.aanFeatures.p;
			var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

			if ( oPaging.iTotalPages < iListLength) {
				iStart = 1;
				iEnd = oPaging.iTotalPages;
			}
			else if ( oPaging.iPage <= iHalf ) {
				iStart = 1;
				iEnd = iListLength;
			} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
				iStart = oPaging.iTotalPages - iListLength + 1;
				iEnd = oPaging.iTotalPages;
			} else {
				iStart = oPaging.iPage - iHalf + 1;
				iEnd = iStart + iListLength - 1;
			}

			for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
				// Remove the middle elements
				$('li:gt(0)', an[i]).filter(':not(:last)').remove();

				// Add the new list items and their event handlers
				for ( j=iStart ; j<=iEnd ; j++ ) {
					sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
					$('<li '+sClass+'><a href="#">'+j+'</a></li>')
						.insertBefore( $('li:last', an[i])[0] )
						.bind('click', function (e) {
							e.preventDefault();
							oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
							fnDraw( oSettings );
						} );
				}

				// Add / remove disabled classes from the static elements
				if ( oPaging.iPage === 0 ) {
					$('li:first', an[i]).addClass('disabled');
				} else {
					$('li:first', an[i]).removeClass('disabled');
				}

				if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
					$('li:last', an[i]).addClass('disabled');
				} else {
					$('li:last', an[i]).removeClass('disabled');
				}
			}
		}
	}
} );
function initDataTables(){
	$('.dt').each(function() {
		var idnya = $(this).attr('id');
		$('#'+idnya).dataTable({
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span5'i><'span7'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_"
			},
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": linkDatatables,
			"fnServerData": function(sSource, aoData, fnCallback)
            {
				$.ajax({
					'dataType': 'json',
					'type'  : 'POST',
					'url'    : sSource,
					'data'  : aoData,
					'success' : fnCallback
				});
			}
		});
	});
}
function carouselPagination(){
	var currentPage =0;
	$('.carousel.carousel-pagination').carousel();
	$('.carousel-paging a').click(function(q){
		q.preventDefault();
		clickedPage = $(this).attr('rel')-1;
		currentPage = clickedPage-1;
		$('.carousel.carousel-pagination').carousel(clickedPage);
	});
	var pages = $(".carousel-paging a");
	var pagesCount = pages.length;
	$('.carousel.carousel-pagination').on('slide', function(evt) {$(pages).removeClass("btn-primary");currentPage++;currentPage=(currentPage%pagesCount);$(pages[currentPage]).addClass("btn-primary");});
}
function carouselWithThumbnail() {
	$(".carousel-thumbnail .carousel-inner .item img.source-th").each(function(){
		var thImgSource = $(this).attr('src');
		var thSlideId = $(this).attr('data-id');
		$('.carousel-thumbs').append('<img class="carousel-th" src="'+thImgSource+'" rel="'+thSlideId+'" />');
	});
	$('.carousel-thumbs .carousel-th:first-child').addClass('active-th');
	var currentPage =0;
	$('.carousel.carousel-thumbnail').carousel();
	$('.carousel-thumbs img').click(function(q){
		q.preventDefault();
		clickedPage = $(this).attr('rel')-1;
		currentPage = clickedPage-1;
		$('.carousel.carousel-thumbnail').carousel(clickedPage);
	});
	var pages = $(".carousel-thumbs img");
	var pagesCount = pages.length;
	$('.carousel.carousel-thumbnail').on('slide', function(evt) {$(pages).removeClass("active-th");currentPage++;currentPage=(currentPage%pagesCount);$(pages[currentPage]).addClass("active-th");});
}
function initFullCalendar(){
	var input = document.getElementById('eventCalendar');
	if (typeof(input) != 'undefined' && input != null){
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#eventCalendar').fullCalendar({
			editable: false,
			events: eval($('#eventCalendar').attr('data-content')),
			eventClick: function(calEvent, jsEvent, view) {

				var gbrNya, mulaiNya, akhirNya, ketNya;				
				mulaiNya = '<strong>Start:</strong> '+calEvent.start;			
				if(calEvent.end == null || calEvent.end == ''){
					akhirNya = '';
				}else{
					akhirNya = '<br /><strong>End:</strong> '+calEvent.end;
				}
				if(calEvent.imgSrc == null || calEvent.imgSrc == ''){
					gbrNya = '';
				}else{
					gbrNya = '<img class="pull-left img-polaroid span2" style="margin:0 10px 0 0;" src="'+calEvent.imgSrc+'"/>';
				}
				if(calEvent.eventDesc == null || calEvent.eventDesc == ''){
					ketNya = '';
				}else{
					ketNya = calEvent.eventDesc;
				}
				$('#myModalLabel').html(calEvent.title);
				$('#myModalBody').html(gbrNya+'<p>'+mulaiNya+akhirNya+'</p>'+ketNya);
				$('#myModalCal').modal();

			}
		});
		//$('.fc-event-inner.fc-event-skin.label.label-info').hide();
		$('.fc-header-title').append('<span style="display:block;margin-top:-5px;">Click the event list for more info</span>');
	}
}
function masonryInit() {
	var $container = $('.grid-stream');
	$container.imagesLoaded( function(){
		$container.masonry({
			itemSelector: '.lm',
			gutterWidth: 10
		});
	});

};