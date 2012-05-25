<?php

function jcformatter_settings_form() {
  $form['jcformatter'] = array();
  
  $form['google_analytics_code'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Analytics code'),
    '#description' => t('Code should look something like this: UA-XXXXXXXX-X'),
    '#size' => 20,
    '#maxlength' => 13,
  );
  $form['#submit'][] = 'jcformatter_settings_form_submit';
  return system_settings_form($form);
}

function jcformatter_settings_form_submit($form, $form_state) {

}