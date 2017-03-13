<?php
/**
 * Plugin Name: Monkey Kode Remove Dashboard Widgets
 * Version:     1.0.0
 * Description: Removes all home dashboard widgets.
 * Author:      Jull Weber
 * Author URI:  https://monkeykode.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mka-remove-dashboard-widgets
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


if ( ! function_exists( 'mka_remove_dashboard_widgets' ) ) {
	function mka_remove_dashboard_widgets() {
//		comment out what you don't want to keep.
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
//		remove_action( 'welcome_panel', 'wp_welcome_panel' );
//		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');


	}

	function mka_edit_welcome_panel() { ?>

        <script type="text/javascript">
            // Hide default welcome message
            jQuery(document).ready(function ($) {
                $('div.welcome-panel-content').remove();
            });
        </script>

        <div class="welcome-panel-content-custom" style="margin-left: 13px;max-width: 1500px;">
            <h2><?php _e( 'Welcome Goodwin Hartford!' ); ?></h2>
            <p class="about-description"><?php _e( 'We’ve assembled some links to get you started.' ); ?></p>
            <div class="welcome-panel-column-container">

                <div class="welcome-panel-column">
                    <h3><?php _e( "Get Started" ); ?></h3>
                    <a class="button button-primary button-hero load-customize hide-if-no-customize"
                       href="<?php echo admin_url( 'customize.php' ); ?>">Customize Your Site</a>
                </div>
                <div class="welcome-panel-column">
                    <h3><?php _e( 'Next Steps' ); ?></h3>
                    <ul>
						<?php if ( 'page' == get_option( 'show_on_front' ) && ! get_option( 'page_for_posts' ) ) : ?>
                            <li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
                            <li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
						<?php elseif ( 'page' == get_option( 'show_on_front' ) ) : ?>
                            <li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
                            <li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
                            <li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Add a blog post' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
						<?php else : ?>
                            <li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Write your first blog post' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
                            <li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add an About page' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
						<?php endif; ?>
                        <li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'View your site' ) . '</a>', home_url( '/' ) ); ?></li>
                    </ul>
                </div><!-- .welcome-panel-column -->


                <div class="welcome-panel-column welcome-panel-last">
                    <h3><?php _e( 'More Actions' ); ?></h3>
                    <ul>
                        <li><?php printf( '<div class="welcome-icon welcome-widgets-menus">' . __( 'Manage <a href="%1$s">widgets</a> or <a href="%2$s">menus</a>' ) . '</div>', admin_url( 'widgets.php' ), admin_url( 'nav-menus.php' ) ); ?></li>
                        <li><?php printf( '<a href="%s" class="welcome-icon welcome-comments">' . __( 'Turn comments on or off' ) . '</a>', admin_url( 'options-discussion.php' ) ); ?></li>
                        <li><?php printf( '<a href="%s" class="welcome-icon welcome-learn-more">' . __( 'Learn more about getting started' ) . '</a>', __( 'http://codex.wordpress.org/First_Steps_With_WordPress' ) ); ?></li>
                    </ul>
                </div><!-- .welcome-panel-column welcome-panel-last -->

            </div><!-- .welcome-panel-column-container -->
        </div> <!-- .custom-welcome-panel-content -->
		<?php
	}

	function mka_welcome_panel_admin_styles() {
	    ?>
        <style>
            .welcome-panel .welcome-panel-content {
                display: none!important;
            }
        </style>
<?php

    }


	function mka_init_mka_remove_dashboard_widgets() {
		add_action('admin_head', 'mka_welcome_panel_admin_styles');
		add_action( 'welcome_panel', 'mka_edit_welcome_panel' );
		add_action( 'admin_init', 'mka_remove_dashboard_widgets' );

	}


	mka_init_mka_remove_dashboard_widgets();
}