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
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Ates Goral (http://magnetiq.com)
  // +      fixed by: Mick@el
  // +   improved by: marrtins
  // +   bugfixed by: Onno Marsman
  // +   improved by: rezna
  // +   input by: Rick Waldron
  // +   reimplemented by: Brett Zamir (http://brett-zamir.me)
  // +   input by: Brant Messenger (http://www.brantmessenger.com/)
  // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
  // *     example 1: stripslashes('Kevin\'s code');
  // *     returns 1: "Kevin's code"
  // *     example 2: stripslashes('Kevin\\\'s code');
  // *     returns 2: "Kevin\'s code"
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

function renderIndex() {
	$.ajax({
		url: "/data/d-index.php",
		type: "GET",
		cache: true,
		dataType: "json",
		success: function (data) {
				
			$('#itemBestBorder').html(data[0][0].border);
			$('#itemBestStat').html(data[0][0].cqi);

			$('#itemWorstBorder').html(data[1][0].border);
			$('#itemWorstStat').html(data[1][0].cqi);
			
			$('.indexBorder').wrapInner(function() {
			   var link = $('<a/>');
			   link.attr('href', '/border/'+slug($(this).text())+'/');
			   return link;
			});
			
			$(data).each(function(i, el){
				$.ajax({
					url: "/data/d-border.php",
					data: 'bdr='+slug(data[i][0].border).replace('raquo-', ''),
					type: 'GET',
					cache: false,
					dataType: "json",
					success: function (bdata) {
		
						$(bdata[0]).each(function(n, el){
						
							if (i===0){
								$('#itemBestBorderImgs').append('<img src="'+bdata[0][n].img+'"></img>');
							} else {
								$('#itemWorstBorderImgs').append('<img src="'+bdata[0][n].img+'"></img>');
							}
							
						});
							
					},
					error: function(model, response) {
						console.log(response.responseText);
					}
				});
			});
			
			// RENDER RECENT
			$.ajax({
				url: "/data/d-recent.php",
				cache: true,
				dataType: "json",
				success: function (bdata) {
	
				$(bdata[0]).each(function(n, el){
				
					$('#itemRecentImgs').append('<img src="'+bdata[0][n].img+'"></img>');
					$('#itemChange').append(bdata[0][n].border+' | ');
				});
						
				},
				error: function(model, response) {
					console.log(response.responseText);
				}
			});
			
			renderList();
					
		},
		error: function(model, response) {
			console.log(response.responseText);
		}
	});
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

function renderList () {
  $('.listTops').html('');
	$.ajax({
		url: "/data/d-dash.php",
		type: "GET",
		cache: false,
		dataType: "json",
		success: function (data) {
				
// 			arrayToTable.setTable('tblvisi', data[0]);
// 			arrayToTable.setTable('tblposi', data[1]);
// 			arrayToTable.setTable('tblimpo', data[2]);
// 			arrayToTable.setTable('tblarti', data[3]);
// 			arrayToTable.setTable('tbltim', data[4]);
// 			arrayToTable.setTable('tblmon', data[5]);
// 			arrayToTable.setTable('tblris', data[6]);
			
			var tblvisi = "<div class='row'>";
			$.each(data[0], function(key,value){  
			 var link = "";
			 link+= '<div class="col-sm-2 col-md-2"><div class="thumbnail"><a href="/border/'+slug(this.border)+'/">';
			 link+= '<img src="'+this.image+'" />';
			 link+= '<div class="caption"><h3>'+this.rank+'</h3><p>'+this.border+'</p></div>';
			 link+= '</a></div></div>';
			 tblvisi+=link;
			});
			tblvisi += "</div>";
			$('#tblvisi').append(tblvisi);

			var tblposi = "<div class='row'>";
			$.each(data[1], function(key,value){  
			 var link = "";
			 link+= '<div class="col-md-2"><div class="thumbnail"><a href="/border/'+slug(this.border)+'/">';
			 link+= '<img src="'+this.image+'" />';
			 link+= '<div class="caption"><h3>'+this.rank+'</h3><p>'+this.border+'</p></div>';
			 link+= '</a></div></div>';
			 tblposi+=link;
			});
			tblposi += "</div>";
			$('#tblposi').append(tblposi);
			
			var tblimpo = "<div class='row'>";
			$.each(data[2], function(key,value){  
			 var link = "";
			 link+= '<div class="col-md-2"><div class="thumbnail"><a href="/border/'+slug(this.border)+'/">';
			 link+= '<img src="'+this.image+'" />';
			 link+= '<div class="caption"><h3>'+this.rank+'</h3><p>'+this.border+'</p></div>';
			 link+= '</a></div></div>';
			 tblimpo+=link;
			});
			tblimpo += "</div>";
			$('#tblimpo').append(tblimpo);
			
			var tblarti = "<div class='row'>";
			$.each(data[3], function(key,value){  
			 var link = "";
			 link+= '<div class="col-md-2"><div class="thumbnail"><a href="/border/'+slug(this.border)+'/">';
			 link+= '<img src="'+this.image+'" />';
			 link+= '<div class="caption"><h3>'+this.rank+'</h3><p>'+this.border+'</p></div>';
			 link+= '</a></div></div>';
			 tblarti+=link;
			});
			tblarti += "</div>";
			$('#tblarti').append(tblarti);
			
			var tbltim = "<div class='row'>";
			$.each(data[4], function(key,value){  
			 var link = "";
			 link+= '<div class="col-md-2"><div class="thumbnail"><a href="/border/'+slug(this.border)+'/">';
			 link+= '<img src="'+this.image+'" />';
			 link+= '<div class="caption"><h3>'+this.rank+'</h3><p>'+this.border+'</p></div>';
			 link+= '</a></div></div>';
			 tbltim+=link;
			});
			tbltim += "</div>";
			$('#tbltim').append(tbltim);
			
			var tblmon = "<div class='row'>";
			$.each(data[5], function(key,value){  
			 var link = "";
			 link+= '<div class="col-md-2"><div class="thumbnail"><a href="/border/'+slug(this.border)+'/">';
			 link+= '<img src="'+this.image+'" />';
			 link+= '<div class="caption"><h3>'+this.rank+'</h3><p>'+this.border+'</p></div>';
			 link+= '</a></div></div>';
			 tblmon+=link;
			});
			tblmon += "</div>";
			$('#tblmon').append(tblmon);
			
			var tblris = "<div class='row'>";
			$.each(data[6], function(key,value){  
			 var link = "";
			 link+= '<div class="col-md-2"><div class="thumbnail"><a href="/border/'+slug(this.border)+'/">';
			 link+= '<img src="'+this.image+'" />';
			 link+= '<div class="caption"><h3>'+this.rank+'</h3><p>'+this.border+'</p></div>';
			 link+= '</a></div></div>';
			 tblris+=link;
			});
			tblris += "</div>";
			$('#tblris').append(tblris);
			
			var url = window.location.pathname;
				url = url.split("/");
			var bdvar = url[2];

			var pathed = window.location.pathname.split('/').length - 1;
			
			if (pathed> 2 && isNaN(bdvar)) {
				$(".page").hide();
				$('#border').fadeIn();
				$('.nav li').removeClass('active');
				$('.nav li a[href^="#border"]').parent('li').addClass('active');
			} else if (pathed> 2) {
				$(".page").hide();
				$('#crossing').fadeIn();
				$('.nav li').removeClass('active');
				$('.nav li a[href^="#border"]').parent('li').addClass('active');
			} else if (window.location.hash == '#border') {
				$(".page").hide();
				$('#dashboard').fadeIn();
				$('.nav li').removeClass('active');
				$('.nav li a[href^="#border"]').parent('li').addClass('active');
			} else if (url[1] === 'border') {
			} else if (url[1] === 'c') {
				renderCard();
			} else if (window.location.hash == '') {
				$(".page").hide();
// 				renderMyCrossings();
				$('#profile').fadeIn();
			} else {
				identifier = window.location.hash;
				$(identifier).fadeIn();
				$('.nav li').removeClass('active');
				$('.nav li a[href^="' + identifier + '"]').parent('li').addClass('active');
			}		
		},
		error: function(model, response) {
			console.log(response.responseText);
		}
	});
}

function renderPost() {

	var url = window.location.pathname;
		url = url.split("/");
	var bdcrossing = url[2];
	var pathc = window.location.pathname.split('/').length - 1;
	
	$.cookie('currentcrossing',bdcrossing);

	if (pathc > 2) {
		$.ajax({
		url: "/data/d-post.php",
		data: 'cro='+bdcrossing,
		type: 'GET',
		cache: false,
		dataType: "json",
		success: function (data) {
		
			$('#crossingname').html('<a href="/border/'+data[0][0].slug+'/">'+data[0][0].border+' crossing</a> <small>at '+data[0][0].loc_date+'</small>');
			$('#crossingimage').html("<img src="+data[0][0].img+" class='img-responsive'/>");
			$('#crossingstory').html(stripslashes(data[0][0].loc_desc));
			
			$(data[1]).each(function(i, el){
				$('#crossingstorydetails').append(data[1][i].det_embed+ '<p>'+data[1][i].det_desc + '</p>');
			});
			
			if (data[0][0].device == $.cookie('user')) {
				$('#postDetails').show();
			}
			
			$.cookie('y_from',data[0][0].loc_from);
			$.cookie('z_from',data[0][0].loc_to);	
			
 			getPostStats(bdcrossing);
						
		},
		error: function(model, response) {
			console.log(response.responseText);
		}
	});
	}
	
	if ($('#crossingstorydetails').is(':empty')){
	
		$('#lblcrossingstorydetails').hide();
	
	}

}

function renderCrossing() {

	var url = window.location.pathname;
		url = url.split("/");
	var bdborder = url[2];
	var pathc = window.location.pathname.split('/').length - 1;

	if (isNaN(bdborder)) {
	
		if (pathc > 2) {
			$.ajax({
			url: "/data/d-border.php",
			data: 'bdr='+bdborder,
			type: 'GET',
			cache: false,
			dataType: "json",
			success: function (data) {
		
				$('#bordername').html(data[0][0].border+' border');
				$.cookie('y_from',data[0][0].loc_from);
				$.cookie('z_from',data[0][0].loc_to);	
		
				$(data[0]).each(function(i, el){
	// 				console.log(data[i]);
					$('#bdrCarousel .carousel-indicators').append('<li data-target="#bdrCarousel" data-slide-to="'+i+'"></li>');
					$('#bdrCarousel .carousel-inner').append('<div class="item"><a href="/crossing/'+data[0][i].id+'/"><div class="inner-item" style="background: url(\''+data[0][i].img+'\');background-size: cover;"></div></a><div class="carousel-caption">'+stripslashes(data[0][i].loc_desc)+'</div></div>');
				});

				if (data.map) {			
					$('#bordermap').append("<img src='"+data.map+"' class='img-responsive'/>");
				} else {
					$('#bordermap').hide();				
					$('#bordermap').prev().hide();
				}
			
				$("#bdrCarousel .carousel-inner div:first-child").addClass("active");
				$("#bdrCarousel .carousel-indicators li:first-child").addClass("active");

				if (bdborder != '') {
	// 				console.log(bdborder+'bb');
					getBorderStats(bdborder);
// 					renderBorderRelated();
				}		
									
			},
			error: function(model, response) {
				console.log(response.responseText);
			}
		});
		}
		
	
	} else {

		renderPost();

	}
}

function renderBorderRelated() {

	var url = window.location.pathname;
		url = url.split("/");
	var bdborder = url[2];
	var pathc = window.location.pathname.split('/').length - 1;

	var bdname = $('#bordername').html();
	
	var id = 0;

	if (isNaN(bdborder)) {
	
		if (pathc > 2) {
			$.ajax({
			url: "/data/d-border-related.php",
			data: 'bdr='+bdborder,
			type: 'GET',
			cache: false,
			dataType: "json",
			success: function (data) {
		
// 				$('#relatedborders').html(data[0][0].border);
		
				$(data).each(function(i, el){
	// 				console.log(data[i]);
					if (i==0 || i==4) { $('#relatedborders').append('<div class="row" id="brow'+id+'">'); idd=id; id++; }
					$('#brow'+idd+'').append('<div class="col-sm-3 col-md-3"> <a class="thumbnail" href="/border/'+data[i].slug+'/"> <img src="'+data[i].img+'"> <div class="captiontitle '+data[i].css+'"><b>'+data[i].metric+'</b></div> <div class="caption"><h5>'+stripslashes(data[i].border)+'</h5>  </div> </a> </div>');
				});
				$('#relatedborders').append('</div>');
					
			},
			error: function(model, response) {
				console.log(response.responseText);
			}
		});
		}
		
	
	} 
}

function getPostStats(postID) {

	d3.json('/crossing-data/d-poststats.php?cr='+postID, function(data){
	   nv.addGraph(function() {
		 var chart = nv.models.multiBarHorizontalChart()
			 .margin({top: 30, right: 20, bottom: 50, left: 90})
			 .x(function(d) { return d.label; })
			 .y(function(d) { return d.value })
			 .forceY([0, 100])
			 .showValues(false)
			 .tooltips(false)
			 .showControls(false);
			 
		var tickMarks = [0,24,50,75,100];
		
		chart.yAxis
			.tickValues(tickMarks)
			.tickFormat(function(d){ return d });
  
		 d3.select('#crossingmetric svg')
			 .datum(data)
		   .transition().duration(500)
			 .call(chart);
 
		 nv.utils.windowResize(chart.update);
 
		 return chart;
	   });
	});
	$('.nv-series:eq(1)').attr("transform","103,5");
	
}

function getCardStats(postID) {

	d3.json('/crossing-data/d-poststats.php?cd='+postID, function(data){
	   nv.addGraph(function() {
		 var chart = nv.models.multiBarHorizontalChart()
			 .margin({top: 0, right: 8, bottom: 12, left: 70})
			 .x(function(d) { return d.label; })
			 .y(function(d) { return d.value })
			 	.barColor(function(d) { return d.barColor; })
			 .forceY([0, 100])
			 .showValues(false)
			 .tooltips(false)
			 .showLegend(false)
			 .showControls(false);
			 
		var tickMarks = [0,24,50,75,100];
		
		chart.yAxis
			.tickValues(tickMarks)
			.tickFormat(function(d){ return d });
  
		 d3.select('#cardmetrics')
			 .datum(data)
		   .transition().duration(500)
			 .call(chart);
 
		 nv.utils.windowResize(chart.update);
 
		 return chart;
	   });
	});
// 	$('.nv-series:eq(1)').attr("transform","103,5");
	
}

function getFeedCardStats() {

	$('.cardsm').each(function(i,el) {
	
		var id = $(el).data('bid');

	d3.json('/crossing-data/d-poststats.php?cd='+id, function(data){
	   nv.addGraph(function() {
		 var chart = nv.models.multiBarHorizontalChart()
			 .margin({top: 0, right: 8, bottom: 12, left: 70})
			 .x(function(d) { return d.label; })
			 .y(function(d) { return d.value })
			 	.barColor(function(d) { return d.barColor; })
			 .forceY([0, 100])
			 .showValues(false)
			 .tooltips(false)
			 .showLegend(false)
			 .showControls(false);
			 
		var tickMarks = [0,24,50,75,100];
		
		chart.yAxis
			.tickValues(tickMarks)
			.tickFormat(function(d){ return d });
  
		 d3.select('#cardsm'+id+'')
			 .datum(data)
		   .transition().duration(500)
			 .call(chart);
 
		 nv.utils.windowResize(chart.update);
 
		 return chart;
	   });
	});
// 	$('.nv-series:eq(1)').attr("transform","103,5");
	});
}

function getBorderStatsB(border) {

	d3.json('/data/dcrossb.json', function(data){	
		nv.addGraph(function() {
		 var chart = nv.models.lineChart();
 
		 chart.xAxis
			 .tickFormat(function(d) { return d3.time.format('%x')(new Date(d)) });
 
		 chart.yAxis
			 .tickFormat(d3.format(',.2f'));
			 
// 		 chart.line
// 		 	.interpolate("basis");
 
		 d3.select('#stats svg')
		   .datum(data)
			 .transition().duration(500).call(chart);
 
		 nv.utils.windowResize(chart.update);
 
		 return chart;
	   });
	});

}

function getBorderStats(border) {
// 	console.log(border);
	var margin = {top: 20, right: 200, bottom: 30, left: 50},
		width = 960 - margin.left - margin.right,
		height = 500 - margin.top - margin.bottom;

	var parseDate = d3.time.format("%Y-%m-%d").parse;

	var x = d3.time.scale()
		.range([0, width]);

	var y = d3.scale.linear()
		.range([height, 0]);

	var color = d3.scale.category10();

	var xAxis = d3.svg.axis()
		.scale(x)
		.orient("bottom");

	var yAxis = d3.svg.axis()
		.scale(y)
		.orient("left");

	var line = d3.svg.line()
		.interpolate("basis")
		.x(function(d) { return x(d.date); })
		.y(function(d) { return y(d.metric); });

	var svg = d3.select("#stats svg")
	  .append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

	d3.json('/data/d-crossing.php?cr='+border, function(data){
	
 	  color.domain(d3.keys(data[0][0]));

	  var lastdate;

	  data[0].forEach(function(d) {
		d.ldate = parseDate(d.ldate);
		lastdate = d.ldate;
	  });

	  if(data[0][0].ldate != lastdate) {

		  var bborder = color.domain().map(function(name) {
			return {
			  name: name,
			  values: data[0].map(function(d) {
				return {date: d.ldate, metric: +d[name]};
			  })
			};
		  });
				bborder.splice(0,1);
	// 	  		console.log(bborder);

		  x.domain(d3.extent(data[0], function(d) { return d.ldate; }));

		  y.domain([
			d3.min(bborder, function(c) { return d3.min(c.values, function(v) { return v.metric; }); }),
			d3.max(bborder, function(c) { return d3.max(c.values, function(v) { return v.metric; }); })
		  ]);
	  
		var legend = svg.selectAll('g')
			.data(bborder)
			.enter()
		  .append('g')
			.attr('class', 'legend');

		legend.append('rect')
			.attr('x', width + 20)
			.attr('y', function(d, i){ return i *  30;})
			.attr('width', 10)
			.attr('height', 10)
			.style('fill', function(d) { 
			  return color(d.name);
			});

		legend.append('text')
			.attr('x', width + 35)
			.attr('y', function(d, i){ return (i *  30) + 9;})
			.text(function(d){ return d.name; });		  


		  svg.append("g")
			  .attr("class", "x axis")
			  .attr("transform", "translate(0," + height + ")")
			  .call(xAxis);

		  svg.append("g")
			  .attr("class", "y axis")
			  .call(yAxis)
			.append("text")
			  .attr("class", "highlow")
			  .attr("transform", "rotate(0)")
			  .attr("x", 40)
			  .attr("y", 15)
			  .attr("dy", ".71em")
			  .style("text-anchor", "end")
			  .text("High");

		  svg.append("g")
			  .attr("class", "y axis")
			  .call(yAxis)
			.append("text")
			  .attr("class", "highlow")
			  .attr("transform", "rotate(0)")
			  .attr("x", 40)
			  .attr("y", height - 15)
			  .attr("dy", ".71em")
			  .style("text-anchor", "end")
			  .text("Low");
		  
		  var city = svg.selectAll(".city")
			  .data(bborder)
			.enter().append("g")
			  .attr("class", "city");

	// 	  console.log(city);

		  city.append("path")
			  .attr("class", "line")
			  .attr("d", function(d) { return line(d.values); })
			  .style("stroke", function(d) { return color(d.name); });

	// 	  city.append("text")
	// 		  .datum(function(d) { return {name: d.name, value: d.values[0]}; })
	// 		  .attr("transform", function(d) { return "translate(" + x(d.value.date) + "," + y(d.value.metric) + ")"; })
	// 		  .attr("x", 3)
	// 		  .attr("dy", ".35em")
	// 		  .text(function(d) { return d.name; });

		} else {
			$('#stats').prev().hide();
			$('#stats').hide();
		}	  
	});

}

function activatePostBtn() {


		var empty = false;
		$('.required').each(function() {
			if ($(this).val().length == 0) {
				empty = true;
			}
		});

// 		if (!$('.preview').is('*') && $('#output').val().length == 0) {
// 			empty = true;
// 		}
		
		if(!$("#cccheck").is(':checked')){
			 empty = true;                           
		}

		if (empty) {
			$('#btnStartPost').addClass('disabled');
		} else {
			$('#btnStartPost').removeClass('disabled');
		}

}

var slug = function(str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();

  // remove accents, swap ñ for n, etc
  var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
  var to   = "aaaaaeeeeeiiiiooooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  str = str
  	.replace(/[^a-z0-9 -]/g, '-x-') // remove invalid chars
  	.replace(/raquo/g,'')
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return str;
};

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
		FB.logout(function(response) { $.removeCookie("user"); window.location.replace("http://europegrandcentral.net/"); } );
	});

	$("#addBordr").click(function(){
		$('#post').modal('show');
	});

	$('#post').on('shown.bs.modal', function () {
		$('#brdr_to').focus();
	})
	
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

	$('#post').on('show.bs.modal', function (e) {

		$('#post.acf-form').show();

		$('.modal-dialog').css('padding','40px 0px');
		
		$(".canvas").css('width','100%');

		$('#post').on('scroll', function (e) {
			google.maps.event.trigger(window, 'resize', {});
		});

		$(".highlight-track").width('250px');
		$(".dragger").css('left','250px');

		console.log("open posting");

// 		$('.slider').slider();
	

	})


	
	$('.dropdown-toggle').dropdown();
	
	$('#brdractmenu li > a').click(function(e){
		$('#brdract').html(this.innerHTML+' <span class="caret"></span>');
		$('#actfilter').html(this.innerHTML);
		$('#brdract').addClass('selFilter');
		$('#brdract').attr('data-filter',$(this).data('filter'));
		$('#brdract').attr('data-relact',$(this).data('relact'));
		renderMyBordrs($(this).data('relact'),'');
	});
	
	$('#brdrcharmenu li > a').click(function(e){
		$('#brdrchar').html(this.innerHTML+' <span class="caret"></span>');
		$('#charfilter').html(this.innerHTML);
		$('#brdrchar').addClass('selFilter');
		$('#brdrchar').attr('data-filter',$(this).data('filter'));
		$('#brdrchar').attr('data-char',$(this).data('char'));
		$('#brdrchar').attr('data-charval',$(this).data('charval'));
		renderMyBordrs($(this).data('char'),$(this).data('charval'));
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

	   var replacement = '<iframe width="420" height="345" src="//player.vimeo.com/video/$1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	   
	   var found = $(this).html().replace(pattern2, replacement);
	   var video = $(found).filter('iframe');
	   $(this).closest('article').find('img:first').replaceWith(video);

	   var story = $(this).html().replace(pattern2, "");
	   $(this).replaceWith(story);

	});

}

