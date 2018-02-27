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
    protected $premium;
    protected $image;

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
        $this->premium = 0;
        $this->image = null;
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
     * Sets first name.
     * First letter capitalized, the rest is lowercase
     * @param $fname string
     */

    function setFname($fname)
    {
        $this->fname = ucwords(strtolower($fname));
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
     * First letter capitalized, the rest is lowercase.
     * Allows hyphen or space between two strings.
     * Default is empty string (table does not accept null).
     * @param $lname string
     */
    function setLname($lname)
    {
        $lname = ucwords(strtolower($lname));
        $regex = '/^[A-Za-z]+((\s)?((\' | \- )?([A - Za - z]) +))*$/';
        if(preg_match($regex, $lname)) {
            $this->lname = $lname;
        } else {
            $this->lname = "";
        }
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
     * If age is not a number and less than 18, default age is set to null.
     * @param $age int user input for age
     */

    function setAge($age)
    {
        if (is_numeric($age) && $age >= 18) {
            $this->age = $age;
        } else {
            $this->age = null;
        }
    }

    function validAge($age)
    {
        return ;
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
     * Checks if phone number is 10 digits and numeric.
     * If not, set to default.
     * @param $phone string
     */
    function setPhone($phone)
    {
        if (validPhone($phone)) {
            $this->phone = $phone;
        } else {
            $this->phone = "123-456-7890";

        }
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
     * If email is not valid, sets to null.
     * @param $email string
     */

    function setEmail($email)
    {
        $regex = '/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/';
        if (preg_match($regex, $email)) {
            $this->email = $email;
        } else {
            $this->email = null;
        }
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
     * Set premium.
     * @param $int int, 1 if premium, 0 if member
     */

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
        return $this->premium;
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
}