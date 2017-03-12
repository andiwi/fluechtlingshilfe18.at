<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package Theme Horse
 * @subpackage Ambition
 * @since Ambition 1.0
 */
/****************************************************************************************/
add_action('widgets_init', 'ambitionchild_widgets_init');
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function ambitionchild_widgets_init()
{
	// Registering Business Page template sidebar
	register_sidebar(array(
		'name' => __('Business Page Section', 'ambition') ,
		'id' => 'ambition_business_page_sidebar',
		'description' => __('Shows widgets on Business Page Template. Suitable widget: TH:Landing Page, TH: Featured Page, TH: Featured Recent Work, TH: Testimonial, TH: Services, TH: PromoBox', 'ambition') ,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

	// Registering widgets
  	register_widget("ambitionchild_landingpage_widget");
	register_widget("ambitionchild_contact_widget");
}
/****************************************************************************************/
/**
 * Widget for business layout that shows selected page content,title and featured image.
 * Construct the widget.
 * i.e. Name, description and control options.
 */
class ambitionchild_landingpage_widget extends WP_Widget

{
	/**
	* Sets up the widgets name etc
	*/
	function ambitionchild_landingpage_widget()
	{
	$widget_ops = array(
			'classname' => 'widget_landingpage',
			'description' => __('Display Landing Page ( Business Layout )', 'ambition-child')
		);
		$control_ops = array(
			'width' => 200,
			'height' => 250
		);
	$name = __('TH: Landingpage', 'ambition-child');

		parent::__construct(false, $name , $widget_ops, $control_ops);
	}
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	*/
	function widget($args, $instance)
	{
 		extract($args);
 	  	$ambitionchild_img_background = apply_filters('ambitionchild_img_background', empty($instance['ambitionchild_img_background']) ? '' : $instance['ambitionchild_img_background'], $instance, $this->id_base);
 		$ambition_widget_primary = apply_filters('ambition_widget_primary', empty($instance['ambition_widget_primary']) ? '' : $instance['ambition_widget_primary'], $instance, $this->id_base);
 		$ambition_widget_secondary = apply_filters('ambition_widget_secondary', empty($instance['ambition_widget_secondary']) ? '' : $instance['ambition_widget_secondary'], $instance, $this->id_base);
 	  	$ambitionchild_first_btn_text = apply_filters('ambitionchild_first_btn_text', empty($instance['ambitionchild_first_btn_text']) ? '' : $instance['ambitionchild_first_btn_text'], $instance);
 		$ambitionchild_first_btn_redirecturl = apply_filters('ambitionchild_first_btn_redirecturl', empty($instance['ambitionchild_first_btn_redirecturl']) ? '' : $instance['ambitionchild_first_btn_redirecturl'], $instance, $this->id_base);
   		$ambitionchild_second_btn_text = apply_filters('ambitionchild_second_btn_text', empty($instance['ambitionchild_second_btn_text']) ? '' : $instance['ambitionchild_second_btn_text'], $instance);
 		$ambitionchild_second_btn_redirecturl = apply_filters('ambitionchild_second_btn_redirecturl', empty($instance['ambitionchild_second_btn_redirecturl']) ? '' : $instance['ambitionchild_second_btn_redirecturl'], $instance, $this->id_base);    echo $before_widget; ?>

   		<div class="landingpage_bar_content" <?php if (!empty($ambitionchild_img_background)) { ?> style="background-image:url('<?php echo esc_url($ambitionchild_img_background); ?>');" <?php } ?> >
 			<div class="container clearfix">
 				<?php
 				if (!empty($ambition_widget_primary)) { ?>
 					<h2 class="widget-title"><?php echo esc_html($ambition_widget_primary); ?> </h2>
 				<?php }
 				if(!empty($ambition_widget_secondary)) { ?>
 					<p class="highlight-content"><?php echo esc_html($ambition_widget_secondary); ?> </p>
 				<?php }

 				if(!empty($ambitionchild_first_btn_text)) { ?>
 					<a id="landingpage_first_btn" class="call-to-action" href="<?php echo esc_html($ambitionchild_first_btn_redirecturl); ?>" title="<?php echo $ambitionchild_first_btn_text; ?>"><?php echo esc_html($ambitionchild_first_btn_text); ?></a><!-- .call-to-action -->
 				<?php }
       			if(!empty($ambitionchild_second_btn_text)) { ?>
 					<a id="landingpage_second_btn" class="call-to-action" href="<?php echo esc_html($ambitionchild_second_btn_redirecturl); ?>" title="<?php echo $ambitionchild_second_btn_text; ?>"><?php echo esc_html($ambitionchild_second_btn_text); ?></a><!-- .call-to-action -->
 				<?php } ?>
 			</div><!-- .container -->
 		</div><!-- .promotional_bar_content -->
 		<?php echo $after_widget . '<!-- .widget_landingpage_bar -->';
 	}
	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	function update($new_instance, $old_instance)
	{
 		$instance = $old_instance;
 		$instance['ambitionchild_img_background'] = strip_tags($new_instance['ambitionchild_img_background']);
 		$instance['ambitionchild_widget_primary'] = esc_textarea($new_instance['ambitionchild_widget_primary']);
 		$instance['ambitionchild_widget_secondary'] = esc_textarea($new_instance['ambitionchild_widget_secondary']);
 		$instance['ambitionchild_first_btn_text'] = strip_tags($new_instance['ambitionchild_first_btn_text']);
 		$instance['ambitionchild_first_btn_redirecturl'] = esc_url($new_instance['ambitionchild_first_btn_redirecturl']);
    	$instance['ambitionchild_second_btn_text'] = strip_tags($new_instance['ambitionchild_second_btn_text']);
 		$instance['ambitionchild_second_btn_redirecturl'] = esc_url($new_instance['ambitionchild_second_btn_redirecturl']);
 		$instance['filter'] = isset($new_instance['filter']);
 		return $instance;
 	}
	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	function form($instance)
	{
 		$instance = wp_parse_args((array)$instance, array(
 			'ambitionchild_img_background' => '',
 			'ambitionchild_widget_primary' => '',
 			'ambitionchild_widget_secondary' => '',
      		'ambitionchild_first_btn_text' => '',
 			'ambitionchild_first_btn_redirecturl' => '',
      		'ambitionchild_second_btn_text' => '',
 			'ambitionchild_second_btn_redirecturl' => ''
 		));
 		$ambitionchild_img_background = strip_tags($instance['ambitionchild_img_background']);
 		$ambitionchild_widget_primary = esc_textarea($instance['ambitionchild_widget_primary']);
 		$ambitionchild_widget_secondary = esc_textarea($instance['ambitionchild_widget_secondary']);
 		$ambitionchild_first_btn_text = strip_tags($instance['ambitionchild_first_btn_text']);
 		$ambitionchild_first_btn_redirecturl = esc_url($instance['ambitionchild_first_btn_redirecturl']);
		$ambitionchild_second_btn_text = strip_tags($instance['ambitionchild_second_btn_text']);
    	$ambitionchild_second_btn_redirecturl = esc_url($instance['ambitionchild_second_btn_redirecturl']); ?>
 		<p>
 			<label for="<?php echo $this->get_field_id('ambitionchild_img_background'); ?>">
 				<?php _e('Background Image:', 'ambitionchild'); ?>
 			</label>
 			<input type="text" class="upload1" id="<?php echo $this->get_field_id( 'ambitionchild_img_background' ); ?>" name="<?php echo $this->get_field_name('ambitionchild_img_background'); ?>" value="<?php echo $ambitionchild_img_background; ?>"/>

          <input type="button" class="button  custom_media_button"name="<?php echo $this->get_field_name('ambitionchild_img_background'); ?>" id="custom_media_button_services" value="Upload Image" onclick="mediaupload.uploader( '<?php echo $this->get_field_id( 'ambitionchild_img_background' ); ?>' ); return false;"/>

 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id('ambitionchild_widget_primary'); ?>">
 				<?php _e('Primary Header:', 'ambitionchild'); ?>
 			</label>
 			<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('ambitionchild_widget_primary'); ?>" name="<?php echo $this->get_field_name('ambitionchild_widget_primary'); ?>"><?php echo $ambitionchild_widget_primary;?></textarea>
 		</p>
 				<?php _e('Secondary Header', 'ambitionchild'); ?>
 			<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('ambitionchild_widget_secondary'); ?>" name="<?php echo $this->get_field_name('ambitionchild_widget_secondary'); ?>"><?php echo $ambitionchild_widget_secondary; ?></textarea>
 		<p>
 			<label for="<?php echo $this->get_field_id('ambitionchild_first_btn_text'); ?>">
 				<?php _e('First Button Text: (this button scrolls down to the next element', 'ambitionchild'); ?>
 			</label>
 			<input class="widefat" id="<?php echo $this->get_field_id('ambitionchild_first_btn_text'); ?>" name="<?php echo $this->get_field_name('ambitionchild_first_btn_text'); ?>" type="text" value="<?php echo esc_attr($ambitionchild_first_btn_text); ?>" />
 		</p>
 		<!--<p>
 			<label for="<?php echo $this->get_field_id('ambitionchild_first_btn_redirecturl'); ?>">
 				<?php _e('First Button Redirect Url:', 'ambitionchild'); ?>
 			</label>
 			<input class="widefat" id="<?php echo $this->get_field_id('ambitionchild_first_btn_redirecturl'); ?>" name="<?php echo $this->get_field_name('ambitionchild_first_btn_redirecturl'); ?>" type="text" value="<?php echo $ambitionchild_first_btn_redirecturl; ?>" />
 		</p>-->
   		<p>
 			<label for="<?php echo $this->get_field_id('ambitionchild_second_btn_text'); ?>">
 				<?php _e('Second Button Text:', 'ambitionchild'); ?>
 			</label>
 			<input class="widefat" id="<?php echo $this->get_field_id('ambitionchild_second_btn_text'); ?>" name="<?php echo $this->get_field_name('ambitionchild_second_btn_text'); ?>" type="text" value="<?php echo esc_attr($ambitionchild_second_btn_text); ?>" />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id('ambitionchild_second_btn_redirecturl'); ?>">
 				<?php _e('Second Button Redirect Url:', 'ambitionchild'); ?>
 			</label>
 			<input class="widefat" id="<?php echo $this->get_field_id('ambitionchild_second_btn_redirecturl'); ?>" name="<?php echo $this->get_field_name('ambitionchild_second_btn_redirecturl'); ?>" type="text" value="<?php echo $ambitionchild_second_btn_redirecturl; ?>" />
 		</p>
 		<?php
 	}
}

/****************************************************************************************/
/**
 * Widget for business layout that shows selected page content,title and featured image.
 * Construct the widget.
 * i.e. Name, description and control options.
 */
class ambitionchild_contact_widget extends WP_Widget

{
	/**
	 * Sets up the widgets name etc
	 */
	function ambitionchild_contact_widget()
	{
		$widget_ops = array(
			'classname' => 'widget_contact',
			'description' => __('Display Contact Page ( Business Layout )', 'ambition-child')
		);
		$control_ops = array(
			'width' => 200,
			'height' => 250
		);
		$name = __('TH: Contact Widget', 'ambition-child');

		parent::__construct(false, $name , $widget_ops, $control_ops);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget($args, $instance)
	{
		extract($args);
		$ambitionchild_widget_primary = apply_filters('ambitionchild_widget_primary', empty($instance['ambitionchild_widget_primary']) ? '' : $instance['ambitionchild_widget_primary'], $instance, $this->id_base);
		$ambitionchild_widget_secondary = apply_filters('ambitionchild_widget_secondary', empty($instance['ambitionchild_widget_secondary']) ? '' : $instance['ambitionchild_widget_secondary'], $instance, $this->id_base);
		$ambitionchild_email_redirecturl = apply_filters('ambitionchild_email_redirecturl', empty($instance['ambitionchild_email_redirecturl']) ? '' : $instance['ambitionchild_email_redirecturl'], $instance, $this->id_base);
		$ambitionchild_email_link = apply_filters('ambitionchild_email_link', empty($instance['ambitionchild_email_link']) ? '' : $instance['ambitionchild_email_link'], $instance, $this->id_base);
		$ambitionchild_facebook_redirecturl = apply_filters('ambitionchild_facebook_redirecturl', empty($instance['ambitionchild_facebook_redirecturl']) ? '' : $instance['ambitionchild_facebook_redirecturl'], $instance, $this->id_base);
		$ambitionchild_facebook_link = apply_filters('ambitionchild_facebook_link', empty($instance['ambitionchild_facebook_link']) ? '' : $instance['ambitionchild_facebook_link'], $instance, $this->id_base);
		$ambitionchild_telephone_redirecturl = apply_filters('ambitionchild_telephone_redirecturl', empty($instance['ambitionchild_telephone_redirecturl']) ? '' : $instance['ambitionchild_telephone_redirecturl'], $instance, $this->id_base);
		$ambitionchild_telephone_link = apply_filters('ambitionchild_telephone_link', empty($instance['ambitionchild_telephone_link']) ? '' : $instance['ambitionchild_telephone_link'], $instance, $this->id_base);
		echo $before_widget; ?>

		<div class="contact_widget_content">
			<div class="container clearfix">
				<div class="widget-title-container">
				<?php
				if (!empty($ambitionchild_widget_primary)) { ?>
					<h2 class="widget-title"><?php echo esc_html($ambitionchild_widget_primary); ?></h2>
				<?php }
				if(!empty($ambitionchild_widget_secondary)) { ?>
					<p class="highlight-content"><?php echo esc_html($ambitionchild_widget_secondary); ?> </p>
				<?php } ?>
				</div> <!-- .widget-title-container -->
				<div class="widget-contact-container-wrapper">
					<?php if(!empty($ambitionchild_email_redirecturl && !empty($ambitionchild_email_link))) { ?>
						<div class="widget-contact-container">
							<i class="fa fa-envelope"></i>
							<a id="contact-widget-email" class="call-to-action" href="mailto:<?php echo esc_html($ambitionchild_email_redirecturl); ?>" title="<?php echo $ambitionchild_email_link; ?>"><?php echo esc_html($ambitionchild_email_link); ?></a>
						</div>
					<?php }
					if(!empty($ambitionchild_facebook_redirecturl && !empty($ambitionchild_facebook_link))) { ?>
						<div class="widget-contact-container">
							<i class="fa fa-facebook"></i>
							<a id="contact-widget-facebook" class="call-to-action" href="<?php echo esc_html($ambitionchild_facebook_redirecturl); ?>" title="<?php echo $ambitionchild_facebook_link; ?>"><?php echo esc_html($ambitionchild_facebook_link); ?></a>
						</div>
					<?php }
					if(!empty($ambitionchild_telephone_redirecturl && !empty($ambitionchild_telephone_link))) { ?>
						<div class="widget-contact-container">
							<i class="fa fa-phone"></i>
							<a id="contact-widget-telephone" class="call-to-action" href="tel:<?php echo esc_html($ambitionchild_telephone_redirecturl); ?>" title="<?php echo $ambitionchild_telephone_link; ?>"><?php echo esc_html($ambitionchild_telephone_link); ?></a>
						</div>
					<?php } ?>
				</div>
			</div><!-- .container -->
		</div><!-- .contact_widget_content -->
		<?php echo $after_widget . '<!-- .contact_widget_content -->';
	}
	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['ambitionchild_widget_primary'] = esc_textarea($new_instance['ambitionchild_widget_primary']);
		$instance['ambitionchild_widget_secondary'] = esc_textarea($new_instance['ambitionchild_widget_secondary']);
		$instance['ambitionchild_email_redirecturl'] = strip_tags($new_instance['ambitionchild_email_redirecturl']);
		$instance['ambitionchild_email_link'] = strip_tags($new_instance['ambitionchild_email_link']);
		$instance['ambitionchild_facebook_redirecturl'] = esc_url($new_instance['ambitionchild_facebook_redirecturl']);
		$instance['ambitionchild_facebook_link'] = strip_tags($new_instance['ambitionchild_facebook_link']);
		$instance['ambitionchild_telephone_redirecturl'] = strip_tags($new_instance['ambitionchild_telephone_redirecturl']);
		$instance['ambitionchild_telephone_link'] = strip_tags($new_instance['ambitionchild_telephone_link']);
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}
	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	function form($instance)
	{
		$instance = wp_parse_args((array)$instance, array(
			'ambitionchild_widget_primary' => '',
			'ambitionchild_widget_secondary' => '',
			'ambitionchild_email_redirecturl' => '',
			'ambitionchild_email_link' => '',
			'ambitionchild_facebook_redirecturl' => '',
			'ambitionchild_facebook_link' => '',
			'ambitionchild_telephone_redirecturl' => '',
			'ambitionchild_telephone_link' => ''
		));
		$ambitionchild_widget_primary = esc_textarea($instance['ambitionchild_widget_primary']);
		$ambitionchild_widget_secondary = esc_textarea($instance['ambitionchild_widget_secondary']);
		$ambitionchild_email_redirecturl = strip_tags($instance['ambitionchild_email_redirecturl']);
		$ambitionchild_email_link = strip_tags($instance['ambitionchild_email_link']);
		$ambitionchild_facebook_redirecturl = esc_url($instance['ambitionchild_facebook_redirecturl']);
		$ambitionchild_facebook_link = strip_tags($instance['ambitionchild_facebook_link']);
		$ambitionchild_telephone_redirecturl = strip_tags($instance['ambitionchild_telephone_redirecturl']);
		$ambitionchild_telephone_link = strip_tags($instance['ambitionchild_telephone_link']); ?>

		<p>
			<label for="<?php echo $this->get_field_id('ambitionchild_widget_primary'); ?>">
				<?php _e('Primary Header:', 'ambitionchild'); ?>
			</label>
			<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('ambitionchild_widget_primary'); ?>" name="<?php echo $this->get_field_name('ambitionchild_widget_primary'); ?>"><?php echo $ambitionchild_widget_primary;?></textarea>
		</p>
		<?php _e('Secondary Header', 'ambitionchild'); ?>
		<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('ambitionchild_widget_secondary'); ?>" name="<?php echo $this->get_field_name('ambitionchild_widget_secondary'); ?>"><?php echo $ambitionchild_widget_secondary; ?></textarea>
		<!-- email -->
		<p>
			<label for="<?php echo $this->get_field_id('ambitionchild_email_redirecturl'); ?>">
				<?php _e('Email address:', 'ambitionchild'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('ambitionchild_email_redirecturl'); ?>" name="<?php echo $this->get_field_name('ambitionchild_email_redirecturl'); ?>" type="text" value="<?php echo esc_attr($ambitionchild_email_redirecturl); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ambitionchild_email_link'); ?>">
				<?php _e('Button text:', 'ambitionchild'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('ambitionchild_email_link'); ?>" name="<?php echo $this->get_field_name('ambitionchild_email_link'); ?>" type="text" value="<?php echo esc_attr($ambitionchild_email_link); ?>" />
		</p>
		<!-- facebook -->
		<p>
			<label for="<?php echo $this->get_field_id('ambitionchild_facebook_redirecturl'); ?>">
				<?php _e('Facebook URL:', 'ambitionchild'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('ambitionchild_facebook_redirecturl'); ?>" name="<?php echo $this->get_field_name('ambitionchild_facebook_redirecturl'); ?>" type="text" value="<?php echo esc_attr($ambitionchild_facebook_redirecturl); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ambitionchild_facebook_link'); ?>">
				<?php _e('Button text:', 'ambitionchild'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('ambitionchild_facebook_link'); ?>" name="<?php echo $this->get_field_name('ambitionchild_facebook_link'); ?>" type="text" value="<?php echo esc_attr($ambitionchild_facebook_link); ?>" />
		</p>
		<!-- telephone -->
		<p>
			<label for="<?php echo $this->get_field_id('ambitionchild_telephone_redirecturl'); ?>">
				<?php _e('telephone number:', 'ambitionchild'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('ambitionchild_telephone_redirecturl'); ?>" name="<?php echo $this->get_field_name('ambitionchild_telephone_redirecturl'); ?>" type="text" value="<?php echo esc_attr($ambitionchild_telephone_redirecturl); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('ambitionchild_telephone_link'); ?>">
				<?php _e('Button text:', 'ambitionchild'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('ambitionchild_telephone_link'); ?>" name="<?php echo $this->get_field_name('ambitionchild_telephone_link'); ?>" type="text" value="<?php echo esc_attr($ambitionchild_telephone_link); ?>" />
		</p>
<?php
	}
}