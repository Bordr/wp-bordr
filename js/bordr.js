var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function stripslashes (str) {
  return (str + '').replace(/\\(.?)/g, function (s, n1) {
    switch (n1) {
    case '\\':
      return '\\';
    case '0':
      return '\u0000';
    case '':
      return '';
    default:
      return n1;
    }
  });
}

function drawbarchart(data, chart) {
	var svg = d3.select(chart)
	  .append('svg')
	  .attr('width', '100%')
	  .attr('height', '75px')
	  .append('g');
	var abbrevNum = function(d) {
	  var prefix = d3.formatPrefix(d);
	  return d3.round(prefix.scale(d), 1) + prefix.symbol;
	};

	var draw = function(data) {
	var width, height, max, marLeft;
	  marLeft = 0;
	  width = d3.select(chart)[0][0].offsetWidth;
	  height = 0;
	  var barColor = function(value) {
		var color;
		if (value > data.totalAverage) {
		  color = '#4EC7BD';
		} else {
		  color = '#E57373';
		}
		return color;
	  };
	  var scale = d3.scale.linear()
		.domain([data.totalMin, data.totalMax])
		.range([0 + 5, width]);

	  svg.attr('height', height);

	  svg.selectAll('rect')
		.attr('class', 'bam')
		.attr('width', width - marLeft)
		.attr('x',marLeft)
		.attr('fill', '#646677');
	  svg.append('rect')
		.attr('fill', '#69C568')
		.attr('height', 40)
		.attr('width', 0)
		.attr('x', marLeft)
		.attr('y', 0)
		.transition()
		.duration(1000)
		.attr('width', scale(data.postTotal));

	  svg.append('text')
		.attr('class', 'x-axis')
		.attr('y', 56)
		.attr('x', marLeft)
		.text(data.leftField+' (' + abbrevNum(data.totalMin) + ')');
	  svg.append('text')
		.attr('class', 'x-axis')
		.attr('y', 56)
		.attr('x', width)
		.attr('text-anchor', 'end')
		.text(data.rightField+' (' + abbrevNum(data.totalMax) +')');
	 svg.insert('rect', ':first-child')
		.attr('height', 40)
		.attr('width', width - marLeft)
		.attr('fill', '#f1f6f8')
		.attr('x',marLeft)
		.attr('y', 0);
	};
	
	draw(data);

}

function drawdotchart(data, chart) {
	var svg = d3.select(chart)
	  .append('svg')
	  .attr('width', '100%')
	  .attr('height', '70px')
	  .append('g');
	var abbrevNum = function(d) {
	  var prefix = d3.formatPrefix(d);
	  return d3.round(prefix.scale(d), 1) + prefix.symbol;
	};

	var draw = function(data) {
	var width, height, max, marLeft;
	  marLeft = 10;
	  width = d3.select(chart)[0][0].offsetWidth-10;
	  fullwidth = d3.select(chart)[0][0].offsetWidth;
	  height = 0;
	  var barColor = function(value) {
		var color;
		if (value > data.totalAverage) {
		  color = '#4EC7BD';
		} else {
		  color = '#E57373';
		}
		return color;
	  };
	  var scale = d3.scale.linear()
		.domain([data.totalMin, data.totalMax])
		.range([0 + 10, width]);

	  svg.attr('height', height);

	  svg.selectAll('rect')
		.attr('class', 'bam')
		.attr('width', width - marLeft)
		.attr('x',marLeft)
		.attr('fill', '#646677');
	  svg.append('circle')
		.attr('fill', '#ffd200')
		.attr('cx', marLeft)
		.attr('cy', 20)
		.attr('r', 10)
		.transition()
		.duration(2000)
		.attr('cx', scale(data.postTotal));

	  svg.append('text')
		.attr('class', 'x-axis')
		.attr('y', 45)
		.attr('x', 0)
		.attr('fill', '#646677')
		.text(data.leftField);
	  svg.append('text')
		.attr('class', 'x-axis')
		.attr('y', 45)
		.attr('x', fullwidth)
		.attr('text-anchor', 'end')
		.attr('fill', '#646677')
		.text(data.rightField);
	 svg.insert('rect', ':first-child')
		.attr('height', 2)
		.attr('width', fullwidth)
		.attr('fill', '#f1f6f8')
		.attr('x',0)
		.attr('y', 20);
	};
	
	draw(data);

}

