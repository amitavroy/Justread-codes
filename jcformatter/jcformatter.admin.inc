<?php

function jcformatter_settings_form() {
  $form['jcformatter'] = array();

  $form['#submit'][] = 'jcformatter_settings_form_submit';
  return system_settings_form($form);
}

function jcformatter_settings_form_submit($form, $form_state) {
  
}