<?php

class Stm_Contacts_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'contacts', // Base ID
			__('Contacts', 'cinderella'), // Name
			array( 'description' => __( 'Contacts widget', 'cinderella' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}
		echo '<ul>';
		if(!empty($instance['address'])){
			echo '<li><div class="icon"><i class="fa fa-map-marker"></i></div><div class="text">' . nl2br( esc_html( $instance['address'] ) ) . '</div></li>';
		}

		if(!empty($instance['phone'])){
			echo '<li><div class="icon"><i class="fa fa-phone"></i></div><div class="text">' . nl2br( esc_html( $instance['phone'] ) ) . '</div></li>';
		}

		if(!empty($instance['fax'])){
			echo '<li><div class="icon"><i class="fa fa-fax"></i></div><div class="text">' . nl2br( esc_html( $instance['fax'] ) ) . '</div></li>';
		}

		if(!empty($instance['email'])){
			echo '<li><div class="icon"><i class="fa fa-envelope"></i></div><div class="text"><a href="mailto:'. antispambot( $instance['email'] ) .'">'. antispambot( $instance['email'] ) .'</a></div></li>';
		}
		echo '</ul>';


		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$title = '';
		$address = '';
		$phone = '';
		$fax = '';
		$email = '';

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}else {
			$title = __( 'Contact', 'cinderella' );
		}

		if ( isset( $instance[ 'address' ] ) ) {
			$address = $instance[ 'address' ];
		}

		if ( isset( $instance[ 'phone' ] ) ) {
			$phone = $instance[ 'phone' ];
		}

		if ( isset( $instance[ 'fax' ] ) ) {
			$fax = $instance[ 'fax' ];
		}

		if ( isset( $instance[ 'email' ] ) ) {
			$email = $instance[ 'email' ];
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'cinderella' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php _e( 'Address:', 'cinderella' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"><?php echo esc_textarea( $address ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php _e( 'Phone:', 'cinderella' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>"><?php echo esc_textarea( $phone ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>"><?php _e( 'Fax:', 'cinderella' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fax' ) ); ?>"><?php echo esc_textarea( $fax ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php _e( 'E-mail:', 'cinderella' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" value="<?php echo sanitize_email( $email ); ?>">
		</p>
	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $new_instance['address'] ) ) ) : '';
		$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $new_instance['phone'] ) ) ) : '';
		$instance['fax'] = ( ! empty( $new_instance['fax'] ) ) ? implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $new_instance['fax'] ) ) ) : '';
		$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? sanitize_email( $new_instance['email'] ) : '';

		return $instance;
	}

}

function register_contacts_widget() {
	register_widget( 'Stm_Contacts_Widget' );
}
add_action( 'widgets_init', 'register_contacts_widget' );