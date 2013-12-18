<?php

class Application_Model_Images
    extends Zend_Db_Table_Abstract
{
    protected $_name = 'insta_images';

    /**
     * Fetches feed images for the current user
     * @param int $currentUser
     */
    public function fetchFeedImagesByID($currentUser){
        
        // Select from images
        $select = $this->_db->select()->from(array('images' => $this->_name));
        // Join friendship data
        $select->joinInner(array('friends' => 'insta_friends'), 'images.user_id = friends.friend_id');
        // Where corresponds to current user
        $select->where('friends.user_id = ?', intval($currentUser));
        
        return $this->_db->fetchAll($select, null, Zend_Db::FETCH_OBJ);
    }
    
    public function fetchImagesByID($id){
        
        // Select images
        $select = $this->select()->where('user_id = ?', $id);

        return $this->fetchAll($select);
    }
    
    public function addImage($id, $thumb, $large){
        
        // Create row
        return $this->createRow(array(
            'user_id' => $id,
            'url_thumb' => $thumb,
            'url_large' => $large,
            'created' => time()
        ))->save();
        
    }
    
    
}