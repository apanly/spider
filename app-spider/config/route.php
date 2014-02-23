<?php
$config['regex_function']='ereg';
$config['regex_label']='@';
$config['404'] = 'Error_HTTP404';
$config['mappings']['Resource_CompressedResources'] = array (
    '^/res/[^\/]+/(b|s)/(.*)\.(css|js)$',
    '^/res/(b|s)/(.*)\.(css|js)$'
);
$config['mappings']['Home_Default'] = array(
    '^/$'
);






