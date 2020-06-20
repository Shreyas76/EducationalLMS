<?php
/**
 * Template for displaying wrap start of archive course within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/loop/course/loop-begin.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$layout = education_lms_archive_course_layout();

?>

<ul id="lms-course-<?php echo esc_attr( $layout ) ?>" class="learn-press-courses row">
