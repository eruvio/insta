<?php

class Application_Model_Profile
    extends Zend_Db_Table_Abstract
{
    protected $_name = 'insta_profile';
    
    public function getUserById($id){
        return $this->_db->fetchRow($this->_db->select()->from(array('p' => 'insta_profile'))->joinInner(array('l' => 'insta_login'), 'p.id = l.user_id')->where('id=?', $id), null, Zend_Db::FETCH_OBJ);       
    }
        
    public function getUserByEmail($email){
        return $this->_db->fetchRow($this->_db->select()->from('insta_login')->where('email=?', $email), null, Zend_Db::FETCH_OBJ);
    }
    
    public function getUserRowById($id){
        return $this->fetchRow($this->select()->where('user_id=?', $id));       
    }
    
    public function verifyUniqueEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception("Invalid Email Address");
        }
        return $this->_db->fetchOne("SELECT count(0) FROM insta_login WHERE email=" . $this->_db->quote($email)) == 0;
    }
    
    public function fetchAllUsers($id){
        
        // Build subquery for is_friend
        $subquery = $this->_db->select()->from('insta_friends', 'count(0)')->where('insta_friends.user_id = ?', $id);
        $subquery->where('insta_friends.friend_id = profile.user_id');
        $subquery->limit(1);
        
        // Build query for profiles using subquery
        $select = $this->_db->select()->from(array('profile' => $this->_name), array('profile.*', 'is_friend' => '(' . $subquery->assemble() . ')'));
        
        // Join image data
        $select->joinLeft(array('images' => 'insta_images'), 'profile.profile_image = images.id', array('url_thumb', 'url_large'));
        
        // Exclude by id (current user)
        $select->where("profile.user_id <> ?", $id);
        
        return $this->_db->fetchAll($select, null, Zend_Db::FETCH_OBJ);
    }
    
}