<?php
/**
 * The template for displaying search forms in Nu Themes
 *
 * @package Nu Themes
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'nuthemes' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'nuthemes' ); ?>">
	</div>
	<div class="form-submit">
		<button type="submit" class="search-submit"><?php echo esc_attr_x( 'Search', 'submit button', 'nuthemes' ); ?></button>
	</div>
</form>