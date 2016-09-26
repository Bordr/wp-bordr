<?php
/**
 * The template for displaying archive pages.
 *
 * @package Nu Themes
 */

get_header(); ?>

	<div class="row">
			<main id="content" class="col-sm-12 content-area" role="main">	
			<div class="col-sm-2 col-med-3 col-lg-3">
			<button type="button" id="postbtn" class="btn btn-primary start">Tell Your Border Story</button>
	</div>
	
		<?php if ( have_posts() ) : ?>

				<header <?php if ( is_category( 'method' ) || is_category( 'border-projects' )) { echo("class='box archive-header hidden-md hidden-sm hidden-xs' style='padding:0px;'"); } else { echo("class='box archive-header'"); } ?> >
					<h1 class="archive-title">
					
						<?php
						
							if ( is_category() ) :
								single_cat_title();

							elseif ( is_tag() ) :
								single_tag_title();

							elseif ( is_author() ) :
								the_post();
								printf( __( 'Author: %s', 'nuthemes' ), '<span class="vcard">' . get_the_author() . '</span>' );
								rewind_posts();

							elseif ( is_day() ) :
								printf( __( 'Day: %s', 'nuthemes' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Month: %s', 'nuthemes' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Year: %s', 'nuthemes' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

							else :
								_e( 'Archives', 'nuthemes' );

							endif;
						?>
					</h1>
					<?php
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;
					?>
				<!-- .archive-header --></header>

				<div id="masonry" class="row">
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="col-xs-12 col-sm-6 col-lg-4 masonry-item">
						<?php get_template_part( 'content', get_post_format() ); ?>
					</div>

				<?php endwhile; ?>
			<!-- #masonry --></div>

			<?php nuthemes_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		<!-- #content --></main>

		<?php if ( !is_category( 'notes' )) { get_sidebar(); } ?>
	<!-- .row --></div>

<?php get_footer(); ?>
