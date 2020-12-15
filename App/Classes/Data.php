<?php

namespace App\Classes;

class Data
{
    public function getDataFromTimeReportsWithEmployees($day)
    {
        $db = new Db();
        $sql = "SELECT e.name, ROUND(AVG(hours), 2) AS hours
                FROM time_reports AS t
                JOIN employees e on t.employee_id = e.id
                WHERE TRIM(to_char(t.date::date, 'Day')) = :day
                GROUP BY e.name
                ORDER BY hours DESC LIMIT 3";
        $sth = $db->dbh->prepare($sql);
        $sth->bindParam(':day', $day);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}
