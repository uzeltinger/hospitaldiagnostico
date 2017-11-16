<?php

require_once 'lib/inhouse3/api.php';

function get_inhouse_api() {
    $api = new INhouse3API(430, 'ff76cj');
    return $api;
}

