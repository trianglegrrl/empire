<?php
/**
 * SpyroPress Comments
 *
 * @category    WordPress
 * @package     SpyroPress
 *
 */

/**
 * Comment Callback
 */
function spyropress_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'spyropress' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'spyropress' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
    <li <?php comment_class( 'media' ); ?> id="li-comment-<?php comment_ID(); ?>">
		<a href="#" class="pull-left thumb">
        <?php
            $avatar_size = ( '0' != $comment->comment_parent ) ? 60 : 100;
            echo get_avatar( $comment, $avatar_size );
        ?>
        </a>
		<div class="media-body">
            <?php printf( __( '<small>%1$s at %2$s</small>', 'spyropress' ), get_comment_date(), get_comment_time() ) ?>
			<h4 class="media-heading text-left">
				<?php comment_author_link(); ?>
			</h4>
			<?php if ( $comment->comment_approved == '0' ) { ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'spyropress' ); ?></em><br />
            <?php
                }
                comment_text();
            ?>
            <?php
                echo str_replace( 'comment-reply-link', 'btn reply pull-right', get_comment_reply_link( array_merge( $args, array(
                    'depth' => $depth,
                    'reply_text' => '<i class="icon-comment icon-white"></i>Reply',
                    'max_depth' => $args['max_depth'],
                ) ) ) );
            ?>
		</div>
	<?php
			break;
	endswitch;
}
?>