function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

	 function renderMyBordrs(filter,value) {

		// vars
		var url = '/bordr/';
			args = {};

		// loop over filters
		$('.selFilter').each(function(){
			// vars
			var filter = $(this).data('filter'),
				vals = $(this).data(filter);
			// append to args
			args[ filter ] = vals;
			
			if (filter == 'perception') {
				// vars
				var filter = 'perceptionval',
					vals = $(this).data(filter);
				// append to args
				args[ filter ] = vals;			
			}
		});
		
		// update url
		url += '?';
		// loop over args
		$.each(args, function( name, value ){
			if ((name != 'perceptionval' && value == undefined) || name == 'undefined') {}
			else {
				url += name + '=' + value + '&';
			}
		});
		// remove last &
			url = url.slice(0, -1);
		// reload page
		window.location.replace( url );
// 		console.log(url);
	 }

	 function renderMyDepartures(filter,value) {

		// vars
		var url = '/';
			args = {};

		// loop over filters
		$('.selFilter').each(function(){
			// vars
			var filter = $(this).data('filter'),
				vals = $(this).data(filter);
			// append to args
			args[ filter ] = vals;
			
			if (filter == 'char') {
				// vars
				var filter = 'charval',
					vals = $(this).data(filter);
				// append to args
				args[ filter ] = vals;			
			}
		});
		
		// update url
		url += '?';
		// loop over args
		$.each(args, function( name, value ){
			if ((name != 'charval' && value == undefined) || name == 'undefined') {}
			else {
				url += name + '=' + value + '&';
			}
		});
		// remove last &
			url = url.slice(0, -1);
		// reload page
		window.location.replace( url );
// 		console.log(url);
	 }

function ValidURL(str) {
 var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
  '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
  '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
  '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
  '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
  '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
  if(!pattern.test(str)) {
    return false;
  } else {
    return true;
  }
}

	var mobileWidth = 768;
	
	var url = window.location.pathname;
		url = url.split("/");
	var bdborder = url[2];
	var pathc = window.location.pathname.split('/').length - 1;

jQuery(document).ready(function() {

	$('.btn-facebook').on('click', function() {
		FB.login();
	});

	$('.fbLogout').on('click', function() {
		FB.logout(function(response) { $.removeCookie("user"); window.location.replace("http://globalgrandcentral.net/"); } );
	});

	$("#addBordr").click(function(){
		$('#post').modal('show');
	});

	$('.nav li').on('click', function() {
		$('.nav li').removeClass('active');
		$(this).addClass('active');
		 	
	});
	
	$('.navbar-nav').on('click', 'a', function () {
	  if (window.innerWidth <= mobileWidth) {
		 var navMain = $(".navbar-collapse");

		 navMain.on("click", "a", null, function () {
			 navMain.collapse('hide');
		 });    
	  }
	})

	$('.nav li').on('click', function() {
		$('.nav li').removeClass('active');
		$(this).addClass('active');
		 	
	});

	$('.dropdown-toggle').dropdown();
	
	$('#brdractmenu li > a').click(function(e){
		$('#brdract').html(this.innerHTML+' <span class="caret"></span>');
		$('#actfilter').html(this.innerHTML);
		$('#brdract').addClass('selFilter');
		$('#brdract').attr('data-filter',$(this).data('filter'));
		$('#brdract').attr('data-relact',$(this).data('relact'));
		renderMyBordrs($(this).data('relact'),'');
	});
	
	$('#brdrperceptionmenu li > a').click(function(e){
		$('#brdrperception').html(this.innerHTML+' <span class="caret"></span>');
		$('#perceptionfilter').html(this.innerHTML);
		$('#brdrperception').addClass('selFilter');
		$('#brdrperception').attr('data-filter',$(this).data('filter'));
		$('#brdrperception').attr('data-perception',$(this).data('perception'));
		$('#brdrperception').attr('data-perceptionval',$(this).data('perceptionval'));
		renderMyBordrs($(this).data('perception'),$(this).data('perceptionval'));
	});

	$('#depstatmenu li > a').click(function(e){
		if ($(this).data('station') > 0) {
			$('#depstat').html(this.innerHTML+' <span class="caret"></span>');
			$('#stationfilter').html(this.innerHTML);
			$('#depstat').addClass('selFilter');
			$('#depstat').attr('data-filter',$(this).data('filter'));
			$('#depstat').attr('data-station',$(this).data('station'));
			renderMyDepartures($(this).data('station'),'');
		} else {
			$('#depstat').html(this.innerHTML+' <span class="caret"></span>');
			$('#ctryfilter').html(this.innerHTML);
			$('#depstat').addClass('selFilter');
			$('#depstat').attr('data-filter',$(this).data('filter'));
			$('#depstat').attr('data-ctry',$(this).data('ctry'));
			renderMyDepartures($(this).data('ctry'),'');		
		}
	});

	$('#depmetmenu li > a').click(function(e){
		$('#depmet').html(this.innerHTML+' <span class="caret"></span>');
		$('#methodfilter').html(this.innerHTML);
		$('#depmet').addClass('selFilter');
		$('#depmet').attr('data-filter',$(this).data('filter'));
		$('#depmet').attr('data-method',$(this).data('method'));
		renderMyDepartures($(this).data('method'),'');
	});
	
	$('#depcharmenu li > a').click(function(e){
		$('#depchar').html(this.innerHTML+' <span class="caret"></span>');
		$('#charfilter').html(this.innerHTML);
		$('#depchar').addClass('selFilter');
		$('#depchar').attr('data-filter',$(this).data('filter'));
		$('#depchar').attr('data-char',$(this).data('char'));
		$('#depchar').attr('data-charval',$(this).data('charval'));
		renderMyDepartures($(this).data('char'),$(this).data('charval'));
	});

	embedVids();
	
});


