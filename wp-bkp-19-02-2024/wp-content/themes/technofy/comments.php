<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package technofy
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
        <h2 class="comments-title">
			<?php
			$technofy_comment_count = get_comments_number();
			if ( '1' === $technofy_comment_count ) {
				printf(
				/* translators: 1: title. */
					esc_html__( '1 Comment', 'technofy' )

				);
			} else {
				printf( // WPCS: XSS OK.
				/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s Comments &ldquo;%2$s&rdquo;', '%1$s Comments ', $technofy_comment_count, 'comments title', 'technofy' ) ),
					number_format_i18n( $technofy_comment_count )
				);
			}
			?>
        </h2><!-- .comments-title -->

        <div class="blog-comment-navigation">
			<?php the_comments_navigation(); ?>
        </div>
		
        <div class="clearfix"></div>
		
		
        <ul class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'callback' => 'technofy_comment_modification', 
				'short_ping' => true,
			) );
			?>
        </ul><!-- .comment-list -->

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'technofy' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().
	$fields = array(
		'author' => ' <div class="form-group">
                        <input type="text" id="author" name="author" tabindex="1" value="' . esc_attr( $commenter['comment_author'] ) . '" class="form-control" placeholder="'.esc_attr__('Name...','technofy').'">
                    </div>',
		'email'  => ' <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" tabindex="2" placeholder="'.esc_attr__('Email...','technofy').'">
                    </div>',
		'URL'    => '<div class="form-group">
                        <input type="text" id="url" name="url" value="' . esc_url(  $commenter['comment_author_url'] ) . '" class="form-control" tabindex="3" placeholder="'.esc_attr__('Subject...','technofy').'">
                    </div>'
	);
	comment_form( array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'title_reply'          => esc_html__( 'Post Your Comment', 'technofy' ),
		'title_reply_to'       => esc_html__( 'Leave A Reply To %s', 'technofy' ),
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'cancel_reply_link'    => '<i class="fa fa-times ml-2"></i>',
		'class_submit'         => 'submit-btn comment-submit-technofy',
		'label_submit'         => esc_html__( 'Post comment', 'technofy' ),
		'comment_field'        => '<div class="form-group textarea">
                                <textarea name="comment" id="comment" class="form-control custom-msg p-4" placeholder="' . esc_attr__( 'Comment...', 'technofy' ) . '" cols="30" rows="6"></textarea>
                            </div>'
	) );
	?>

</div><!-- #comments -->
