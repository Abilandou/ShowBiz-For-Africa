<?php
/**
 * The template for displaying home page.
 *
 * Template Name: Custom Home Page
 *
 * @package Advance Blogging
 */

get_header(); ?>

<?php do_action( 'advance_blogging_above_slider' ); ?>

<section id="slider">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 p-0">
				<div class="sliderq">
				  	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
					    <?php $pages = array();
					      for ( $count = 1; $count <= 3; $count++ ) {
					        $mod = intval( get_theme_mod( 'advance_blogging_slider_page' . $count ));
					        if ( 'page-none-selected' != $mod ) {
					          $pages[] = $mod;
					        }
					      }
					      if( !empty($pages) ) :
					        $args = array(
					          'post_type' => 'page',
					          'post__in' => $pages,
					          'orderby' => 'post__in'
					        );
					        $query = new WP_Query( $args );
					        if ( $query->have_posts() ) :
					          $i = 1;
					    ?>     
					    <div class="carousel-inner" role="listbox">
					      <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
					        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
					          <img src="<?php the_post_thumbnail_url('full'); ?>"/>	          
					          <div class="carousel-caption">
					            <div class="inner_carousel">
					              <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
					              <p><?php the_excerpt(); ?></p>
					            </div>
					          </div>
					        </div>
					      <?php $i++; endwhile; 
					      wp_reset_postdata();?>
					    </div>
					    <?php else : ?>
					        <div class="no-postfound"></div>
					    <?php endif;
					    endif;?>
					    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      						<span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      						<span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
   						</a>
				  	</div>  	
				</div>		
			</div>
			<div class="col-md-4 p-0">
				<div class="cat-post">
					<?php 
		              $page_query = new WP_Query(array( 'category_name' => esc_html(get_theme_mod('advance_blogging_blogcategory_setting'),'theblog')));?>
		              <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
		              	<div class="abt-img-box">   
	                      	<img src="<?php the_post_thumbnail_url('full'); ?>"/>
	                      	<div class="cat-box">
	                      		<div class="cat-border">
		                       		<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
		                      		<p><?php $excerpt = get_the_excerpt(); echo esc_html( advance_blogging_string_limit_words( $excerpt,18 ) ); ?></p>
		                      	</div>
	                      	</div>
	                    </div>
		              <?php endwhile;
		              wp_reset_postdata();
		            ?>
	        	</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</section>

<?php do_action( 'advance_blogging_below_slider' ); ?>

<section id="latest">
	<div class="container">	
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<?php 
		              $page_query = new WP_Query(array( 'category_name' => esc_html(get_theme_mod('advance_blogging_latest_post_setting'),'theblog')));?>
		              <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
		                 	<div class="col-md-6">
		                 		<div class="post-section">
				                    <div class="latest-post">
				                    	<div class="latest-img-box">
					                    	<?php if(has_post_thumbnail()) { ?>
											    <?php the_post_thumbnail();  ?>
												<div class="metabox">
												    <div class="dateday"><?php echo esc_html( get_the_date( 'd') ); ?></div>
												    <hr class="metahr m-0 p-0">
												    <div class="month"><?php echo esc_html( get_the_date( 'M' ) ); ?></div>
												    <div class="year"><?php echo esc_html( get_the_date( 'Y' ) ); ?></div>
												</div>
											<?php } ?>
										</div>
				                      	<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
				                      	<p><?php the_excerpt(); ?></p>
				                    </div>
				                    <div class="button-post">
			                  			<a href="<?php echo esc_url( get_permalink() );?>" class="blog-btn" title="<?php esc_attr_e( 'READ MORE', 'advance-blogging' ); ?>"><?php esc_html_e('READ MORE','advance-blogging'); ?></a>
			                  		</div>
		                  		</div>
		                  	</div>
		              <?php endwhile;
		              wp_reset_postdata();
		            ?>
	        	</div>
			</div>
			<div class="col-md-4">
				<div id="sidebar"><?php dynamic_sidebar('home'); ?></div>
			</div>
		</div>
	</div>
</section>
<?php do_action( 'advance_blogging_below_product_section' ); ?>

<div class="container">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>