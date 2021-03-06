<html>
<head>
<meta charset="UTF-8">
</head>
    <body>
<?php
require_once('../tedx-config.php');
require_once(APP_DIR.'/core/controller/Tedx_manager.class.php');
require_once(APP_DIR.'/core/services/applicatives/ASFree.class.php');
require_once(APP_DIR .'/core/services/functionnals/FSEvent.class.php');
require_once(APP_DIR .'/core/services/functionnals/FSTeamRole.class.php');
require_once(APP_DIR .'/core/services/functionnals/FSOrganizer.class.php');
require_once(APP_DIR .'/core/services/functionnals/FSPlace.class.php');
require_once(APP_DIR .'/core/services/functionnals/FSSlot.class.php');
//require_once(APP_DIR .'/core/services/functionnals/FSMotivation.class.php');

   $tedx_manager->login("admin", "admin");
 
   
  echo '<h1> Get Slot </h1>';

  // Object Event
    $anEvent = FSEvent::getEvent(1)->getContent();;

    $args = array(
        'no'            =>  2,
        'event'       =>  $anEvent
    );
    $messageGetSlot = $tedx_manager->getSlot($args);
    // Message
    if( $messageGetSlot->getStatus())
        echo 'Congrats! ' . $messageGetSlot->getMessage();
    else
    echo 'Error! ' . $messageGetSlot->getMessage();
  
/*$motivationText = 'An awesome motivation for an awesome participant. Oh yeah!!';
// object Event
$anEvent = FSEvent::getEvent(41)->getContent();
// object Participant
$aParticipant = FSParticipant::getParticipant(42)->getContent();
 
$aMotivationToArchive = array(
    'text'         => $motivationText, // An Motivation text string
    'event'        => $anEvent,
    'participant'  => $aParticipant
);
// archive Motivation
$motivationArchiveMotivationToAnEvent = $tedx_manager->archiveMotivationToAnEvent($aMotivationToArchive);
// if the Motivation is archived successfully
if( $motivationArchiveMotivationToAnEvent->getStatus())
    echo 'Congrats! ' . $motivationArchiveMotivationToAnEvent->getMessage();
else
    echo 'Error! ' . $motivationArchiveMotivationToAnEvent->getMessage();
   
   
  /* $text = 'TEST5';
// object Event
$anEvent = FSEvent::getEvent(100)->getContent();
// object Participant
$aParticipant = FSParticipant::getParticipant(1)->getContent();
 
// args add Motivation to an Event
$args= array(
        'text'        => $text,
        'event'       => $anEvent,
        'participant' => $aParticipant
);
// adding Motivation to an Event
$messageAddMotivationToAnEvent = $tedx_manager->addMotivationToAnEvent($args);
 
// if the Motivation is added successfully
if( $messageAddMotivationToAnEvent->getStatus())
    echo 'Congrats! ' . $messageAddMotivationToAnEvent->getMessage();
else
    echo 'Error! ' . $messageAddMotivationToAnEvent->getMessage();
   
   
   
   
   
   
   
   
   
    /*echo '<h1>Set Place</h1>';
    $args =     array(
            'no'         => 1,
            'slotNo'   => 1,
            'slotEventNo'   => 1,
            'speakerPersonNo'   => 1,
            'isArchived'   => 0,
    );
    $newPlace = new Place($args);
    var_dump(FSPlace::setPlace($newPlace));*/
    
    
    
    
    /*echo '<h1>Change Place Of Speaker To an Event</h1>';
    
    $anOldPlaceNo = 4;
    $aNewPlaceNo = 3;
    $aSlotNo = 1;
    $aSpeaker = $tedx_manager->getSpeaker(1)->getContent();
    $anEvent = FSEvent::getEvent(1)->getContent();
    $argsSlot = array(
        'no'    => $aSlotNo,
        'event' => $anEvent
    );
    $aSlot= $tedx_manager->getSlot($argsSlot)->getContent();
    
    $args = array (
        'newNo'     => $aNewPlaceNo,
        'slot'  => $aSlot,
        'event'  => $anEvent,
        'speaker'    => $aSpeaker,
        'oldNo'   => $anOldPlaceNo
    );
    
    $aChangedPlaceOfASpeakerToAnEvent = $tedx_manager->changePositionOfSpeakerToEvent( $args );
    
    // Message
    if( $aChangedPlaceOfASpeakerToAnEvent->getStatus())
        echo 'Congrats! ' . $aChangedPlaceOfASpeakerToAnEvent->getMessage();
    else
        echo 'Error! ' . $aChangedPlaceOfASpeakerToAnEvent->getMessage();
    
    //var_dump($aChangedPlaceOfASpeakerToAnEvent->getContent());
    
   /*echo '<h1>Speakers</h1>';
   
   $someSpeakers = $tedx_manager->getSpeakers();
    // Message
    if( $someSpeakers->getStatus())
        echo 'Congrats! ' . $someSpeakers->getMessage();
    else
        echo 'Error! ' . $someSpeakers->getMessage();
   
   echo '<h1>Talks</h1>';
   
   $someTalks = $tedx_manager->getTalks();
    // Message
    if( $someTalks->getStatus())
        echo 'Congrats! ' . $someTalks->getMessage();
    else
        echo 'Error! ' . $someTalks->getMessage();
    
    echo '<h1>A Talk</h1>';
    
    $anEvent = $tedx_manager->getEvent(2)->getContent();
    $aSpeaker = $tedx_manager->getSpeaker(1)->getContent();
    
    $args = array (
        'event'     =>  $anEvent,
        'speaker'    => $aSpeaker
    );
    
    $aTalk = $tedx_manager->getTalk( $args );
    
    // Message
    if( $aTalk->getStatus())
        echo 'Congrats! ' . $aTalk->getMessage();
    else
        echo 'Error! ' . $aTalk->getMessage();
    
    
    
   // Args RegisterVisitor
/*$args = array(
    'name'        => 'kjhzfhgc', // String
    'firstname'   => 'kjzfc',   // String
    'dateOfBirth' => '1988-12-12', // Date
    'address'     => '487 rue de la djh', // String
    'city'        => 'Springfield', // String
    'country'     => 'Banff', // String
    'phoneNumber' => '+33627846354', // String
    'email'       => 'hs@sjdk.com', // String
    'description' => '', // String
    'idmember'    => 'f', // String
    'password'    => '' // String encrypt to MD5
);
// Register the Visitor
$aRegisteredVisitor = $tedx_manager->registerVisitor( $args );
 
// Message
if( $aRegisteredVisitor->getStatus())
    echo 'Congrats! ' . $aRegisteredVisitor->getMessage();
else
    echo 'Error! ' . $aRegisteredVisitor->getMessage();
/* $aParticipant = $tedx_manager->getParticipant(42)->getContent();
$anEvent = $tedx_manager->getEvent(41)->getContent();

$args = array(
        'participant' => $aParticipant,
        'event'  => $anEvent
        );
$listOfMotivations= $tedx_manager->getMotivationsByParticipantForEvent($args);
// Message
if( $listOfMotivations->getStatus())
    echo 'Congrats! ' . $listOfMotivations->getMessage();
else
    echo 'Error! ' . $listOfMotivations->getMessage();



echo '</br>';*/
// Object Event
/*$anEvent = FSEvent::getEvent(41)->getContent();
 
//get Registration from the Event
$messageGetRegistrationsByEvent = $tedx_manager->getRegistrationsByEvent($anEvent);
if($messageGetRegistrationsByEvent->getStatus()){
    echo 'registrations Founds';
}else{
    echo 'no registrations founds';
};*/
//$aTeamRoleToGetLink = FSTeamRole::getTeamRole('Accueil');
//$aTeamRoleToLinkIsMemberOf = FSTeamRole::getTeamRole('Superman');

