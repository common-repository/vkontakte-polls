<?php 
/**
 * Plugin Name: Vkontakte Polls
 * Plugin URI: http://plugins.yourwordpresscoder.com/vkpolls/
 * Description: Display VKontakte polls widget on your site
 * Version: 1.0
 * Author: Your Wordpress Coder
 * Author URI: http://plugins.yourwordpresscoder.com/vkcomments/
 */

add_action( 'widgets_init', 'load_vkpolls_featured_widget' );

function load_vkpolls_featured_widget() {
	register_widget( 'VKPolls_widget' );
}

class VKPolls_widget extends WP_Widget {
	
	function VKPolls_widget() {
        
		load_plugin_textdomain ( 'vkpolls' , false, 'vkpolls/languages'  );
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'vkontakte_polls_widget', 'description' => __('Display your VKontakte polls on your website', 'vkpolls') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'vkontakte-polls-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'vkontakte-polls-widget', __('Vkontakte polls', 'vkpolls'), $widget_ops, $control_ops );
		
		
    }
	
	function widget( $args, $instance ) {
		global $wpdb;
		extract( $args );
		
		$title = apply_filters('widget_title', 'VKontakte Polls' );
		$on_page = $instance['on_page'];
	
		echo $before_widget;

		if ( $title ):
			echo $before_title . __($instance['vkontakte_polls_widget_title']) . $after_title;
        ?>
        <script type="text/javascript" src="http://userapi.com/js/api/openapi.js?20"></script>

        <script type="text/javascript">
            VK.init({apiId: <?php echo $instance['vkontakte_polls_api']; ?>, onlyWidgets: true});
        </script>
        <div id="<?php echo $instance['vkontakte_polls_widget_containter_id']; ?>"></div>
        <script type="text/javascript">
            VK.Widgets.Poll("<?php echo $instance['vkontakte_polls_widget_containter_id']; ?>", {width: "<?php echo $instance['vkontakte_polls_widget_width']; ?>"}, "<?php echo $instance['vkontakte_polls_poll_id']; ?>");
        </script>
        <?php
        endif;

		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

        $instance['vkontakte_polls_widget_title'] = strip_tags( $new_instance['vkontakte_polls_widget_title'] );
		$instance['vkontakte_polls_widget_width'] = (int)( $new_instance['vkontakte_polls_widget_width'] );
		$instance['vkontakte_polls_api'] = (int)$new_instance['vkontakte_polls_api'];
        $instance['vkontakte_polls_widget_containter_id'] = strip_tags( $new_instance['vkontakte_polls_widget_containter_id'] );
        $instance['vkontakte_polls_poll_id'] = strip_tags( $new_instance['vkontakte_polls_poll_id'] );

		return $instance;
	}
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'vkontakte_polls_poll_id' => '','vkontakte_polls_widget_containter_id' => 'vkontakte_polls','vkontakte_polls_widget_title' => 'Polls', 'vkontakte_polls_api' => '', 'vkontakte_polls_widget_width' => '200' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'vkontakte_polls_widget_title' ); ?>"><?php _e('Widget title', 'vkpolls')?>:</label>
			<input id="<?php echo $this->get_field_id( 'vkontakte_polls_widget_title' ); ?>" name="<?php echo $this->get_field_name( 'vkontakte_polls_widget_title' ); ?>" value="<?php echo $instance['vkontakte_polls_widget_title']; ?>" />
		</p>
    	
		<p>
			<label for="<?php echo $this->get_field_id( 'vkontakte_polls_api' ); ?>"><?php _e('VKontakte API ID', 'vkpolls')?>:</label>
			<input id="<?php echo $this->get_field_id( 'vkontakte_polls_api' ); ?>" name="<?php echo $this->get_field_name( 'vkontakte_polls_api' ); ?>" value="<?php echo $instance['vkontakte_polls_api']; ?>" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'vkontakte_polls_poll_id' ); ?>"><?php _e('Your poll ID', 'vkpolls')?>:</label>
			<input id="<?php echo $this->get_field_id( 'vkontakte_polls_poll_id' ); ?>" name="<?php echo $this->get_field_name( 'vkontakte_polls_poll_id' ); ?>" value="<?php echo $instance['vkontakte_polls_poll_id']; ?>" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'vkontakte_polls_widget_containter_id' ); ?>"><?php _e('Container div ID', 'vkpolls')?>:</label>
			<input id="<?php echo $this->get_field_id( 'vkontakte_polls_widget_containter_id' ); ?>" name="<?php echo $this->get_field_name( 'vkontakte_polls_widget_containter_id' ); ?>" value="<?php echo $instance['vkontakte_polls_widget_containter_id']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'vkontakte_polls_widget_width' ); ?>"><?php _e('Width of container', 'vkpolls')?>:</label>
			<input id="<?php echo $this->get_field_id( 'vkontakte_polls_widget_width' ); ?>" name="<?php echo $this->get_field_name( 'vkontakte_polls_widget_width' ); ?>" value="<?php echo $instance['vkontakte_polls_widget_width']; ?>" />
		</p>
		
	<?php
	}
	
	
}

