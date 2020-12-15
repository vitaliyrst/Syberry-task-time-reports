<?php

namespace App\Classes;

class Report
{
    public static function getOutput()
    {
        $days = require __DIR__ . '/../days.php';
        $data = new Data();
        $report = [];
        $dayCount = count($days);
        for ($i = 0; $i < $dayCount; $i++) {
            $dataForOneDay = $data->getDataFromTimeReportsWithEmployees($days[$i]);
            foreach ($dataForOneDay as $bestEmployee) {
                $format = "%10s (%-5s),";
                $report[$i] .= sprintf($format, $bestEmployee['name'], $bestEmployee['hours']);
            }
            $format = "\n| %-10s | %-50s |";
            echo substr_replace(sprintf($format, $days[$i], $report[$i]), ' ', -3, 1);
        }
    }
}
