<?php
defined('BASEPATH') or exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
    'class'    => 'SessionCheck',
    'function' => 'checkExpiry',
    'filename' => 'SessionCheck.php',
    'filepath' => 'hooks'
);
