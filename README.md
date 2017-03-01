# Quick Table Object

#### Epicodus PHP Week 4 Independent Study, 2/29/2017

#### By Benjamin T. Seaver

## Description

The purpose of this project is to enable faster development of applications by reducing the time necessary to create objects that do typical operations with SQL tables.

The typical operations include private properties mirroring the fields in a table, getters, setters, constructor, save, update, find, delete, getAll, deleteAll.



## Setup/Installation Requirements
* See https://secure.php.net/ for details on installing _PHP_.  Note: PHP is typically already installed on Mac.
* See https://getcomposer.org/ for details on installing _composer_.
* See https://mamp.info/ for details on installing _MAMP_.
* Use MAMP `http://localhost:8888/phpmyadmin/` to import databases and data from SQL files.
* Use same MAMP website to copy to_do database to `to_do_test` database (if you would like to try PHPUnit tests).
* Start SQL at command prompt if desired with > `/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot`
* Clone project
* From project root, run > `composer install --prefer-source --no-interaction`
* To run PHPUnit tests from root > `vendor/bin/phpunit tests`
* From web folder in project, Start PHP > `php -S localhost:8000`
* In web browser open `localhost:8000`

## Known Bugs
* No known bugs

## Support and contact details
* No support

## Technologies Used
* PHP
* MAMP
* mySQL
* Composer
* PHPUnit
* Git

## Copyright (c)
* 2017 Benjamin T. Seaver

## License
* MIT

## Implementation Plan

* Create a class that enables the above operations, but by specifying the table fields by name.
* Enable extending the class so that getters, setters and constructor may be coded similarly as before with hard coded method names and parameters.

* End specifications
