<?php
/**
 * Display Widget area
 *
 * @package UnBreak
 * @subpackage UnBreak
 * @since 1.0.0
 * @author EF5 Team
 *
*/
$sidebar  = unbreak_get_sidebar(false);
dynamic_sidebar($sidebar);
