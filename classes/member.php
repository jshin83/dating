<?php
/**
 * This class represents a Member.
 * Date: 2/13/18
 * Time: 7:04 PM
 * member.php
 * @author Jen Shin <jshin13@mail.greenriver.edu>
 * @copyright 2018
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

    /**
     * Member constructor.
     * @param $fname string
     * @param $lname string
     * @param $age int
     * @param $gender string
     * @param $phone string
     */
    function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->age = $age;
        $this->gender = $gender;
        $this->phone = $phone;
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
}