<?php

namespace GSCOACH;

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class Column {

    public function __construct() {
        add_filter( 'manage_edit-gs_coach_columns', [ $this, 'screen_columns' ] );
        add_action( 'manage_posts_custom_column', [ $this, 'columns_content' ], 10, 2 );
        add_action( 'manage_posts_custom_column', [ $this, 'populate_columns' ] );
        add_filter( 'manage_edit-gs_coach_sortable_columns', [ $this, 'sort' ] );        
    }

    function get_tax_option( $key ) {
        return plugin()->builder->get_tax_option( $key );
    }

    function screen_columns( $columns ) {

        $is_enabled_group_tax       = $this->get_tax_option('enable_group_tax') === 'on';
        $is_enabled_tag_tax         = $this->get_tax_option('enable_tag_tax') === 'on';
        $is_enabled_language_tax    = is_pro_valid() && $this->get_tax_option('enable_language_tax') === 'on';
        $is_enabled_location_tax    = is_pro_valid() && $this->get_tax_option('enable_location_tax') === 'on';
        $is_enabled_gender_tax      = is_pro_valid() && $this->get_tax_option('enable_gender_tax') === 'on';
        $is_enabled_specialty_tax   = is_pro_valid() && $this->get_tax_option('enable_specialty_tax') === 'on';
        $is_enabled_extra_one_tax   = is_pro_valid() && $this->get_tax_option('enable_extra_one_tax') === 'on';
        $is_enabled_extra_two_tax   = is_pro_valid() && $this->get_tax_option('enable_extra_two_tax') === 'on';
        $is_enabled_extra_three_tax = is_pro_valid() && $this->get_tax_option('enable_extra_three_tax') === 'on';
        $is_enabled_extra_four_tax  = is_pro_valid() && $this->get_tax_option('enable_extra_four_tax') === 'on';
        $is_enabled_extra_five_tax  = is_pro_valid() && $this->get_tax_option('enable_extra_five_tax') === 'on';

        unset( $columns['date'] );

        if ( $is_enabled_group_tax ) unset( $columns['taxonomy-gs_coach_group'] );
        if ( $is_enabled_tag_tax ) unset( $columns['taxonomy-gs_coach_tag'] );
        if ( $is_enabled_language_tax ) unset( $columns['taxonomy-gs_coach_language'] );
        if ( $is_enabled_location_tax ) unset( $columns['taxonomy-gs_coach_location'] );
        if ( $is_enabled_gender_tax ) unset( $columns['taxonomy-gs_coach_gender'] );
        if ( $is_enabled_specialty_tax ) unset( $columns['taxonomy-gs_coach_specialty'] );
        if ( $is_enabled_extra_one_tax ) unset( $columns['taxonomy-gs_coach_extra_one'] );
        if ( $is_enabled_extra_two_tax ) unset( $columns['taxonomy-gs_coach_extra_two'] );
        if ( $is_enabled_extra_three_tax ) unset( $columns['taxonomy-gs_coach_extra_three'] );
        if ( $is_enabled_extra_four_tax ) unset( $columns['taxonomy-gs_coach_extra_four'] );
        if ( $is_enabled_extra_five_tax ) unset( $columns['taxonomy-gs_coach_extra_five'] );

        $columns['title']                           = __( 'Coach Name', 'gscoach' );
        $columns['gscoach_featured_image']           = __( 'Coach Image', 'gscoach' );
        $columns['_gscoach_profession']                         = __( 'Designation', 'gscoach' );

        if ( $is_enabled_group_tax ) $columns['taxonomy-gs_coach_group'] = $this->get_tax_option('group_tax_plural_label');
        if ( $is_enabled_tag_tax ) $columns['taxonomy-gs_coach_tag'] = $this->get_tax_option('tag_tax_plural_label');
        if ( $is_enabled_language_tax ) $columns['taxonomy-gs_coach_language'] = $this->get_tax_option('language_tax_plural_label');
        if ( $is_enabled_location_tax ) $columns['taxonomy-gs_coach_location'] = $this->get_tax_option('location_tax_plural_label');
        if ( $is_enabled_gender_tax ) $columns['taxonomy-gs_coach_gender'] = $this->get_tax_option('gender_tax_plural_label');
        if ( $is_enabled_specialty_tax ) $columns['taxonomy-gs_coach_specialty'] = $this->get_tax_option('specialty_tax_plural_label');
        if ( $is_enabled_extra_one_tax ) $columns['taxonomy-gs_coach_extra_one'] = $this->get_tax_option('extra_one_tax_plural_label');
        if ( $is_enabled_extra_two_tax ) $columns['taxonomy-gs_coach_extra_two'] = $this->get_tax_option('extra_two_tax_plural_label');
        if ( $is_enabled_extra_three_tax ) $columns['taxonomy-gs_coach_extra_three'] = $this->get_tax_option('extra_three_tax_plural_label');
        if ( $is_enabled_extra_four_tax ) $columns['taxonomy-gs_coach_extra_four'] = $this->get_tax_option('extra_four_tax_plural_label');
        if ( $is_enabled_extra_five_tax ) $columns['taxonomy-gs_coach_extra_five'] = $this->get_tax_option('extra_five_tax_plural_label');

        $columns['date'] = __( 'Date', 'gscoach' );

        return $columns;
    }

    function featured_image( $post_ID ) {

        $post_thumbnail_id = get_post_thumbnail_id( $post_ID );

        if ( $post_thumbnail_id ) {
            $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id );
            if ( empty($post_thumbnail_img) ) return '';
            return $post_thumbnail_img[0];
        }
    }

    function columns_content($column_name, $post_ID) {
        if ( $column_name == 'gscoach_featured_image' ) {
            $post_featured_image = $this->featured_image( $post_ID );
            if ( $post_featured_image ) {
                echo '<img src="' . esc_url($post_featured_image) . '" width="34"/>';
            }
        }
    }

    function populate_columns( $column ) {
        if ( '_gscoach_profession' == $column ) {
            $tm_m_desig = get_post_meta( get_the_ID(), '_gscoach_profession', true );
            echo esc_html($tm_m_desig);
        }
    }

    function sort( $columns ) {
        $columns['taxonomy-gs_coach_group'] = 'taxonomy-gs_coach_group';
        return $columns;
    }

}