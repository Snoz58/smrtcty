<?php

function alert_success($important = "", $description = ""){
  $message = '<div class="alert alert-success">';
  !empty($important) ? $message .= '<strong>'.$important.'</strong> ' : $message .= '';
  !empty($description) ? $message .= $description : $message .= '';
  $message .= '</div>';
  return $message;
}

function alert_info($important = "", $description = ""){
  $message = '<div class="alert alert-info">';
  !empty($important) ? $message .= '<strong>'.$important.'</strong> ' : $message .= '';
  !empty($description) ? $message .= $description : $message .= '';
  $message .= '</div>';
  return $message;
}

function alert_warning($important = "", $description = ""){
  $message = '<div class="alert alert-warning">';
  !empty($important) ? $message .= '<strong>'.$important.'</strong> ' : $message .= '';
  !empty($description) ? $message .= $description : $message .= '';
  $message .= '</div>';
  return $message;
}

function alert_error($important = "", $description = ""){
  $message = '<div class="alert alert-danger">';
  !empty($important) ? $message .= '<strong>'.$important.'</strong> ' : $message .= '';
  !empty($description) ? $message .= $description : $message .= '';
  $message .= '</div>';
  return $message;
}

 ?>
