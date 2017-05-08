<?php
/**
 * @package Nu Themes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'box' ); ?>>
	<header class="entry-header">
<?php
if ( has_post_thumbnail() ) {
	?> <div class="featuredonpost"> <?php the_post_thumbnail('large'); ?> </div> <?php
}
?>

	<h1 class="entry-title"><?php the_title(); ?></h1>

	<div class="clearfix entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'nuthemes' ),
				'after'  => '</div>',
			) );
		?>
	<!-- .entry-content --></div>

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
				$tags_list = get_the_tag_list( ', ', __( ', ', 'nuthemes' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( '%1$s', 'nuthemes' ), $tags_list ); ?>
			</span>
			<?php endif; ?>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'nuthemes' ), '<span class="edit-link">', '</span>' ); ?>
	<!-- .entry-footer --></footer>
<!-- #post-<?php the_ID(); ?> --></article>
