<?php
/**
 * This file contains validation for dating website.
 *
 * validate.php
 * Date: 1/31/18
 * @author Jen Shin <jshin@mail.greenriver.edu>
 * @copyright 2018
 */

/**
 * Checks user input of outdoor interests against valid choices.
 * @param $outdoorInterests array of user choices
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
 * @param $indoorInterests array of user choices
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
 * @param $phone int, inputted phone number
 * @return bool true if all numbers and 10 digits.
 */

function validPhone($phone)
{
    $strippedNumber = str_replace("-", "", $phone);
    $numberLen = strlen($strippedNumber);
    return is_numeric($numberLen) && $numberLen == 10;
}

/**
 * Checks if string is all alphabetical and not empty.
 * @param $name string input
 * @return bool true if string is all letters.
 */

function validString($string)
{
    str_replace(array(" ","-"), "", $string);
    return ctype_alpha($string);
}

/**
 * Checks if age is all numbers, over 18 (not inclusive).
 * @param $age int, user input for age.
 * @return bool true if all numbers, over 18 (not inclusive).
 */

function validAge($age)
{
    return is_numeric($age) && $age > 18;
}

/**
 * Success if all data is valid
 * @param $name string input for name
 * @param $age int for age
 * @param $phone int input for phone
 * @param $indoorInterests array input for indoor interests
 * @param $outdoorInterests array input for outdoor interests
 * @param $gender string input for gender
 * @return $errors sets $errors to empty if conditions true
 */

/*function validatePersonalInfo($name, $age, $phone, $gender)
{
    if (validName($name) && validAge($age) && validPhone($phone) && !empty($gender)) {
        unset($errors);
        $errors = array();
    }
    return $errors;
}

function validateInterests($indoorInterests, $outdoorInterests)
{
    if (validOutdoor($outdoorInterests)&& validIndoor($indoorInterests)) {
        unset($errors);
        $errors = array();
    }
    return $errors;
}*/


$success = sizeof($errors) == 0;