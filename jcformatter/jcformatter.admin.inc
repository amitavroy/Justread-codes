<?php

function jcformatter_settings_form() {
  $form['jcformatter'] = array();

  $google_analytics = module_exists('googleanalytics');
  $google_analytics_code = variable_get('googleanalytics_account');
  
  if ($google_analytics) {
    $form['google_analytics_code'] = array(
      '#type' => 'checkbox',
      '#title' => t('Google Analytics track'),
      '#description' => t('Check this option if you want to have a page view for each image slide.<br />Tracking code set by Google Analytics: '.$google_analytics_code),
      '#size' => 20,
      '#maxlength' => 13,
    );
  }

  $form['#submit'][] = 'jcformatter_settings_form_submit';
  return system_settings_form($form);
}

function jcformatter_settings_form_submit($form, $form_state) {

}