<?php

namespace GSCOACH;

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class Columns {

    /**
	 * Class constructor.
	 * 
	 * @since 1.0.0
	 */
    public function __construct() {
        
        add_filter( 'manage_gs_coach_posts_columns', [ $this, 'gs_coach_post_columns' ] );
        add_action( 'manage_gs_coach_posts_custom_column', [ $this, 'gs_coach_custom_post_columns' ], 10, 2 );        
    }

    /**
     * Customize Coach screen columns.
     * 
     * @since 1.0.0
     * 
     * @param  array $columns Screen columns.
     * @return array          Modified screen columns.
     */
    public function gs_coach_post_columns( $columns ) {

        $new_columns = [
            'cb'                               => $columns['cb'],
            'gs_coach_featured_image'                   => __( 'Coach Image', 'gscoach' ),
            'title'                            => $columns['title'],
            'taxonomy-gs_coach_group'          => $columns['taxonomy-gs_coach_group'],
            'taxonomy-gs_coach_tag'            => $columns['taxonomy-gs_coach_tag'],
            'gs_coach_rating'                  => __( 'Rating', 'gscoach' ),
            'date'                             => $columns['date']
        ];

        return $new_columns;
    }

    /**
     * Populating the columns.
     * 
     * @since 1.0.0
     * 
     * @param  array $columns Screen column.
     * @return void
     */
    public function gs_coach_custom_post_columns( $column, $postId ) {

        if ( 'gs_coach_featured_image' === $column ) {
            $image = get_the_post_thumbnail( $postId, [ 70, 70 ] );

            if ( $image ) {
                ?>
                    <style>
                        #coach-featured-image img {
                            width: 55px;
                            height: auto;
                            border-radius: 5px;
                        }
                        .column-gs_coach_featured_image{
                            width: 8%;
                        }
                    </style>

                    <div id="coach-featured-image">
                        <?php echo $image; ?>
                    </div>
                <?php
            } else{
                echo 'Not found!';
            }
        }
    
        if ( 'gs_coach_rating' === $column ) {
            $args = array(
                'rating' => get_post_meta( $postId, '_gscoach_rating', true ),
                'type'   => 'rating',
                'number' => 0
            );
            wp_star_rating( $args );
        }
    }
}
