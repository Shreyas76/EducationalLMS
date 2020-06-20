<?php
/**
 * Template for displaying setup form of static pages while setting up LP
 *
 * @author  ThimPress
 * @package LearnPress/Admin/Views
 * @version 3.0.0
 */

defined( 'ABSPATH' ) or exit;

$settings = LP()->settings();
?>
<h2><?php _e( 'Static Pages', 'learnpress' ); ?></h2>

<p><?php _e( 'The pages will display content of LP\'s necessary pages, such as: Courses, Checkout, Profile', 'learnpress' ); ?></p>
<p><?php printf( __( 'If you are not sure, click <a href="%s" id="create-pages">here</a> to create pages automatically.', 'learnpress' ), wp_nonce_url( admin_url( 'index.php?page=lp-setup&step=pages&auto-create' ) ), 'setup-create-pages' ); ?></p>

<table class="form-field">
    <tr>
        <th>
			<?php _e( 'Courses', 'learnpress' ); ?>
			<?php learn_press_quick_tip( __( 'Page will display all courses inside.', 'learnpress' ) ); ?>
        </th>
        <td>
			<?php learn_press_pages_dropdown( 'settings[pages][courses_page_id]', $settings->get( 'courses_page_id' ) ); ?>
        </td>
    </tr>
    <tr>
        <th>
            <?php _e( 'Profile', 'learnpress' ); ?>
	        <?php learn_press_quick_tip( __( 'Page will display content of user profile.', 'learnpress' ) ); ?>
        </th>
        <td>
			<?php learn_press_pages_dropdown( 'settings[pages][profile_page_id]', $settings->get( 'profile_page_id' ) ); ?>
        </td>
    </tr>
    <tr>
        <th>
            <?php _e( 'Checkout', 'learnpress' ); ?>
            <?php learn_press_quick_tip( __( 'Page will display content of form for processing checkout.', 'learnpress' ) ); ?>
        </th>
        <td>
			<?php learn_press_pages_dropdown( 'settings[pages][checkout_page_id]', $settings->get( 'checkout_page_id' ) ); ?>
        </td>
    </tr>
    <tr>
        <th>
            <?php _e( 'Become a Teacher', 'learnpress' ); ?>
            <?php learn_press_quick_tip( __( 'Page will display the form for submitting request to become a teacher.', 'learnpress' ) ); ?>
        </th>
        <td>
			<?php learn_press_pages_dropdown( 'settings[pages][become_a_teacher_page_id]', $settings->get( 'become_a_teacher_page_id' ) ); ?>
        </td>
    </tr>
</table>
