<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'bluemasters_options', 'bluemasters_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'BlueMasters Options' ), __( 'BlueMasters Options' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
		<?php endif; ?>

		<p>Welcome to the Bluemasters Options page, from here you can modify things like your homepage, your social links and soon more stuff!</p>

		<form method="post" action="options.php" id="bluemasters_form">
			<?php settings_fields( 'bluemasters_options' ); ?>
			<?php $options = get_option( 'bluemasters_theme_options' ); ?>

			<h3>Portfolio Images</h3>
			
			<div class="bluemasters_section">
				<table class="form-table">
				
					<?php
					/**
					 * Homepage portfolio images
					 */
					?>

				<?php
				/**
				 * Select Portfolio Category from a dropdown list
				 */
				?>
				<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[portfolio_cat_id]"><?php _e( 'Select portfolio category' ); ?></label></th>
					<td>
						 <?php 
						 	$cat_args = array(
								'selected'		=> $options['portfolio_cat_id'],
								'orderby'		=> 'name',
								'name'			=> 'bluemasters_theme_options[portfolio_cat_id]',
								'depth'			=> 1,
								);
							wp_dropdown_categories( $cat_args ); ?> 						
					</td>
				</tr>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[portfolio_item_number]"><?php _e( 'Number of portfolio items on homepage (default 4):' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[portfolio_item_number]" class="regular-text" type="text" name="bluemasters_theme_options[portfolio_item_number]" value="<?php esc_attr_e( $options['portfolio_item_number'] ); ?>" />
						
						</td>
					</tr>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[gallery_item_number]"><?php _e( 'Number of portfolio items on gallery (default 12):' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[gallery_item_number]" class="regular-text" type="text" name="bluemasters_theme_options[gallery_item_number]" value="<?php esc_attr_e( $options['gallery_item_number'] ); ?>" />
						
						</td>
					</tr>
				<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[portfolio_exclude]"><?php _e( 'Exclude Portfolio posts from blog list?' ); ?></label></th>
					<td>
						<input id="bluemasters_theme_options[portfolio_exclude]" name="bluemasters_theme_options[portfolio_exclude]" type="checkbox" value="1" <?php checked( '1', $options['portfolio_exclude'] ); ?> />
						
					</td>
				</tr>

				</table>
			</div>

			<h3>About the site</h3>

			<div class="bluemasters_section">
				<table class="form-table">
					<?php
					/**
					 * About text
					 */
					?>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[about_image]"><?php _e( 'About image (250px)' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[about_image]" class="regular-text" type="text" name="bluemasters_theme_options[about_image]" value="<?php esc_attr_e( $options['about_image'] ); ?>" />
						
						</td>
					</tr>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[about_text]"><?php _e( 'About text on homepage' ); ?></label></th>
						<td>
							<textarea id="bluemasters_theme_options[about_text]" class="large-text" cols="50" rows="10" name="bluemasters_theme_options[about_text]"><?php echo stripslashes( $options['about_text'] ); ?></textarea>
						
						</td>
					</tr>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[about_url]"><?php _e( 'URL to about page' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[about_url]" class="regular-text" type="text" name="bluemasters_theme_options[about_url]" value="<?php esc_attr_e( $options['about_url'] ); ?>" />
						
						</td>
					</tr>
				
					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[about_links_cat]"><?php _e( 'Link category for the "About us" section' ); ?></label></th>
						<td>
						<select name="bluemasters_theme_options[about_links_cat]">

							<?php
								$selected = $options['about_links_cat'];	
								$p = '';
								$r = '';
								$link_categories = get_terms('link_category', 'orderby=count&hide_empty=0');
								foreach($link_categories as $link_category) {
									$label = $link_category->name;
									if ( $selected == $link_category->term_id)// Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $link_category->term_id ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $link_category->term_id ) . "'>$label</option>";

								}
								echo $p . $r;
							?>
						</select>
						
						</td>
					</tr>

				</table>
			</div>

			<h3>"Get in touch" info</h3>
		
			<div class="bluemasters_section">
				<table class="form-table">
                	<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[git_name]"><?php _e( 'Your Name' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[git_name]" class="regular-text" type="text" name="bluemasters_theme_options[git_name]" value="<?php esc_attr_e( $options['git_name'] ); ?>" />
						
						</td>
					</tr>
                    
                    <tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[git_adress]"><?php _e( 'Your Address (only shown on contact page)' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[git_address]" class="regular-text" type="text" name="bluemasters_theme_options[git_address]" value="<?php esc_attr_e( $options['git_address'] ); ?>" />
						
						</td>
					</tr>
                    
					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[git_phone]"><?php _e( 'Phone number' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[git_phone]" class="regular-text" type="text" name="bluemasters_theme_options[git_phone]" value="<?php esc_attr_e( $options['git_phone'] ); ?>" />
						
						</td>
					</tr>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[git_email]"><?php _e( 'e-mail' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[git_email]" class="regular-text" type="text" name="bluemasters_theme_options[git_email]" value="<?php esc_attr_e( $options['git_email'] ); ?>" />
						
						</td>
					</tr>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[git_skype]"><?php _e( 'Skype' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[git_skype]" class="regular-text" type="text" name="bluemasters_theme_options[git_skype]" value="<?php esc_attr_e( $options['git_skype'] ); ?>" />
						
						</td>
					</tr>
                    
                    <tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[git_info]"><?php _e( 'A little text to show on the "contact sidebar".' ); ?></label></th>
						<td>
							<textarea id="bluemasters_theme_options[git_info]" class="large-text" cols="50" rows="10" name="bluemasters_theme_options[git_info]"><?php echo stripslashes( $options['git_info'] ); ?></textarea>
						
						</td>
					</tr>
				</table>
			</div>
			
			<h3>Social Links</h3>

			<div class="bluemasters_section">
				<table class="form-table">
					<?php
					/**
					 * Social Links
					 */
					?>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[social_facebook]"><?php _e( 'Facebook' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[social_facebook]" class="regular-text" type="text" name="bluemasters_theme_options[social_facebook]" value="<?php esc_attr_e( $options['social_facebook'] ); ?>" />
						
						</td>
					</tr>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[social_flickr]"><?php _e( 'Flickr' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[social_flickr]" class="regular-text" type="text" name="bluemasters_theme_options[social_flickr]" value="<?php esc_attr_e( $options['social_flickr'] ); ?>" />
						
						</td>
					</tr>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[social_linkedin]"><?php _e( 'LinkedIn' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[social_linkedin]" class="regular-text" type="text" name="bluemasters_theme_options[social_linkedin]" value="<?php esc_attr_e( $options['social_linkedin'] ); ?>" />
						
						</td>
					</tr>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[social_tumblr]"><?php _e( 'Tumblr' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[social_tumblr]" class="regular-text" type="text" name="bluemasters_theme_options[social_tumblr]" value="<?php esc_attr_e( $options['social_tumblr'] ); ?>" />
						
						</td>
					</tr>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[social_twitter]"><?php _e( 'Twitter Username (<strong>NO URL</strong>)' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[social_twitter]" class="regular-text" type="text" name="bluemasters_theme_options[social_twitter]" value="<?php esc_attr_e( $options['social_twitter'] ); ?>" />
						
						</td>
					</tr>

					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[social_youtube]"><?php _e( 'Youtube' ); ?></label></th>
						<td>
							<input id="bluemasters_theme_options[social_youtube]" class="regular-text" type="text" name="bluemasters_theme_options[social_youtube]" value="<?php esc_attr_e( $options['social_youtube'] ); ?>" />
						
						</td>
					</tr>
				</table>
			</div>
			
			<h3>Footer</h3>
			
			<div class="bluemasters_section">

				<table class="form-table">
				
					<tr valign="top"><th scope="row"><label class="description" for="bluemasters_theme_options[footer_link_number]"><?php _e( 'Link category for the "Footer Links"' ); ?></label></th>
						<td>
						<select name="bluemasters_theme_options[footer_links_cat]">

							<?php
								$selected = $options['footer_links_cat'];	
								$p = '';
								$r = '';
								$footer_link_categories = get_terms('link_category', 'orderby=name&hide_empty=0');
								foreach($link_categories as $links_category) {
									$label = $links_category->name;
									if ( $selected == $links_category->term_id) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $links_category->term_id ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $links_category->term_id ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						
						</td>
					</tr>
				
				</table>
			</div>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $radio_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['portfolio_item_number'] = wp_filter_nohtml_kses( $input['portfolio_item_number'] );
	$input['gallery_item_number'] = wp_filter_nohtml_kses( $input['gallery_item_number'] );
	$input['portfolio_exclude'] = wp_filter_nohtml_kses( $input['portfolio_exclude'] );
	$input['about_image'] = wp_filter_nohtml_kses( $input['about_image'] );
	$input['about_url'] = wp_filter_nohtml_kses( $input['about_url'] );
	$input['git_name'] = wp_filter_nohtml_kses( $input['git_name'] );
	$input['git_address'] = wp_filter_nohtml_kses( $input['git_address'] );
	$input['git_phone'] = wp_filter_nohtml_kses( $input['git_phone'] );
	$input['git_email'] = wp_filter_nohtml_kses( $input['git_email'] );
	$input['git_skype'] = wp_filter_nohtml_kses( $input['git_skype'] );
	$input['social_facebook'] = wp_filter_nohtml_kses( $input['social_facebook'] );
	$input['social_flickr'] = wp_filter_nohtml_kses( $input['social_flickr'] );
	$input['social_linkedin'] = wp_filter_nohtml_kses( $input['social_linkedin'] );
	$input['social_tumblr'] = wp_filter_nohtml_kses( $input['social_tumblr'] );
	$input['social_twitter'] = wp_filter_nohtml_kses( $input['social_twitter'] );
	$input['social_youtube'] = wp_filter_nohtml_kses( $input['social_youtube'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['about_link_number'], $link_categories ) )
		$input['about_link_number'] = null;
	if ( ! array_key_exists( $input['footer_link_number'], $footer_link_categories ) )
		$input['footer_link_number'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['about_text'] = wp_filter_post_kses( $input['about_text'] );
	$input['git_info'] = wp_filter_post_kses( $input['git_info'] );	

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/

function wp_bluemasters_admin_css() {
	?>
	<style type="text/css">
		<!--
			#bluemasters_form h3 {
				background: #E3E3E3;
				padding: 12px;
				margin-bottom: 0 !important
			}
			#bluemasters_form .bluemasters_section {
				border: 1px solid #E3E3E3;
				padding: 0 6px
			}
			#bluemasters_form table {				
				margin-top: 0 !important;
				border-collapse: collapse;
				border-bottom: 2px solid #F9F9F9;
			}
			#bluemasters_form table td, #bluemasters_form table th {
				padding: 12px 6px;
				border-bottom: 1px solid #E3E3E3
			}
			#bluemasters_form .message {
				padding: 12px;
				border: 2px dashed #98BFE6;
				background: #EAF2FA;
				line-height: 23px;
				font-weight: bold;
			}
		-->
	</style>
	<script type="text/javascript">
	/* <![CDATA[ */
		jQuery.noConflict();
		(function($) { 
			$(function() {
				
				$('.bluemasters_section').hide();
				$('#bluemasters_form h3').css({
					'cursor':'pointer'
				}).hover(function() {
					$(this).css({	'background-color' : '#ddd'	});
				}, function() {
					$(this).css({	'background-color' : '#E3E3E3'	});
				});
				$('#bluemasters_form h3').click(function(){
					$(this).next('.bluemasters_section:eq(0)').slideToggle();
				});
				
			});
		})(jQuery);
	/* ]]> */
	</script>

<?php

}
add_action('admin_head', 'wp_bluemasters_admin_css');
	
?>