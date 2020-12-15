<?php

use App\Classes\Report;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/App/random_data_from_tables.php';

Report::getOutput();
