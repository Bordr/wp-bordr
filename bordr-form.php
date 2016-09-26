<?php
/**
 * The template for displaying the form module
 *
 */
?>

<!-- BORDR APP -->

		<!-- Modal -->
		<div class="modal fade" id="post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title brdr_title" id="myModalLabel">Book a Border Story</h4>
			  </div>
			  <div class="modal-body">
						<div id="primary">
<!-- 							<div id="content" role="main"> -->

							<?php /* The loop */ ?>

							<?php if (is_user_logged_in()) : ?>

								<?php acf_form(array(
									'post_id'		=> 'new_post',
									'new_post'		=> array(
										'post_type'		=> 'bordr',
										'post_status'		=> 'publish'
									),
									'submit_value'		=> 'Add a bordr story'
								)); ?>

							<?php else : ?>

								<?php acf_form(array(
									'post_id'		=> 'new_post',
									'fields'		=> array(
										'brdr_from',
										'brdr_to', 
										'brdr_story',
										'brdr_image',
										'brdr_invisible_visible',
										'brdr_unimportant_important',
										'brdr_negative_positive',
										'brdr_location',
										'brdr_cc'
									), 
									'html_after_fields' => '<input type="hidden" name="acf[field_57d82e1934b8f]" value="697"/>',
									'new_post'		=> array(
										'post_type'		=> 'bordr',
										'post_status'		=> 'publish'
									),
									'submit_value'		=> 'Add a bordr story'
								)); ?>

							<?php endif ; ?>
<!-- 							</div><!~~ #content ~~> -->
						</div><!-- #primary -->

			   </div>
			  <div class="modal-footer">
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Progress Modal -->
		<div class="modal fade" id="mdlProgress" tabindex="-1" role="dialog" aria-labelledby="mdlProgressLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="mdlProgressLabel">Posting. One moment please.</h4>
			  </div>
			  <div class="modal-body">
				<!-- The global progress information -->
				<div class="fileupload-progress fade" data-role="none">
					<!-- The global progress bar -->
					<div data-role="none" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
						<div data-role="none" class="progress-bar progress-bar-success" style="width:0%;"></div>
					</div>
					<!-- The extended global progress information -->
					<div class="progress-extended">&nbsp;</div>
				</div>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Progress Modal -->
		<div class="modal fade" id="mdlProgressPic" tabindex="-1" role="dialog" aria-labelledby="mdlProgressPicLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="mdlProgressPicLabel">Posting. One moment please.</h4>
			  </div>
			  <div class="modal-body">
				<!-- The global progress information -->
				<div data-role="none">
					<!-- The global progress bar -->
					<div data-role="none" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
						<div data-role="none" class="progress-bar progress-bar-success" style="width:100%;"></div>
					</div>
				</div>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


		<!-- Complete Modal -->
		<div class="modal fade" id="mdlDone" tabindex="-1" role="dialog" aria-labelledby="mdlDoneLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="mdlDoneLabel">Border Crosssing Posted!</h4>
			  </div>
			  <div class="modal-body" id="statusd">
					
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Complete Modal -->
		<div class="modal fade" id="mdlCard" tabindex="-1" role="dialog" aria-labelledby="mdlCardLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="mdlCardLabel">Your border crossing is now part of a global database and your experience is similar to that of many others</h4>
				<div id="mdlOthers"></div>
			  </div>
			  <div class="modal-body" id="bordercard">
					
			  </div>
			  <div class="modal-footer" id="bcfooter">
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Loading Modal -->
		<div class="modal fade" id="mdlLoadStories" tabindex="-1" role="dialog" aria-labelledby="mdlLoadStoriesLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="mdlLoadStoriesLabel">Matching traveller stories. One moment please.</h4>
			  </div>
			  <div class="modal-body">
				<!-- The global progress information -->
				<div class="fileupload-progress fade" data-role="none">
					<!-- The global progress bar -->
					<div data-role="none" class="progress progress-striped active" role="progressbar" aria-valuemin="50" aria-valuemax="100">
						<div data-role="none" class="progress-bar progress-bar-success" style="width:100%;"></div>
					</div>
					<!-- The extended global progress information -->
					<div class="progress-extended">&nbsp;</div>
				</div>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
<!-- 	<script src="//code.jquery.com/jquery.js"></script> -->
	<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
		
	<!-- The main application script -->
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/linkPreview.js" ></script>
	
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.cookie.js"></script>
	
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.flexslider.js"></script>

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/headroom.js"></script>
	
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/fboauth.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bordr.js"></script>
	
	<script type="text/javascript">
	 function renderMyDepartures(filter,value) {

		// vars
		var url = '<?php echo home_url('activities/'); ?>';
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

	 	var methodv = getUrlParameter('method');
	 	if (methodv) {
			$('#depmet').addClass('selFilter');
	 		var mettext = $('*[data-method="'+methodv+'"]').html();
			$('#depmet').html(mettext+' <span class="caret"></span>');
			$('#depmet').attr('data-filter',$('*[data-method="'+methodv+'"]').data('filter'));
			$('#depmet').attr('data-method',$('*[data-method="'+methodv+'"]').data('method'));
	 	}

	 });
	 
	</script>
	
	<script type="text/javascript">
	(function($) {
	
		// setup fields
		acf.do_action('append', $('#popup-id'));
	
	})(jQuery);	
	</script>
	
<!-- END BORDR APP -->

<?php
acf_enqueue_uploader();
?>