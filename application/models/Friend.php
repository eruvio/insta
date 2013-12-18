<?php

class Application_Model_Friend
    extends Zend_Db_Table_Abstract
{
    protected $_name = 'insta_friends';
    
    public function updateFriends($user, Array $friends){
        
        try{
            
            // Start transaction
            $this->_db->beginTransaction();
            
            // Remove all current friends
            $this->delete('user_id = ' . intval($user));

            // Update friends
            foreach($friends as $friend){
                $this->createRow(array(
                    'user_id' => intval($user),
                    'friend_id' => intval($friend)
                ))->save();
            }
            
            // Commit transaction
            $this->_db->commit();
            
        } catch(Exception $e){
            // @todo: add logging
            // Rollback transaction
            $this->_db->rollBack();
        }
    }

}