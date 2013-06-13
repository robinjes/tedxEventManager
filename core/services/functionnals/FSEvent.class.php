<?php
/**
 * Description of FSEvent
 *
 * @author Lauric Francelet
 */

require_once(APP_DIR . '/core/model/Event.class.php');
require_once(APP_DIR . '/core/model/Message.class.php');


class FSEvent {
    
    /**
     * Returns a Event with the given No as Id.
     * @param int $no The Id of the Event
     * @return a Message containing an existant Event
     */
    public static function getEvent($no) {
        $event = NULL;
        
        global $crud;
        
        $sql = "SELECT * FROM Event WHERE No = $no";
        $data = $crud->getRow($sql);
        
        if($data){
            $argsEvent = array(
                'no'            => $data['No'],
                'mainTopic'          => $data['MainTopic'],
                'startingDate'     => $data['StartingDate'],
                'endingDate'   => $data['EndingDate'],
                'startingTime'       => $data['StartingTime'],
                'endingTime'          => $data['EndingTime'],
                'description'       => $data['Description'],
                'isArchived'    => $data['IsArchived']
            );
            
            $event = new Event($argsEvent);
            
            $argsMessage = array(
                'messageNumber' => 211,
                'message'       => 'Existant Event',
                'status'        => true,
                'content'       => $event
            );
            $message = new Message($argsMessage);
            return $message;
        } else {
            $argsMessage = array(
                'messageNumber' => 212,
                'message'       => 'Inexistant Event',
                'status'        => false,
                'content'       => NULL
            );
            $message = new Message($argsMessage);
            return $message;
        }
    }
    
    /**
     * Returns all the Events of the database
     * @return A Message containing an array of Events
     */
    public static function getEvents(){
        global $crud;
        
        $sql = "SELECT * FROM Event";
        $data = $crud->getRows($sql);
        
        if ($data){
            $events = array();

            foreach($data as $row){
                $argsEvent = array(
                    'no'            => $row['No'],
                    'mainTopic'          => $row['MainTopic'],
                    'startingDate'     => $row['StartingDate'],
                    'endingDate'   => $row['EndingDate'],
                    'startingTime'       => $row['StartingTime'],
                    'endingTime'          => $row['EndingTime'],
                    'description'       => $row['Description'],
                    'isArchived'    => $row['IsArchived']
                );
            
                $events[] = new Event($argsEvent);
            } //foreach

            $argsMessage = array(
                'messageNumber' => 103,
                'message'       => 'All Events selected',
                'status'        => true,
                'content'       => $events
            );
            $message = new Message($argsMessage);

            return $message;
        } else {
            $argsMessage = array(
                'messageNumber' => 104,
                'message'       => 'Error while SELECT * FROM event',
                'status'        => false,
                'content'       => NULL
            );
            $message = new Message($argsMessage);

            return $message;
        }
    }
    
    /**
     * Add a new Event in Database
     * @param $args Parameters of a Event
     * @return a Message containing the new Event
     */
    public static function addEvent($args){
        global $crud;
        
        $sql = "INSERT INTO `Event` (`Firstname`, `DateOfBirth`, `Address`, `City`, `Country`, `PhoneNumber`, `Email`, `Description`) VALUES ('".$args['name']."', '".$args['firstname']."', '".$args['dateOfBirth']."', '".$args['address']."', '".$args['city']."', '".$args['country']."', '".$args['phoneNumber']."', '".$args['email']."', '".$description."')";
        
        var_dump($sql);
        if($crud->exec($sql) == 1){
            
            $sql = "SELECT * FROM Event WHERE Email = '" . $args['email'] . "'";
            $data = $crud->exec($sql);
            
            $argsEvent = array(
                'no'            => $data['No'],
                'name'          => $data['Name'],
                'firstname'     => $data['Firstname'],
                'dateOfBirth'   => $data['DateOfBirth'],
                'address'       => $data['Address'],
                'city'          => $data['City'],
                'country'       => $data['Country'],
                'phoneNumber'   => $data['PhoneNumber'],
                'email'         => $data['Email'],
                'description'   => $data['Description'],
                'isArchived'    => $data['IsArchived']
            );
            
            $event = new Event($argsEvent);
            
            $argsMessage = array(
                'messageNumber' => 105,
                'message'       => 'New Event added !',
                'status'        => true,
                'content'       => $event
            );
            $message = new Message($argsMessage);
            return $message;
        } else {
            $argsMessage = array(
                'messageNumber' => 106,
                'message'       => 'Error while inserting new Event',
                'status'        => false,
                'content'       => NULL
            );
            $message = new Message($argsMessage);

            return $message;
        }
        
    }
    
}

?>

