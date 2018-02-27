<?php
/**
 * This class represents a Member.
 * Date: 2/13/18
 * Time: 7:04 PM
 * member.php
 * @author Jen Shin <jshin13@mail.greenriver.edu>
 * @copyright 2018
 */

require_once '/home/jshingre/public_html/328/dating/model/DataObject.class.php';

class Member extends DataObject
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

    /*protected $data = array (
        'fname' => "",
        'lname' => "",
        'age' => "",
        'gender' => "",
        'phone' => "",
        'email' => "",
        'state' => "",
        'seeking' => "",
        'bio' => ""

    );*/

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

    function addToDatabase()
    {
        $conn = parent::connect();

        /*fname VARCHAR(30) NOT NULL,
lname VARCHAR(30) NOT NULL,
age TINYINT DEFAULT NULL,
gender ENUM( 'f', 'm' ) NOT NULL,
phone VARCHAR(13) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE,
state CHAR(2) NOT NULL,
seeking ENUM( 'f', 'm' ) NOT NULL,
bio TEXT NOT NULL DEFAULT "",
premium TINYINT(1) NOT NULL DEFAULT 0,
image VARCHAR(50) DEFAULT NULL,
interests VARCHAR(130) NOT NULL,*/

        //define the query
        $sql="INSERT INTO Members(fname, lname, age, gender, phone, email, state, seeking, bio, premium, image, interests) 
            VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image, :interests)";

        //prepare statement
        $statement = $conn->prepare($sql);

        //bind the paramenters

        $statement->bindParam(':fname', $this->fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $this->lname, PDO::PARAM_STR);
        $statement->bindParam(':age', $this->age, PDO::PARAM_INT);
        $statement->bindParam(':gender', $this->gender, PDO::PARAM_STR);
        $statement->bindParam(':phone', $this->phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $this->email, PDO::PARAM_STR);
        $statement->bindParam(':state', $this->state, PDO::PARAM_STR);
        $statement->bindParam(':seeking', $this->seeking, PDO::PARAM_STR);
        $statement->bindParam(':bio', $this->bio, PDO::PARAM_STR);
        $statement->bindParam(':premium', $this->premium, PDO::PARAM_INT);
        $statement->bindParam(':image', $this->image, PDO::PARAM_STR);
        $statement->bindParam(':interests', $this->interests, PDO::PARAM_STR);

        //execute
        $statement->execute();
    }
}