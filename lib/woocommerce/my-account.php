<?php

// add privacy when account is registered

add_action('woocommerce_register_form', 'add_registration_privacy_policy', 11);
   
function add_registration_privacy_policy() {
 
woocommerce_form_field('privacy_policy_reg', array(
   'type'          => 'checkbox',
   'class'         => array('form-row privacy'),
   'label_class'   => array('my-account__checkbox-label'),
   'input_class'   => array('my-account__checkbox-input'),
   'required'      => true,
   'label'         => 'Akceptuję &nbsp;<a href="/polityka-prywatnosci">politykę prywatności</a>',
));
 
woocommerce_form_field('terms_reg', array(
   'type'          => 'checkbox',
   'class'         => array('form-row privacy'),
   'label_class'   => array('my-account__checkbox-label'),
   'input_class'   => array('my-account__checkbox-input'),
   'required'      => true,
   'label'         => 'Akceptuję&nbsp;<a href="/regulamin">regulamin</a>',
));
  
}
  
// Show error if user does not tick privacy on my account page
   
add_filter('woocommerce_registration_errors', 'validate_privacy_registration', 10, 3);
  
function validate_privacy_registration($errors, $username, $email) {
if (! is_checkout()) {
    if (! (int) isset($_POST['privacy_policy_reg']) || ! (int) isset($_POST['terms_reg'])) {
        $errors->add('privacy_policy_reg_error', __('Zaakceptuj politykę prywatności i regulamin, aby przejść dalej', 'woocommerce'));
    }
}
return $errors;
}
