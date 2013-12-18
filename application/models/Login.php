<?php

class Application_Model_Login
    extends Zend_Db_Table_Abstract
{
    protected $_name = 'insta_login';
    
    public static function hash($input){
        return md5($input) . crc32('my_salt_here') . sha1($input);
    }
    
    public static function validPassword($password){
        return strlen($password) > 7 && strlen($password) < 21 && ctype_alnum($password);
    }
    
    public function authenticate($email, $password){
        return $this->fetchRow($this->select()->from($this->_name)->where('email = ?', $email)->where('password = ?', $this->hash($password)));
    }
    
    public function updatePassword($password, $user){
        return $this->update(array('password' => $this->hash($password)), 'user_id = ' . intval($user));
    }
    
    public function getRowByID($id){
        return $this->fetchRow("id = " . intval($id));
    }
    
    public function getRowByEmail($email){
        return $this->fetchRow($this->select()->where('email = ?', $email));
    }
    
    public function updateAccount($id, $post){
        
        try{
            
            // Init profile model
            $modelProfile = new Application_Model_Profile();
        
            // Start transaction
            $this->_db->beginTransaction();            

            // Fetch rows for user
            $rowLogin = $this->fetchRow('id = ' . (int)$id);
            $rowProfile = $modelProfile->fetchRow('user_id = ' . (int)$id);
            
            // Update row
            $rowLogin->email = $post['email'];
            if(isset($post['password']) && !empty($post['password'])){
                $rowLogin->password = self::hash($post['password']);
            }
            $rowLogin->save();
            
            // Update profile row
            $rowProfile->setFromArray($post)->save();
            
            // Commit transaction
            $this->_db->commit();
            
        } catch(Exception $e){
            
            // Rollback
            $this->_db->rollBack();
            
        }
        
    }

    public function fetchUserData($id){
        
        // Build select
        $select = $this->_db->select()->from(array('login' => $this->_name));
        // Join profile
        $select->joinInner(array('profile' => 'insta_profile'), 'login.id = profile.user_id');
        // Where ID
        $select->where('login.id = ?', $id);
        
        return $this->_db->fetchRow($select, null, Zend_Db::FETCH_OBJ);
    }
    
    public function createAccount($post){
        
        try{

            // Start transaction
            $this->_db->beginTransaction();
            
            // Add row to login
            $row = $this->createRow($post);
            $row->save();
            
            //Create row for profile
            $modelProfile = new Application_Model_Profile();
            $rowProfile = $modelProfile->createRow($post);
            $rowProfile->user_id = $row->id;
            $rowProfile->save();
            
            // Commit transaction
            $this->_db->commit();
            
            return true;
            
        } catch(Exception $e){
            // Rollback
            $this->_db->rollBack();
        }

        return false;
    }
    
}