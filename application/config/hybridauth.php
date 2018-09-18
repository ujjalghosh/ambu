<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| HybridAuth settings
| -------------------------------------------------------------------------
| Your HybridAuth config can be specified below.
|
| See: https://github.com/hybridauth/hybridauth/blob/v2/hybridauth/config.php
*/
$config['hybridauth'] = array(
  "providers" => array(
    // openid providers
    "OpenID" => array(
      "enabled" => FALSE,
    ),
    "Yahoo" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
    ),
    "AOL" => array(
      "enabled" => FALSE,
    ),
    "Google" => array(
      "enabled" => TRUE,
      "keys" => array("id" => "715916233098-bpus8t08odc8j2u32r64gd397t9vbfmv.apps.googleusercontent.com", "secret" => "zThq-F6eDmZNSs2kcHg1mVhx"),
      "redirect_uri"=>base_url()."hauth/endpoint?hauth_done=Google",
      "scope"   => "https://www.googleapis.com/auth/plus.login ". // optional
                       "https://www.googleapis.com/auth/plus.me ". // optional
                       "https://www.googleapis.com/auth/plus.profile.emails.read", // optional
                "access_type"     => "offline",   // optional
                "approval_prompt" => "force"
    ),
    "Facebook" => array(
      "enabled" => TRUE,
      "keys" => array("id" => "369912936806451", "secret" => "c1087a1869bc5ca4fe2feebb41cf0f1e"),
      "trustForwarded" => FALSE,
       "redirect_uri"=>base_url()."hauth/endpoint?hauth_done=Facebook"
    ),
    "Twitter" => array(
      "enabled" => FALSE,
      "keys" => array("key" => "", "secret" => ""),
      "includeEmail" => FALSE,
    ),
    "Live" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
    ),
    "LinkedIn" => array(
      "enabled" => TRUE,
      "keys" => array("id" => "81r9tlhdb59kev", "secret" => "PgWSWc6L4OnALtDq"),
      "scope"   => array("r_basicprofile", "r_emailaddress", "w_share"), // optional
      "fields" => array("id", "email-address", "first-name", "last-name","location","picture-url","picture-urls::(original)"),
    ),
    "Foursquare" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
    ),
  ),
  // If you want to enable logging, set 'debug_mode' to true.
  // You can also set it to
  // - "error" To log only error messages. Useful in production
  // - "info" To log info and error messages (ignore debug messages)
  "debug_mode" => ENVIRONMENT === 'development',
  // Path to file writable by the web server. Required if 'debug_mode' is not false
  "debug_file" => APPPATH . 'logs/hybridauth.log',
);
