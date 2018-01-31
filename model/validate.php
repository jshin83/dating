<?php
/**
 * Created by PhpStorm.
 * User: Jen Shin
 * Date: 1/31/18
 * Time: 12:35 AM
 * Copyright 2018
 */


/**
 * Checks user input of outdoor interests against valid choices.
 * @param $outdoorInterests user inputted array
 * @return bool true if in array of valid outdoor interests array
 */
function validOutdoor($outdoorInterests)
{
    global $f3;
    foreach ($outdoorInterests as $value) {
        if(!in_array($value, $f3->get('outdoor'))) {
            return false;
        }
    }
    return true;
}

/**
 * Checks user input of indoor interests against valid choices.
 * @param $indoorInterests user inputted array
 * @return bool true if in array of valid indoor interests array
 */
function validIndoor($indoorInterests)
{
    global $f3;
    foreach ($indoorInterests as $value) {
        if(!in_array($value, $f3->get('indoor'))) {
            return false;
        }
    }
    return true;
}

/**
 * Strips dashes and checks if there are 10 digits.
 * @param $phone user inputted phone number
 * @return bool true if all numbers and 10 digits.
 */

function validPhone($phone)
{
    $strippedNumber = str_replace("-", "", $phone);
    $numberLen = strlen($strippedNumber);
    return is_numeric($numberLen) && $numberLen == 10;
}

/**
 * Checks if name is all alphabetical and not empty.
 * @param $name user input for name
 * @return bool true if name is all letters.
 */

function validName($name)
{
    return !empty($name) && ctype_alpha($name);
}

/**
 * Checks if age is all numbers, over 18 (not inclusive).
 * @param $age user input for age.
 * @return bool true if all numbers, over 18 (not inclusive).
 */

function validAge($age)
{
    return is_numeric($age) && $age > 18;
}

if(!validPhone($phone))
{
    $errors['phone'] = "Please enter a 10 digit phone number with dashes.";
}

if(!validAge($age))
{
    $errors['age'] = "Please enter a valid age - must be over 18.";
}

if(!validName($name))
{
    $errors['name'] = "Name must be all letters.";
}

$success = sizeof($errors) == 0;