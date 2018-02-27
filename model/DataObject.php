<?php
/**
 * Date: 2/22/18
 * Time: 7:07 PM
 * DataObject.class.php
 *
 * @author Jen Shin <jshin13@mail.greenriver.edu>
 * @copyright 2018
 *
 * This class creates a database connection.
 *
 * CREATE TABLE Members (
member_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
fname VARCHAR(30) NOT NULL,
lname VARCHAR(30) NOT NULL,
age TINYINT DEFAULT 0,
gender ENUM( 'f', 'm' ) NOT NULL,
phone VARCHAR(13) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE,
state CHAR(2) NOT NULL,
seeking ENUM( 'f', 'm' ) NOT NULL,
bio TEXT NOT NULL DEFAULT "",
premium TINYINT(1) NOT NULL DEFAULT 0,
image VARCHAR(50) DEFAULT NULL,
interests VARCHAR(130) DEFAULT NULL,
PRIMARY KEY (member_id)
);
 */


/**
 * Class DataObject
 * creates connection to database.
 */
class DataObject {
    private $_conn;
    /*
    protected $data = array();

    public function __construct( $data ) {
        foreach ( $data as $key => $value ) {
            if ( array_key_exists( $key, $this-> data ) ) $this-> data[$key] =
                $value;
        }
    }
    public function getValue( $field ) {
        if ( array_key_exists( $field, $this-> data ) ) {
            return $this-> data[$field];
        } else {
            die( 'Field not found' );
        }
    }
    public function getValueEncoded( $field ) {
        return htmlspecialchars( $this-> getValue( $field ) );
    }*/

    /**
     * Connects to a database.
     * @return PDO database connection
     */
    function __construct() {
        require_once ('/home/jshingre/config.php');

        try {
            $this->_conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $this->_conn->setAttribute( PDO::ATTR_PERSISTENT, true );
            $this->_conn-> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            //echo "connected!";
            } catch ( PDOException $e ) {
                        die( 'Connection failed: ' . $e-> getMessage() );
            }
    }

    /**
     * Adds member information to database.
     */
     function addToDatabase($member)
     {
        $interests = "";
        if(is_a($member, "PremiumMember" )) {
            $interests = $member->getCombinedInterests();
        }

         //define the query
         $sql = "INSERT INTO Members(fname, lname, age, gender, phone, email, state, seeking, bio, premium, image, interests) 
             VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image, :interests)";

         //prepare statement
         $statement = $this->_conn->prepare($sql);

         //bind the paramenters

         $statement->bindParam(':fname', $member->getFname(), PDO::PARAM_STR);
         $statement->bindParam(':lname', $member->getLname(), PDO::PARAM_STR);
         $statement->bindParam(':age', $member->getAge(), PDO::PARAM_INT);
         $statement->bindParam(':gender', $member->getGender(), PDO::PARAM_STR);
         $statement->bindParam(':phone', $member->getPhone(), PDO::PARAM_STR);
         $statement->bindParam(':email', $member->getEmail(), PDO::PARAM_STR);
         $statement->bindParam(':state', $member->getState(), PDO::PARAM_STR);
         $statement->bindParam(':seeking', $member->getSeeking(), PDO::PARAM_STR);
         $statement->bindParam(':bio', $member->getBio(), PDO::PARAM_STR);
         $statement->bindParam(':premium', $member->getPremium(), PDO::PARAM_INT);
         $statement->bindParam(':image', $member->getImage(), PDO::PARAM_STR);
         $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

         //execute
         $statement->execute();
     }

     /**
      * Display information for one member.
      * @param $id int member id
      */

    function displaySingle($id)
    {

        $select = "SELECT * FROM Members WHERE member_id=:id";
        $statement = $this->_conn->prepare($select);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $row = $statement->fetch();

        if(empty($row)) {
            echo "ID not found.";
        } else {

            $out = 'ID : '.$id.' - ';
            $out .= "Name: ".$row['fname']." ".$row['lname']." - ";
            $out .= "Gender: ".strtoupper($row['gender'])." - ";
            $out .= "Age: ".$row['age']." - ";
            $out .= "Seeking: ".strtoupper($row['seeking'])." - ";
            $out .= "Age: ".$row['age']." - ";
            $out .= "State: ".$row['state'];
            if($row['premium'] == 1) {
                $out .= " - Interests: ".$row['interests']."";
            }

            return $out;

        }
    }

    function displayAll()
    {
        //define query
        $sql="SELECT member_id, fname, lname, age, phone, email, state, gender, seeking, premium, interests FROM Members";
        $statement = $this->_conn->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }


    /**
     * Disconnects from database.
     * @param $conn database connection
     */
    protected function disconnect( $conn ) {
        $conn = "";
    }

}
