<?php
/**
 * @package Nu Themes
 */
 
$location = get_field('brdr_location');
$image = get_field('brdr_image');
$related_activity = get_field('related_activity');
 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'box' ); ?>>
	<header class="entry-header">
		<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?></a></h3>
	<!-- .entry-header --></header>

	<div class="clearfix entry-summary">
		<div class="row">
			<div class="col-xs-12">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
				<?php
				  if($image) {
					 ?><img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" class="img-responsive"/><?php 
				  } else {
					 ?><img src="/landing/imgs/egc_bg-cremesoda_400x300.jpg" class="img-responsive"><?php
				  }
				?>
				</a>
			</div>
		</div>
	<!-- .entry-summary --></div>

	<footer class="entry-meta entry-footer">
		<?php if ( 'post' == get_post_type() ) : ?>
			<?php
				$categories_list = get_the_category_list( __( ', ', 'nuthemes' ) );
				if ( $categories_list && nuthemes_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( '%1$s', 'nuthemes' ), $categories_list ); ?>
			</span>
			<?php endif; ?>

			<?php
				$tags_list = get_the_tag_list( '', __( ', ', 'nuthemes' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( '%1$s', 'nuthemes' ), $tags_list ); ?>
			</span>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'nuthemes' ), __( '1 Comment', 'nuthemes' ), __( '% Comments', 'nuthemes' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'nuthemes' ), '<span class="edit-link">', '</span>' ); ?>
	<!-- .entry-footer --></footer>
<!-- #post-<?php the_ID(); ?> --></article>