/*$aTeamRole = $tedx_manager->getTeamRole('Accueil')->getContent();
$aTeamRoleIsMemberOf = $tedx_manager->getTeamRole('Superman')->getContent();

$aTeamRoleToGetLink = array(
    'teamRole'  =>  $aTeamRole,
    'teamRoleIsMemberOf'    =>  $aTeamRoleIsMemberOf
);

$aLinkedTeamRole = $tedx_manager->linkTeamRole($aTeamRoleToGetLink);

// Message
if( $aLinkedTeamRole->getStatus())
    echo 'Congrats! ' . $aLinkedTeamRole->getMessage();
else
    echo 'Error! ' . $aLinkedTeamRole->getMessage();

/*$anEventToChange = $tedx_manager->getEvent(28)->getContent();
$aNewLocationName = 'Château -Maire';
$args = array(
        'event' => $anEventToChange,
        'locationName' => $aNewLocationName
);
$aChangedLocationEvent = $tedx_manager->changeEventLocation($args);
// Message
if( $aChangedLocationEvent->getStatus())
    echo 'Congrats! ' . $aChangedLocationEvent->getMessage();
else
    echo 'Error! ' . $aChangedLocationEvent->getMessage();*/


//$crud->exec("UPDATE Event SET MainTopic = 'The future doesn\’t just happen' WHERE No = 1;");


