<?php
/**
 * This class represents a Premium Member
 * that extends from Member.
 * Premium Members get to choose interests.
 * User: kyongah
 * Date: 2/13/18
 * Time: 7:08 PM
 * premium_member.php
 * @author Jen Shin <jshin13@mail.greenriver.edu>
 * @copyright 2018
 */

class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;
    private $_allInterests;

    /**
     * PremiumMember constructor, extends from Member.
     * @param $fname string
     * @param $lname string
     * @param $age int
     * @param $gender string
     * @param $phone string
     */

    function __construct($fname, $lname, $age, $gender, $phone)
    {
        parent::__construct($fname, $lname, $age, $gender, $phone);

        $this->_inDoorInterests="";
        $this->_outDoorInterests="";
        parent::setPremium(1);
    }


    /**
     * Getter for first name.
     * @return string first name
     */

    function getFname()
    {
        return $this->fname;
    }

    /**
     * Sets first name
     * @param $fname string
     */

    function setFname($fname)
    {
        $this->fname = $fname;
    }

    /**
     * Gets last name.
     * @return string last name
     */

    function getLname()
    {
        return $this->lname;
    }

    /**
     * Sets last name.
     * @param $lname string
     */

    function setLname($lname)
    {
        $this->lname = $lname;
    }

    /**
     * Gets age.
     * @return int age
     */

    function getAge()
    {
        return $this->age;
    }

    /**
     * Sets age.
     * @param $age int
     */

    function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * Gets gender.
     * @return string gender
     */

    function getGender()
    {
        return $this->gender;
    }

    /**
     * Sets gender.
     * @param $gender string
     */

    function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Gets phone number.
     * @return string phone number
     */

    function getPhone()
    {
        return $this->phone;
    }

    /**
     * Sets phone number.
     * @param $phone string
     */

    function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Gets email.
     * @return string email
     */

    function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets email.
     * @param $email string
     */

    function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Gets state.
     * @return string state
     */

    function getState()
    {
        return $this->state;
    }

    /**
     * Sets state.
     * @param $state string
     */

    function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Gets seeking gender.
     * @return string gender member seeks
     */

    function getSeeking()
    {
        return $this->seeking;
    }

    /**
     * Sets seeking.
     * @param $seeking string
     */

    function setSeeking($seeking)
    {
        $this->seeking = $seeking;
    }

    /**
     * Gets bio.
     * @return string
     */

    function getBio()
    {
        return $this->bio;
    }

    /**
     * Sets bio.
     * @param $bio string
     */

    function setBio($bio)
    {
        $this->bio = $bio;
    }

    /**
     * Gets string array of indoor interests.
     * @return string array
     */

    function getIndoor()
    {
        return $this->_inDoorInterests;
    }

    /**
     * Sets string array of indoor interests.
     * @param $indoorInterests string array of indoor interests.
     */

    function setIndoor($indoorInterests)
    {
        $this->_inDoorInterests = $indoorInterests;
    }

    /**
     * Gets string array of outdoor interests.
     * @return string array
     */

    function getOutdoor()
    {
        return $this->_outDoorInterests;
    }

    /**
     * Sets string array of outdoor interests.
     * @param $outdoorInterests string array of outdoor interests.
     */

    function setOutdoor($outdoorInterests)
    {
        $this->_outDoorInterests = $outdoorInterests;
    }

    function setPremium($int)
    {
        $this->premium = $int;
    }

    /**
     * Returns premium status.
     * @return int 1 for premium, 0 for member
     */
    function getPremium()
    {
        return 1;
    }

    /**
     * Sets image.
     */
    function setImage()
    {
        $this->image = null;
    }

    /**
     * Returns image.
     * @return null
     */
    function getImage()
    {
        return $this->image;
    }

    /**
     * Checks if age is all numbers, over 18 (inclusive).
     * @param $age int, user input for age.
     * @return bool true if all numbers, over 18 (inclusive).
     */

    function validAge($age)
    {
        return is_numeric($age) && $age >= 18;
    }

    /**
     * Validates an email.
     * @param $email string
     * @return false|int false if it does not match the pattern
     */

    function validEmail($email)
    {
        $regex = '/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/';
        return preg_match($regex, $email);
    }

    /**
     * Pass in two string arrays to create string of combined interests
     * separated by commas.
     * @param $indoor string array of indoor interests
     * @param $outdoor string array of outdoor interests
     * @return string all interests separated by comma
     */

    function combineInterests($indoor, $outdoor)
    {
        $allInterests = $indoor[0];
        for($i =1; $i< sizeof($indoor) - 1; $i++ ) {
            $allInterests .= ", ".$indoor[$i];
        }
        foreach ($outdoor as $interests) {
            $allInterests .= ", ".$interests;
        }
        return $allInterests;
    }

    /**
     * Sets allInterests string.
     * @param $indoor string array
     * @param $outdoor string array
     */
    function setCombinedInterests($indoor, $outdoor)
    {
        $this->_allInterests = $this->combineInterests($indoor, $outdoor);
    }

    /**
     * Gets a string of all interests, separated by commas.
     * @return string
     */
    function getCombinedInterests()
    {
        return $this->_allInterests;
    }

}