function embedVids() {

	var pattern1 = /(?:http?s?:\/\/)?(?:www\.)?(?:vimeo\.com|player\.vimeo\.com\/video)\/?([^\< ]+)/g;
	var pattern2 = /(?:http?s?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?([^\< ]+)/g;
	
	$(".bordr p:contains('vimeo.com')").each(function(i, el){

	   var replacement = '<iframe width="420" height="345" src="//player.vimeo.com/video/$1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	   
	   var found = $(this).html().replace(pattern1, replacement);
	   var video = $(found).filter('iframe');
	   $(this).closest('article').find('img:first').replaceWith(video);

	   var story = $(this).html().replace(pattern1, "");
	   $(this).replaceWith(story);

	});

	$(".bordr p:contains('youtu')").each(function(i, el){

	   var replacement = '<iframe width="420" height="345" src="https://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>';
	   
	   var found = $(this).html().replace(pattern2, replacement);
	   var video = $(found).filter('iframe');
	   $(this).closest('article').find('img:first').replaceWith(video);

	   var story = $(this).html().replace(pattern2, "");
	   $(this).replaceWith(story);

	});

}

// END VIDEO EMBED CODE

	 jQuery(document).ready(function() {
	 	var stationval = getUrlParameter('station');
	 	var ctryval = getUrlParameter('ctry');
	 	if (stationval) {
			$('#depstat').addClass('selFilter');
			$('#depstat').attr('data-filter',$('*[data-station="'+stationval+'"]').data('filter'));
			$('#depstat').attr('data-station',$('*[data-station="'+stationval+'"]').data('station'));
	 	} else if (ctryval) {
		 	var ctrtext = $('*[data-ctry="'+ctryval+'"]').html();
	 		$('#depstat').html(ctrtext+' <span class="caret"></span>');
			$('#depstat').addClass('selFilter');
			$('#depstat').attr('data-filter',$('*[data-ctry="'+ctryval+'"]').data('filter'));
			$('#depstat').attr('data-ctry',$('*[data-ctry="'+ctryval+'"]').data('ctry'));
	 	}

	 	var charv = getUrlParameter('char');
	 	var charval = getUrlParameter('charval');
	 	if (charv && charval) {
	 		var chartext = $('*[data-char="'+charv+'"][data-charval="'+charval+'"]').html();
	 		$('#depchar').html(chartext+' <span class="caret"></span>');
			$('#depchar').addClass('selFilter');
			$('#depchar').attr('data-filter',$('*[data-char="'+charv+'"][data-charval="'+charval+'"]').data('filter'));
			$('#depchar').attr('data-charval',charval);
			$('#depchar').attr('data-char',charv);
	 	}

	 	var perceptionv = getUrlParameter('perception');
	 	var perceptionval = getUrlParameter('perceptionval');
	 	if (perceptionv && perceptionval) {
	 		var perceptiontext = $('*[data-perception="'+perceptionv+'"][data-perceptionval="'+perceptionval+'"]').html();
	 		$('#brdrperception').html(perceptiontext+' <span class="caret"></span>');
			$('#brdrperception').addClass('selFilter');
			$('#brdrperception').attr('data-filter',$('*[data-perception="'+perceptionv+'"][data-perceptionval="'+perceptionval+'"]').data('filter'));
			$('#brdrperception').attr('data-perceptionval',perceptionval);
			$('#brdrperception').attr('data-perception',perceptionv);
	 	}

	 	var methodv = getUrlParameter('method');
	 	if (methodv) {
			$('#depmet').addClass('selFilter');
	 		var mettext = $('*[data-method="'+methodv+'"]').html();
			$('#depmet').html(mettext+' <span class="caret"></span>');
			$('#depmet').attr('data-filter',$('*[data-method="'+methodv+'"]').data('filter'));
			$('#depmet').attr('data-method',$('*[data-method="'+methodv+'"]').data('method'));
	 	}

	 });
	 	
	(function($) {
	
		// setup fields
		acf.do_action('append', $('#popup-id'));
	
	})(jQuery);	
	
	jQuery(document).ready(function($) {
		// set the container that Masonry will be inside of in a var
		if (document.querySelector('#masonryb')) {
		var container = document.querySelector('#masonryb');

		// create empty var msnry
		var msnry;

		// initialize Masonry after all images have loaded
		imagesLoaded( container, function() {
			msnry = new Masonry( container, {
				itemSelector: '.masonry-item'
			});
		});
		}
	});