/*echo '<h1>Search Event</h1>';
// Args Event : Search all events between 2014 and 2015
$searchArgs = array(
    'where'       => "StartingDate >= '2014-01-01'",
    'orderByType' => 'LocationName'
);
// Search the events with args
$messageSearchEvents = $tedx_manager->searchEvents($searchArgs);
 
// test answer
if($messageSearchEvents->getStatus()){
    echo 'Some events found !';
    echo '';
    $firstEvent = $messageSearchEvents->getContent();
    echo "First found event's topic : " . ($firstEvent[0]->getMainTopic());
}else{
    echo 'No event matched your criterias';
}

echo '<h1>Get Event</h1>';

    
// Récupère un Event
$id=1;
$anEvent = $tedx_manager->getEvent($id);
// Message
if( $anEvent->getStatus())
    echo 'Congrats! ' . $anEvent->getMessage();
else
    echo 'Error! ' . $anEvent->getMessage();
    var_dump($anEvent);

   
    
    //Récupère tous les events
    echo '<h1>Get Events</h1>';
$someEvents = $tedx_manager->getEvents();
// Message
if( $someEvents->getStatus())
    echo 'Congrats! ' . $someEvents->getMessage();
else
    echo 'Error! ' . $someEvents->getMessage();
    var_dump($someEvents);
    
  //Récupère tous les events pour un speaker  
    echo '<h1>Get Events by Speaker - FS</h1>';
    $speaker = (FSSpeaker::getSpeaker(6)->getContent());
    var_dump(FSEvent::getEventsBySpeaker($speaker)->getContent());
    
    echo '<h1>Motivation</h1>';
    $args =     array(
            'Text'         => "Je ne refais que rarement se que%",
            'EventNo'   => 1,
            'ParticipantPersonNo'   => 5
    );
    var_dump(FSMotivation::getMotivation($args));
    var_dump(FSMotivation::getMotivations());
    
    
    
    $event = FSEvent::getEvent(2)->getContent();
    $participant = FSParticipant::getParticipant(29)->getContent();
    $argsMotivation= array(
            'Text'         => 'Take it MF!!',
            'Event'   => $event,
            'Participant'   => $participant
        );
var_dump(FSMotivation::addMotivation($argsMotivation));

$argsSetMotivation= array(
            'Text'         => 'Take it MF!!',
            'EventNo'   => 2,
            'ParticipantPersonNo'   => 29,
            'IsArchived'    => 1
        );
$aMotivationToSet = FSMotivation::getMotivation($argsSetMotivation)->getContent();
var_dump(FSMotivation::setMotivation($aMotivationToSet));

$argsArchiveMotivation= array(
            'Text'         => 'Take it MF!!',
            'EventNo'   => 2,
            'ParticipantPersonNo'   => 29,
            'IsArchived'    => 1
        );
$aMotivationToArchive = FSMotivation::getMotivation($argsArchiveMotivation)->getContent();
var_dump(FSMotivation::setMotivation($aMotivationToArchive));

require_once(APP_DIR .'/core/services/functionnals/FSLocation.class.php');
require_once(APP_DIR .'/core/services/functionnals/FSParticipant.class.php');
require_once(APP_DIR .'/core/services/functionnals/FSEvent.class.php');

/*
echo '<h1>Location</h1>';
var_dump(FSLocation::getLocation("L'Usine"));

var_dump(FSLocation::getLocations());
$argsLocation= array(
            'Name'         => 'Zoooooooorooo',
            'Address'   => 'Une Adresse',
            'City'   => 'Une ville',
            'Country'   => 'Un pays'
         
        );
var_dump(FSLocation::addLocation($argsLocation));
echo '<h1>Participant</h1>';
var_dump(FSParticipant::getParticipant(5));
var_dump(FSParticipant::getParticipants());
var_dump(FSParticipant::addParticipant(8));
<<<<<<< HEAD
echo '<h1>Event</h1>';
var_dump(FSEvent::getEvent(1));
var_dump(FSEvent::getEvents());
$argsEvent = array(
            "mainTopic"         => "Tom Pouce nétait pas si petit",
            "description"   => "Petit mais pas vert!",
            "startingDate"   => "2014-10-05",
            'endingDate'   => "2014-10-05",
            "startingTime"   => "13:00:00",
            "endingTime"   => "18:00:00"
           
        );
//var_dump(FSEvent::addEvent($argsEvent));

echo '<h1>Participation</h1>';
$aParticipation = array(
            'slotNo'         => 1,
            'slotEventNo'   => 1,
            'participantPersonNo'   => 6
        );
var_dump(FSParticipation::getParticipation($aParticipation));
var_dump(FSParticipation::getParticipations());
$argsParticipation = array(
            "slotNo"         => 2,
            "slotEventNo"   => 2,
            "participantPersonNo"   => 8
        );
var_dump(FSParticipation::addParticipation($argsParticipation));

        
        
echo '<h1>AS Event</h1>';
var_dump(ASEvent::getEvent(1));
var_dump(ASEvent::getEvents());*/
?>
    </body>
</html>