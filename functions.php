<?php

function get_lifetime()
{
    $current_time = strtotime(date('H:i:s'));
    $midnight_time = strtotime('tomorrow');
    $seconds_to_midnight = $midnight_time - $current_time;

    $hours = floor($seconds_to_midnight / 3600);
    $minutes = floor(($seconds_to_midnight % 3600) / 60);

    return $hours . ':' . $minutes;
}

function render_template(string $path, array $data)
{
    if (isset($path)) {
        extract($data);
        ob_start();
        require __DIR__ . '/templates/' . $path . '.php';
        $html = ob_get_clean();
        return $html;
    } else {
        return '';
    }
}

function format_price($price)
{
    $format_price = ceil($price);

    if ($format_price < 1000) {
        return $format_price . ' &#x20BD;';
    } else {
        $format_price = number_format($format_price, 0, ',',  ' ');
        return $format_price . ' &#x20BD;';
    }
}