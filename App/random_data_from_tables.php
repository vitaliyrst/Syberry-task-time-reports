<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Classes\Db;

/*create table if not exists public.employees
(
    id serial not null
		constraint employees_pk
			primary key,
	name varchar(50) not null
);

alter table public.employees owner to postgres;

create table if not exists public.time_reports
(
    id serial not null
		constraint time_reports_pk
			primary key,
	employee_id integer not null
		constraint time_reports_employees_id_fk
			references public.employees
				on delete cascade,
	hours numeric(2,1),
	date text
);

alter table public.time_reports owner to postgres;

create unique index if not exists time_reports_id_uindex
	on public.time_reports (id);*/


/**
 * Добавляет рандомные данные для таблицы employees
 */
function getDataFromEmployees()
{
    $names = ['Jack', 'Anna', 'Emmet', 'Jim', 'Kelly', 'Tom', 'Alex'];
    $db = new Db();
    $sql = 'INSERT INTO employees (name) VALUES (:name)';
    $sth = $db->dbh->prepare($sql);
    for ($i = 0; $i < count($names); $i++) {
        $name = $names[$i];

        $sth->bindParam(':name', $name);

        $sth->execute();
    }
}

/**
 * Добавляет рандомные данные для таблицы time_reports
 */
function getDataFromTimeReports()
{
    $db = new Db();
    $sql = 'INSERT INTO time_reports (employee_id, hours, date)
    VALUES (:employee_id, :hours, :date)';
    $sth = $db->dbh->prepare($sql);

    for ($i = 1; $i <= 30; $i++) {
        for ($j = 1; $j <= 7; $j++) {
            $employee_id = $j;
            $hours = floatval(rand(3, 8) . '.' . rand(0, 10));
            $dateStart = new DateTime();
            $dateStart->setISODate($dateStart->format('Y'), $dateStart->format('W'), $i - 1);
            $date = $dateStart->format('m.d.Y');
            $sth->bindParam(':employee_id', $employee_id);
            $sth->bindParam(':hours', $hours);
            $sth->bindParam(':date', $date);
            $sth->execute();
        }
    }
}

function run() {
    getDataFromEmployees();
    getDataFromTimeReports();
}