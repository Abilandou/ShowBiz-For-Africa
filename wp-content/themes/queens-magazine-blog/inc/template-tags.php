<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */

if ( ! function_exists( 'queens_magazine_blog_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function queens_magazine_blog_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">; MD %4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( get_option('date_format') ) ),
			esc_html( get_the_date(get_option('date_format')) ),
			esc_attr( get_the_modified_date( get_option('date_format') ) ),
			esc_html( get_the_modified_date(get_option('date_format')) )
		);
		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'PD %s', 'post date', 'queens-magazine-blog' ),
			'<a href="' . esc_url( get_month_link(esc_html(get_the_time('Y')), esc_html(get_the_time('m')) ) ) . '" rel="bookmark">' .$time_string. '</a>'
		);
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'queens_magazine_blog_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function queens_magazine_blog_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'queens-magazine-blog' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'queens_magazine_blog_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function queens_magazine_blog_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'queens-magazine-blog' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links pr-1 d-block">' . esc_html__( 'Tagged %1$s', 'queens-magazine-blog' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if (! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link pr-1 green shape-1 leave-comment">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'queens-magazine-blog' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'queens-magazine-blog' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link pl-1">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'queens_magazine_blog_post_thumbnail_recent' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function queens_magazine_blog_post_thumbnail_recent() {
		if ( post_password_required() || is_attachment() ) {
			return;
		} ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php
					the_post_thumbnail( 'queens-magazine-blog-post-thumbnail-square', array(
						'alt' => the_title_attribute( array(
							'echo' => false,
						) ),
					) );
		?>
		</a>

		<?php
		
	}
endif;

if ( ! function_exists( 'queens_magazine_blog_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function queens_magazine_blog_post_thumbnail() {
		if ( post_password_required() || is_attachment() ) {
			return;
		} 
		?>
		<a class="post-thumbnail " href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php
			the_post_thumbnail( 'queens-magazine-blog-post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
					'class' => 'images',
				) ),
			) );
		?>
		</a>
		<?php
	}
endif;