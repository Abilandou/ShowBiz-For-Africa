<?php
/**
 * template for header layout-1 
 * @package Postmagthemes
 * @subpackage queens_magazine_blog
 */
?>

<div class='row ' >
			<!-- For header image section start -->
			<?php if ( has_header_image() ) { ?>
				<div class = "col-lg-3 pl-0 pr-0 pt-2"  >
					<img src = "<?php header_image(); ?>" height = "<?php echo esc_attr( get_custom_header()->height ); ?>" width = "<?php echo esc_attr( get_custom_header()->width ); ?>" alt = ""/> 
				</div>
			<?php } else { ?>
				<div class = "col-lg-3"  >
				</div>
			<?php } ?>

			<div class="site-branding brand-link col-lg-6 pr-0 pl-0">

				<div class="text-center ">
					<h1 class="site-title theme-hover "><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				</div>
				
				<!-- Site descritpion-->
				<?php
				$queens_magazine_blog_description = get_bloginfo( 'description', 'display' );
				if ( $queens_magazine_blog_description || is_customize_preview() ) :
					?>
					<div class="text-center">
						<h2 class="site-description" ><?php echo esc_html($queens_magazine_blog_description); /* WPCS: xss ok. */ ?></h2>
					</div>
				<?php endif;?>

				<!-- Date section-->
				<?php if(  esc_attr( get_theme_mod( 'title_date_display' )) === '1' or esc_attr( get_theme_mod( 'title_date_display' )) == null) : ?> 
					<div class = "title-date text-center theme-text-color" > 
					
						<?php echo esc_html( date( get_option('date_format') ) ); ?>
					
					</div>
				<?php 
				endif;?>

			</div><!-- .site-branding -->

			<!-- Logo -->
			<?php if ( function_exists(  "the_custom_logo" ) ) { 
				?> <div class = "col-lg-3 text-right pl-0 pr-0 pt-2"  >
				<?php the_custom_logo( );
				?> </div> <?php
			} ?>
			
		
			<nav id="site-navigation" class=" menu-background-color main-navigation navbar navbar-custome row ml-0 mr-0 " >
				<button class="menu-toggle toggle-menu" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'queens-magazine-blog' ); ?></button>
				<?php
				wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'container_class' 	=> 'brand-link menucase menu-text-color'
				) );
				?>
			</nav><!-- #site-navigation -->
		</div>