<?php

use Aham\EzForm\Templates\Template;

require "vendor/autoload.php";

$template = new Template();



var_dump( $template );

echo "<pre>";
print_r( $template );
echo "</pre>";


echo $template->getTemplates();