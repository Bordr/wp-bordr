<?php
/**
 * @package Nu Themes
 */
 
$options = array(
			'post_id'		=> 'new_post',
			'submit_value'		=> 'Create a new post',
			'field_groups' => 120
);

 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'box' ); ?>>
	<header class="entry-header">
<?php
if ( has_post_thumbnail() ) {
	?> <div class="featuredonpost"> <?php the_post_thumbnail('large'); ?> </div> <?php
} 
?>

		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php 
// 				nuthemes_posted_on(); 
				?>
			<?php 
// 				nuthemes_posted_by(); 
				?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'nuthemes' ), __( '1 Comment', 'nuthemes' ), __( '% Comments', 'nuthemes' ) ); ?></span>
			<?php endif; ?>
		<!-- .entry-meta --></div>
	<!-- .entry-header --></header>

	<div class="clearfix entry-content">
		<?php the_content(); acf_form( $options ); ?>
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
				$tags_list = get_the_tag_list( '', __( ', ', 'nuthemes' ) );
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