<?php
function education_lms_posts_widget() {
	register_widget( 'Education_LMS_Posts_Widget' );
}
add_action( 'widgets_init', 'education_lms_posts_widget' );

class Education_LMS_Posts_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'education-lms-posts',
			esc_html__( 'Theme: Popular Posts', 'education-lms' ),
			array(
				'classname' => 'theme-posts-widget',
				'description' => esc_html__( 'Display your latest posts in widget.', 'education-lms' ),
				'customize_selective_refresh' => true
			)
		);
	}
	function widget( $args, $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'number' => 4,
			'orderby' => 'date',
			'order' => 'desc',
			'category' => ''
		) );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$post_args = array(
			'posts_per_page' => absint( $instance['number'] ),
			'order' =>   $instance['order'],
			'orderby' => $instance['orderby'],
			'post_type' => 'post',
			'cat'   => $instance['category']
		);
		$query = new WP_Query( $post_args );
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if ( $query->have_posts() ) {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
			}
			?>
			<ul class="widget-posts list-unstyled"><?php
			while ( $query->have_posts() ) {
				$query->the_post();
				$time_string = sprintf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() )
				);
				?>
				<li class="<?php echo ( has_post_thumbnail() ) ? 'has-thumb' : 'no-thumb'; ?>">
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="p-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
						</div>
					<?php } ?>
					<div class="p-info">
						<h3 class="entry-title"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<?php
						echo '<span class="entry-date">' . get_the_date() . '</span>';
						?>
					</div>
				</li>
				<?php
			}
			?></ul><?php
		}
		wp_reset_postdata();
		echo $args['after_widget'];
	}
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title' => esc_html__( 'Recent Posts', 'education-lms' ),
			'number' => 4,
			'orderby' => 'date',
			'order' => 'desc',
			'category' => ''
		) );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Recent Posts', 'education-lms' );
		$number = absint( $instance['number'] );
		$orderby = $instance['orderby'];
		$order = $instance['order'];
		$cat = $instance['category'];
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'education-lms' ); ?>:
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos', 'education-lms' ); ?>:
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order by', 'education-lms' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" class="widefat">
				<option value="date" <?php selected( 'date', $orderby ) ?>><?php esc_html_e( 'Date', 'education-lms' ); ?></option>
				<option value="title" <?php selected( 'title', $orderby ) ?>><?php esc_html_e( 'Title', 'education-lms' ); ?></option>
				<option value="comment_count" <?php selected( 'Comment count', $orderby ) ?>><?php esc_html_e( 'Comment count', 'education-lms' ); ?></option>
				<option value="rand" <?php selected( 'rand', $orderby ) ?>><?php esc_html_e( 'Random', 'education-lms' ); ?></option>
			</select>
		</p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order', 'education-lms' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" class="widefat">
				<option value="DESC" <?php selected( 'DESC', $order ) ?>><?php esc_html_e( 'DESC', 'education-lms' ); ?></option>
				<option value="ASC" <?php selected( 'ASC', $order ) ?>><?php esc_html_e( 'ASC', 'education-lms' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>">
				<?php esc_html_e( 'Category', 'education-lms' ); ?>:
			</label>
			<?php
			$args = array(
				'name' => $this->get_field_name( 'category' ),
				'show_option_all' => 'ALL',
				'hide_empty' => true,
				'selected' => $cat,
				'class' => 'widefat'
			);
			wp_dropdown_categories( $args ); ?>
		</p>
		<?php
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array(
			'title' => '',
			'number' => 4,
			'orderby' => 'date',
			'order' => 'desc',
			'category' => ''
		) );
		$instance['title'] =  sanitize_text_field( $new_instance['title'] );
		$instance['number'] = ! absint( $new_instance['number'] ) ? 4 : absint( $new_instance['number'] );
		$instance['orderby'] =  sanitize_text_field( $new_instance['orderby'] );
		$instance['order'] =  sanitize_text_field( $new_instance['order'] );
		$instance['category'] = absint( $new_instance['category'] );
		return $instance;
	}
}