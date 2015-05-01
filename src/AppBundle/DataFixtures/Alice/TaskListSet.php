<?php

use h4cc\AliceFixturesBundle\Fixtures\FixtureSet;

$set = new FixtureSet(array(
    'locale' => 'es_ES',
    'do_drop' => true,
    'do_persist' => true,
));

$set->addFile(__DIR__.'/users.yml', 'yaml');
$set->addFile(__DIR__.'/company.yml', 'yaml');
$set->addFile(__DIR__.'/trademark.yml', 'yaml');
$set->addFile(__DIR__.'/tableLogisticVariables.yml', 'yaml');
$set->addFile(__DIR__.'/barcode.yml', 'yaml');
$set->addFile(__DIR__.'/product.yml', 'yaml');

return $set;
