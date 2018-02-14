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

    function __construct($fname, $lname, $age, $gender, $phone)
    {
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }

    function getFname()
    {
        return $this->fname;
    }

    function setFname($fname)
    {
        $this->fname = $fname;
    }

    function getLname()
    {
        return $this->lname;
    }

    function setLname($lname)
    {
        $this->lname = $lname;
    }

    function getAge()
    {
        return $this->age;
    }

    function setAge($age)
    {
        $this->age = $age;
    }

    function getGender()
    {
        return $this->gender;
    }

    function setGender($gender)
    {
        $this->gender = $gender;
    }

    function getPhone()
    {
        return $this->phone;
    }

    function setPhone($phone)
    {
        $this->phone = $phone;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function getState()
    {
        return $this->state;
    }

    function setState($state)
    {
        $this->state = $state;
    }

    function getSeeking()
    {
        return $this->seeking;
    }

    function setSeeking($seeking)
    {
        $this->seeking = $seeking;
    }

    function getBio()
    {
        return $this->bio;
    }

    function setBio($bio)
    {
        $this->bio = $bio;
    }

    function getIndoor()
    {
        return $this->_inDoorInterests;
    }

    function setIndoor($indoorInterests)
    {
        $this->_inDoorInterests = $indoorInterests;
    }

    function getOutdoor()
    {
        return $this->_outDoorInterests;
    }

    function setOutdoor($outdoorInterests)
    {
        $this->_outDoorInterests = $outdoorInterests;
    }
}