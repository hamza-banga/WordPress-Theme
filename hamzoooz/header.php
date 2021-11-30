<?php /**
 * 
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 * 
 *  @link https:/www.hamzoooz.com
 *
 * @since 1.0
 * @version 1.0
 * @package hamzooz
 */
// $theme_options = hamzoooz_theme_options();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset = "<?php bloginfo("charset"); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>
        <?php wp_title('|' , 'true' , 'right') ?>
        <?php bloginfo('name') ?>
    </title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback"  href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

    <!-- <div id="particle-canvas" class="particle-canvas"></div> -->

	<div id="page" class="hfeed site">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'merlin' ); ?></a>

		<header id="masthead" class="site-header clearfix" role="banner">

			<div id="header-top" class="header-bar-wrap">

				<?php get_template_part( 'template-parts/header-bar' ); ?>

			</div>

			<div class="header-main clearfix">

				<div id="logo" class="site-branding clearfix">

					<?php merlin_site_logo(); ?>
					<?php merlin_site_title(); ?>
                    <?php merlin_site_description(); ?>

				</div><!-- .site-branding -->

				<div class="header-widgets clearfix">

                    <?php // Display Header Widgets
                    if ( is_active_sidebar( 'header' ) ) :

                        dynamic_sidebar( 'header' );

                    endif; ?>

				</div><!-- .header-widgets -->

			</div><!-- .header-main -->

			<nav id="main-navigation" class="primary-navigation navigation clearfix" role="navigation">
				<?php
					// Display Main Navigation
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container' => false,
						'menu_class' => 'main-navigation-menu',
						'echo' => true,
						'fallback_cb' => 'merlin_default_menu',
                    ) );
				?>
			</nav><!-- #main-navigation -->

			<?php // Display Custom Header Image
			merlin_header_image(); ?>

		</header><!-- #masthead -->

		<div id="content" class="site-content container clearfix">
        <nav class="navbar navbar-default" role="navigation">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php bloginfo('url') ?> "><?php bloginfo('name')?></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php bootstrap_menu() ?> 
        </div>
        </nav>
    