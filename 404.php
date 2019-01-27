<?php

require_once __DIR__ . '/functions.php';

$page_error_404 = render_template('errors/404', []);

print $page_error_404;

