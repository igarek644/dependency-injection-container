<?php

include "Container.php";
include "TestClass.php";

$container = Container::getInstance();

$container->bind('GetTestObject', 'TestClass');

$object = $container->getObject('GetTestObject');

$object->testFunc();

$object2 = $container->getObject('GetTestObject');
$object2->testFunc();