// END VIDEO EMBED CODE

var geo_lat = "58.335901420448806";
var geo_lng = "12.322883605957031";

function handleGetCurrentPosition(location){

	geo_lat = location.coords.latitude;
	geo_lng = location.coords.longitude;

	if ($.cookie('geoloc')) {
		prev_geoloc = $.cookie('geoloc').split(",");
		if (prev_geoloc) {
			var prev_lat = prev_geoloc[0];
			var prev_lng = prev_geoloc[1];
		}
	}
	
	console.log(geo_lat+", "+geo_lng);

	$("#geolat").val(geo_lat);
	$("#geolng").val(geo_lng);	
	$("#loc_latlng").val(geo_lat+", "+geo_lng);

	if (typeof prev_lat === 'undefined') {
		
		console.log('no previous log');
		var geo_loc = [];
		geo_loc[0] = geo_lat;
		geo_loc[1] = geo_lng;
		$.cookie("geoloc", geo_loc);
	
	} else if (getDistance(geo_lat, geo_lng, prev_lat, prev_lng)>1) {
	
		logcomparelocation(geo_lat, geo_lng);

		var geo_loc = [];
		geo_loc[0] = geo_lat;
		geo_loc[1] = geo_lng;
		$.cookie("geoloc", geo_loc);

	} else {
	
		console.log('no signficant change');

	}

}

