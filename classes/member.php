<?php
/**
 * Created by PhpStorm.
 * User: kyongah
 * Date: 2/13/18
 * Time: 7:04 PM
 */

class Member
{
    protected $fname;
    protected $lname;
    protected $age;
    protected $gender;
    protected $phone;
    protected $email;
    protected $state;
    protected $seeking;
    protected $bio;

    function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->age = $age;
        $this->gender = $gender;
        $this->phone = $phone;
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
}