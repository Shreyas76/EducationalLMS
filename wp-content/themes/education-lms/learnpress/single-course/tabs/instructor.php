<?php
/**
 * Template for displaying instructor of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/instructor.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = LP_Global::course();
?>

<div class="course-author">

	<?php do_action( 'learn-press/before-single-course-instructor' ); ?>

	<div class="author-name">
		<?php echo $course->get_instructor()->get_profile_picture(); ?>
		<div class="socials">
			<?php echo $course->get_instructor_html(); ?>
			<div class="author-bio">
				<?php echo $course->get_author()->get_description(); ?>
			</div>
		</div>
	</div>



	<?php do_action( 'learn-press/after-single-course-instructor' ); ?>

</div>