<?php
require_once(APP_DIR.'/core/model/Membership.class.php');
require_once(APP_DIR.'/core/model/Person.class.php');
require_once(APP_DIR.'/core/model/Member.class.php');
require_once(APP_DIR.'/core/model/Message.class.php');
require_once(APP_DIR.'/core/model/Unit.class.php');
require_once(APP_DIR.'/core/services/functionnals/FSUnit.class.php');
require_once(APP_DIR.'/core/services/functionnals/FSMember.class.php');
require_once(APP_DIR.'/core/services/functionnals/FSMembership.class.php');
require_once(APP_DIR.'/core/services/functionnals/FSPerson.class.php');

/**
 * Description of ASFree
 *
 * @author rapou
 */
class ASFree {
    
    /**
     * The constructor that does nothing
     */
    public function __construct() {
        // Nothing
    }
    
    /**
     * Method registerVisitor from SA Free
     * @param type $args 
     * @return type 
     */
    public static function registerVisitor($args){
        /*
            $argsPerson = array(
               'name'         => '',
               'firstname'    => '',
               'dateOfBirth'  => '',
               'address'      => '',
               'city'         => '',
               'country'      => '',
               'phoneNumber'  => '',
               'email'        => '',
               'description'  => '',
               'idmember'     => '',
               'password'     => '',
            );
         */
        /**
         * Arguments for adding a Person
         */
        $argsPerson = array(
            'name'         => $args['name'],
            'firstname'    => $args['firstname'],
            'dateOfBirth'  => $args['dateOfBirth'],
            'address'      => $args['address'],
            'city'         => $args['city'],
            'country'      => $args['country'],
            'phoneNumber'  => $args['phoneNumber'],
            'email'        => $args['email'],
            'description'  => $args['description']
        );
        
        /**
         * Add a Person
         */
        $messageAddedPerson = FSPerson::addPerson($argsPerson);
        /**
         * If the Person is added, continue. 
         */
        if($messageAddedPerson->getStatus()){      
            $anAddedPerson = $messageAddedPerson->getContent();
            /**
             * Arguments for adding a Member
             */
            $argsMember = array(
                'id'         => $args['idmember'],
                'password'   => $args['password'],
                'person'     => $anAddedPerson
            );
            /**
             * Add a Member
             */
            $messageAddedMember = FSMember::addMember($argsMember);
            /**
             * If the Member is added, continue.
             */
            if($messageAddedMember->getStatus()){
                $anAddedMember = $messageAddedMember->getContent();
                /**
                 * Get the Unit with the name 'Visitor' 
                 */
                $messageUnit = FSUnit::getUnitByName('Visitor');
                $visitorUnit = $messageUnit->getContent();
                /**
                 * Arguments for adding a Membership
                 */
                $argsMembership = array(
                    'member'  => $anAddedMember,
                    'unit' => $visitorUnit
                );
                /**
                 * Add a Membership
                 */
                $messageAddedMembership = FSMembership::addMembership($argsMembership);
                /**
                 * If the Membership is added, generate the message OK
                 */
                if($messageAddedMembership->getStatus()){
                    $anAddedMembership = $messageAddedMembership->getContent();
                    $argsMessage = array(
                        'messageNumber' => 402,
                        'message'       => 'Visitor registered',
                        'status'        => true,
                        'content'       => array('anAddedPerson' => $anAddedPerson, 'anAddedMember' => $anAddedMember, 'anAddedMembership' => $anAddedMembership)
                    );
                    $aRegisteredVisitor = new Message($argsMessage);
                }else{
                    /**
                     * Else give the error message about non-adding Membership
                     */
                    $aRegisteredVisitor = $messageAddedMembership;
                }
            }else{
                /**
                 * Else give the error message about non-adding Member
                 */
                $aRegisteredVisitor = $messageAddedMember;
            }
        }else{
            /**
             * Else give the error message about non-adding Person
             */
            $aRegisteredVisitor = $messageAddedPerson;
        }
        /**
         * Return the message Visitor Registed or not Registred
         */
        return $aRegisteredVisitor;
    }
}

?>
