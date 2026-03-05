<?php
/**
 * Recommended plugins
 *
 * @package ReviewNews
 */

if ( ! function_exists( 'reviewnews_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function reviewnews_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'Templatespare', 'reviewnews' ),
                'slug'     => 'templatespare',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Elespare', 'reviewnews' ),
                'slug'     => 'elespare',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Blockspare', 'reviewnews' ),
                'slug'     => 'blockspare',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'WP Post Author', 'reviewnews' ),
                'slug'     => 'wp-post-author',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Free Live Chat using 3CX', 'reviewnews' ),
                'slug'     => 'wp-live-chat-support',
                'required' => false,
            )

        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'reviewnews_recommended_plugins' );
