# JustBench

Modern and minimalistic PHP benchmark library built with
PHP 7.

## Installation

```bash
$ composer require malios/just-bench --dev

```
## Basic usage

```php
<?php

$benchmark = new JustBench\Benchmark();
$benchmark->start();

//your code here

$benchmark->stop();

$benchmark->getElapsedTime();
```
