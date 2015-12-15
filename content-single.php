<?php
/**
 * Outputs the single post content. Displayed by single.php.
 * 
 * @package kaneko
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
        <?php 
        if (has_post_thumbnail()) {
        echo '<div class="post-thumbnails-image clear">';
        echo '<div class="image-shifter">';
        simone_the_responsive_thumbnail( get_the_ID() );
        echo '</div>';
        echo '</div>';
        }
        ?>
    
    <header class="entry-header clear">
            
            <?php
                /* translators: used between list items, there is a space after the comma */
                $category_list = get_the_category_list( __( ', ', 'kaneko' ) );

                if ( kaneko_categorized_blog() ) {
                    echo '<div class="category-list">' . $category_list . '</div>';
                }
            ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>

        <div class="entry-meta">
                    <?php kaneko_posted_on(); ?>
                    <?php 
                    if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                        echo '<span class="comments-link">';
                        comments_popup_link( __( 'Leave a comment', 'kaneko' ), __( '1 Comment', 'kaneko' ), __( '% Comments', 'kaneko' ) );
                        echo '</span>';
                    }
                    ?>
                    <?php edit_post_link( __( 'Edit', 'kaneko' ), '<span class="edit-link">', '</span>' ); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'kaneko' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php
            echo get_the_tag_list( '<ul><li><i class="fa fa-tag"></i>', '</li><li><i class="fa fa-tag"></i>', '</li></ul>' );
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