function logcomparelocation(geo_lat, geo_lng) {

	$.ajax({
		url: "/data/d-detect.php",
		data: {lat: geo_lat, lng: geo_lng},
		cache: true,
		dataType: "json",
		success: function (data) {
			if (typeof data[0].bordername != 'undefined') {
				console.log(data[0].bordername);
				$('#detectBorderName').html(data[0].bordername);
				$('#mdlDetection').modal('show');
				$.cookie("a_from", data[0].a_from);
				$.cookie("b_from", data[0].b_from);
				activatePostBtn();
			}
		},
		error: function(model, response) {
			console.log(response.responseText);
		}
	});	

}

function getDistance(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return d;
}

function deg2rad(deg) {
  return deg * (Math.PI/180)
}

function onError() {
	console.log('no geolocation, using default'); 
	geo_lat = "58.335901420448806"; 
	geo_lng = "12.322883605957031"; 
	
	$("#loc_latlng").val(geo_lat+","+geo_lng);
	
}

function changelng(lng) {

	$.ajax({
		url: "/wp-content/themes/pieces-child/js/egc_bordr.json",
		cache: true,
		dataType: "json",
		success: function (json) {

			var classes = '';

			$.each(json[lng], function (key, data) {
				brdlnglp(key, data, classes);
			});

		},
		error: function(model, response) {
			console.log(response.responseText);
		}
	});	

}

