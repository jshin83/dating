<?php
/**
 * Created by PhpStorm.
 * User: kyongah
 * Date: 2/22/18
 * Time: 7:07 PM
 * CREATE TABLE Members (
member_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
fname VARCHAR(30) NOT NULL,
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
interests VARCHAR(130) NOT NULL,
PRIMARY KEY (member_id)
);
 */

require_once ('/home/jshingre/config.php');

abstract class DataObject {
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
    }
    protected function connect() {
        try {
            $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $conn-> setAttribute( PDO::ATTR_PERSISTENT, true );
            $conn-> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            } catch ( PDOException $e ) {
                        die( 'Connection failed: ' . $e-> getMessage() );
            }
        return $conn;
    }
    protected function disconnect( $conn ) {
        $conn = "";
    }

}
