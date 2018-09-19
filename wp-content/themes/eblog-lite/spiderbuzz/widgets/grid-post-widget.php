<?php
/**
 *Eblog Lite List View
 */
class Eblog_Lite_Grid_Section extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'eblog_lite_grid_blog_section', // Base ID
			esc_html__( 'eBlog Lite: Grids View', 'eblog-lite' ), //Widget Name
			array( 'description' => esc_html__( 'Display Latest Posts.', 'eblog-lite' ), ) // Args
		);
	}
	/**
     * Widget Form Section
     */
	public function form( $instance ) {
		$defaults = array(
            'category'		=> 'all',
            'title'         => 'Popular Post',
            'number_posts'	=> 6,
            'enable_header_title_sec'=> true,
            'grid_column_layout'    => '3-column-grid'
		);
        $instance = wp_parse_args( (array) $instance, $defaults );
        
        ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'eblog-lite' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label><?php esc_html_e( 'Select a post category:', 'eblog-lite' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category'), 'selected' => $instance['category'], 'show_option_all' => 'Show all posts', 'class' => 'widefat' ) ); ?>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts' ); ?>"><?php esc_html_e( 'Number of posts:', 'eblog-lite' ); ?></label>
			<input class="widefat" type="number" id="<?php echo $this->get_field_id( 'number_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_posts' );?>" value="<?php echo absint( $instance['number_posts'] ); ?>" size="3"/> 
		</p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance[ 'enable_header_title_sec' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'enable_header_title_sec' ); ?>" name="<?php echo $this->get_field_name( 'enable_header_title_sec' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'enable_header_title_sec' ); ?>"><?php esc_html_e('Enable Header Section','eblog-lite'); ?></label>
        </p>
					
	<?php

	}

    /**
     * Post Update 
     */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );	
        $instance[ 'category' ]	= absint( $new_instance[ 'category' ] );
        $instance[ 'number_posts' ] = (int)$new_instance[ 'number_posts' ];
        $instance[ 'enable_header_title_sec' ] = $new_instance[ 'enable_header_title_sec' ];
		return $instance;
	}


    /**
     * Front End Display
     */
	public function widget( $args, $instance ) {
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';	
        $eblog_lite_title = apply_filters( 'widget_title', $title , $instance, $this->id_base );
		$eblog_lite_cat_id = ( ! empty( $instance['category'] ) ) ? absint( $instance['category'] ) : '';
		$eblog_lite_post_cunt = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 6; 
        $enable_header_title_sec = $instance[ 'enable_header_title_sec' ] ? true : false;// Latest Posts
		
        
        //Title 
        if( !empty($eblog_lite_title) ){
            $eblog_list_title_filter = $eblog_lite_title;
            $eblog_lite_grid_title_link = get_category_link($eblog_lite_cat_id);
        }else{
            $eblog_lite_grid_title_link = get_category_link($eblog_lite_cat_id);
            $eblog_list_title_filter = get_cat_name($eblog_lite_cat_id);
        }

	?>
        <section> 
            <?php if($enable_header_title_sec == true): ?>
                <div class="section-head">
                    <div class="section-title">
                        <?php  ?>
                            <h2><?php echo esc_html($eblog_list_title_filter); ?></h2>
                    </div>
                    <div class="view-all">
                        <a href="<?php echo esc_attr($eblog_lite_grid_title_link); ?>"><?php esc_html_e('View All','eblog-lite'); ?></a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="post-grid-view row">
                <?php 
                    $args = array('post_type'=>'post','posts_per_page'=>$eblog_lite_post_cunt,'cat'=>$eblog_lite_cat_id);
                    $blog_query = new WP_Query( $args ); 
                    
                    while($blog_query->have_posts()): $blog_query->the_post(); 
                ?>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="post-image post-list-image"> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
                    <div class ="section-meta">
                        <h4 class="meta-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
	<?php
		echo $after_widget;
	}
}
// Register The Category Posts
function eblog_lite_grid_section_config() {
    register_widget( 'Eblog_Lite_Grid_Section' );
}
add_action( 'widgets_init', 'eblog_lite_grid_section_config' );