function brdlnglp(key, data, classes) {
	if ($.type(data) == 'string') {
		$(classes + '.brdr_'+key).html(data);
		if (!!$('.brdr_'+key).attr('placeholder')) { $('.brdr_'+key).attr( "placeholder", data ); }
	} else {
		var c = classes + '.brdr_' + key + ' ';
		$.each(data, function (k, d) { 
			brdlnglp(k, d, c);
		});
	}
}

function resetContent() {

	$('#btnStartPost').addClass('disabled');
	
	$('#cccheck').attr('checked', false); // Unchecks it

	$("#loc_from").val('');
	$("#loc_to").val('');
	$("#brdDesc").val('');

	$('#loc_visi').val(50);
	$('#loc_arti').val(50);
	$('#loc_impo').val(50);
	$('#loc_ris').val(50);
	$('#loc_tim').val(50);
	$('#loc_mon').val(50);
	$('#loc_posi').val(50);

	$.removeCookie("a_from");
	$.removeCookie("b_from");

// 	navigator.geolocation.getCurrentPosition(handleGetCurrentPosition, onError);			

	$('#btnDrawing').removeClass('btn-primary');
	$('#btnDrawing').addClass('btn-default');
	$('#camera').removeClass('btn-default');
	$('#camera').addClass('btn-primary');
	
	$("#camera").fadeIn();

	$('.sigPad').signaturePad().clearCanvas();
	$('.sigPad').hide();
					
}

  function uploadContent(name) {

	var ibrdFrom = $("#loc_from").val().replace(';', ' ');
	var ibrdTo = $("#loc_to").val().replace(';', ' ');
	var ibrdDesc = $("#brdDesc").val().replace(';', ' ');

	var iloc_visi = $("#loc_visi").val();
	var iloc_impo = $("#loc_impo").val();
	var iloc_arti = $("#loc_arti").val();
	var iloc_posi = $("#loc_posi").val();
	var iloc_tim = $("#loc_tim").val();
	var iloc_mon = $("#loc_mon").val();
	var iloc_ris = $("#loc_ris").val();

	var idept = $("#rel_dept").val();

	var iuser = $("#iuser").val();
	
	var iloc_latlng = $("#loc_latlng").val();
	
	var iuser = $("#iuser").val();
	
	var drawing = $("#output").val();
					
	$.ajax({
		type: 'POST',
		url: '/crossing-data/a-data.php',
		data: 'save_form=Save Form&ibrdFrom='+ibrdFrom+'&ibrdTo='+ibrdTo+'&iloc_visi='+iloc_visi+'&iloc_impo='+iloc_impo+'&ibrdDesc='+ibrdDesc
				+'&iloc_arti='+iloc_arti+'&iloc_tim='+iloc_tim+'&iloc_mon='+iloc_mon+'&iloc_ris='+iloc_ris+'&iloc_posi='+iloc_posi
				+'&iuser='+iuser+'&iloc_img='+name+'&geolat='+iloc_latlng
				+'&drawing='+drawing
				+'&idept='+idept,
		cache: false,
		success: function(response){
			response = unescape(response);
			var response = response.split("|");
			var responseType = response[0];
			var lastID = response[1];
			console.log(lastID);
			if(responseType=="success"){

					  $('#mdlProgress').modal('hide');
					  $('#mdlProgressPic').modal('hide');
					  goToCrossings(lastID);	// go to crossings page
					  
					  resetContent();

			} else {
			
					$('#mdlProgress').modal('hide');
					$('#post').modal('show');

			}
		}
	});                                        

 }

 function renderLast () {
 
	  $('#statusd').html('');
	  
	  var iuser = $.cookie('user');
	  
		$.ajax({
			url: "/crossing-data/l-data.php",
			data: {device: iuser},
			dataType: "json",
			success: function (data) {
			
				console.log('renderlast '+data[0]['chash']);
			
				var chash = data[0]['chash'];
				constructCard(chash);

				if (data === null) { 
				  $('#statusd').html('<p>Oops, looks like you have not crossed any borders yet.</p>');
				  return; 
				}
			},
			error: function(model, response) {
				console.log(response.responseText);
			}
		});
 
 }
 
  function constructCard(chash) {
   		
// 		history.replaceState('data', '', '//db.bordr.org/c/'+chash); 
		console.log('constructing card ' + chash);
   		renderCard(chash);
  }
 
  function renderCard (bdvar) {
  
// 		var url = window.location.pathname;
// 			url = url.split("/");
// 		var bdcons = url[1];
// 		var bdvar = url[2];

		console.log("rendering card "+bdvar);
 
	  $('#bordercard').html('');
	  $('#bcfooter').html('');
	  
	  var iuser = $.cookie('user');
	  
		$.ajax({
			url: "/crossing-data/ad-card.php",
			data: {card: bdvar},
			dataType: "json",
			success: function (data) {
			
				var statusd;
				var bcfooter;
				var bordrName = data[0]['border'];

				statusd = ''+
					'<div class="row"><div class="col-sm-12"><h2>'+data[0]['border']+'</h2></div></div>' +	
					'<div class="row">' +
					'	<div class="col-sm-5">' + 
					'		<div class="row">' + 
					'			<div class="col-sm-12">' +
					'				<img src="'+data[0]['img']+'" class="img-rounded img-responsive" />' + 		
					'				<p>'+data[0]['loc_desc']+'</p>' + 
					'			</div>' + 
					'		</div>' +
					'	</div>' + 
					'	<div class="col-sm-7">' +
					'		<div class="row">' + 
					'			<div class="col-sm-6">' +
					'			<h5>How the experience was rated</h5>' +
					'				<svg id="cardmetrics"></svg>' +
					'			</div>' +
					'			<div class="col-sm-6">' +
					'			<h5 class="where">Location of the border</h5>' +
					'				<img src="'+data[8]['map']+'" class="img-rounded img-responsive" />' + 
					'			</div>' +
					'		</div>' +
					'	</div>' + 
					'</div>' +
					'<div class="row top-buffer">' +
				'';
				if (data[1]['img'] != undefined) {
				statusd = statusd +
						'	<div class="col-sm-2">' +
						'		<a href="http://db.bordr.org/c/'+data[1]['hash']+'"><img src="'+data[1]['img']+'" class="img-rounded img-responsive" /></a>' +
						'		<span class="'+data[1]['metric']+'">'+data[1]['border']+'</span>' +
						'	</div>' +
				'';
				}
				if (data[2]['img'] != undefined) {
				statusd = statusd + 
						'	<div class="col-sm-2">' +
						'		<a href="http://db.bordr.org/c/'+data[2]['hash']+'"><img src="'+data[2]['img']+'" class="img-rounded img-responsive"/></a>' +
						'		<span class="'+data[2]['metric']+'">'+data[2]['border']+'</span>' +
						'	</div>' +
				'';
				}
				if (data[3] != undefined) {
				statusd = statusd +
						'	<div class="col-sm-2">' +
						'		<a href="http://db.bordr.org/c/'+data[3]['hash']+'"><img src="'+data[3]['img']+'" class="img-rounded img-responsive"/></a>' +
						'		<span class="'+data[3]['metric']+'">'+data[3]['border']+'</span>' +
						'	</div>' +
				'';
				}
				if (data[4] != undefined) {
				statusd = statusd + 
						'	<div class="col-sm-2">' +
						'		<a href="http://db.bordr.org/c/'+data[4]['hash']+'"><img src="'+data[4]['img']+'" class="img-rounded img-responsive"/></a>' +
						'		<span class="'+data[4]['metric']+'">'+data[4]['border']+'</span>' +
						'	</div>' +
				'';
				}
				if (data[5] != undefined) {
				statusd = statusd +
						'	<div class="col-sm-2">' +
						'		<a href="http://db.bordr.org/c/'+data[5]['hash']+'"><img src="'+data[5]['img']+'" class="img-rounded img-responsive"/></a>' +
						'		<span class="'+data[5]['metric']+'">'+data[5]['border']+'</span>' +
						'	</div>' +
				'';
				}
				if (data[6] != undefined) {
				statusd = statusd +									
						'	<div class="col-sm-2">' +
						'		<a href="http://db.bordr.org/c/'+data[6]['hash']+'"><img src="'+data[6]['img']+'" class="img-rounded img-responsive"/></a>' +
						'		<span class="'+data[6]['metric']+'">'+data[6]['border']+'</span>' +
						'	</div>';
				}				
				statusd = statusd + '</div></div>';					

				$('#bordercard').append(statusd);
				
				if (data[8].cnt>0) {
					if (data[8].cnt==1) {
						$('#mdlOthers').html('<a href="http://db.bordr.org/border/'+data[8].slug+'/"><span  class="label label-info">'+data[8].cnt+' other person crossed this border</span></a>');
					} else {
						$('#mdlOthers').html('<a href="http://db.bordr.org/border/'+data[8].slug+'/"><span  class="label label-info">'+data[8].cnt+' others crossed this border</span></a>');					
					}
				} else {
					$('#mdlOthers').html('');				
				}
				bcfooter = 'URI to your border card: <input type="text" class="form-control" value="http://db.bordr.org/c/'+bdvar+'"/> '
				+'<p>&nbsp;&nbsp;Share card: <a href="https://twitter.com/intent/tweet?button_hashtag=Bordr&text=I%20crossed%20the%20'+bordrName+'%20border." target="_blank" class="twitter-hashtag-button" data-related="CrossBordr" data-url="http://db.bordr.org/c/'+bdvar+'"><img src="/wp-content/themes/pieces-child/img/twittershare.gif"/></a> <a href="https://www.facebook.com/sharer/sharer.php?u=http://db.bordr.org/c/'+bdvar+'" target="_blank"><img src="/wp-content/themes/pieces-child/img/fbshare.gif"/></a></p>';
				$('#bcfooter').append(bcfooter);

				if (data === null) { 
				  $('#bordercard').html('<p>Oops, looks like you have not crossed any borders yet.</p>');
				  return; 
				}
				$('#mdlCard').modal('show');
				getCardStats(data[0]['id']);
			},
			error: function(model, response) {
				console.log(response.responseText);
			}
		});
 
 }