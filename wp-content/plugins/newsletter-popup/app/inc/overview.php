<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="wrap">
<?php $this->load_help_desk();?>
		<div id="icon-wp_newsletter-popup" class="icon32"><br></div>			
		<h2><?php _e('Newsletter Popup Version', 'nlp'); ?> <?php echo MK_NEWSLETTER_VERSION; ?> </h2>		 
		<div id="welcome-panel" class="welcome-panel">
			<div class="welcome-panel-content">
				<h3><?php _e('Newsletter Popup Plugin', 'nlp'); ?> <a href="http://newsletterpopup.webdesi9.com/product/newsletter-popup/" target="_blank" class="page-title-action">Buy PRO</a></h3>
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h4><?php _e('Get Started', 'nlp'); ?></h4>
						<a class="button button-primary button-hero" href="admin.php?page=wp_newsletter_type"><?php _e(' Create A New Newsletter Popup', 'nlp'); ?></a>
					</div>
					<div class="welcome-panel-column welcome-panel-last">
						<h4><?php _e('More Actions', 'nlp'); ?></h4>
						<ul>
							<li><a href="admin.php?page=wp_newsletter_show_items" class="welcome-icon welcome-widgets-menus"><?php _e('Manage Existing Newsletter Popups', 'nlp'); ?></a></li>
							<li><a href="http://webdesi9.com/shop/" target="_blank" class="welcome-icon welcome-widgets-menus"><?php _e('Our Products', 'nlp'); ?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>	
<div class="clear"></div></div>