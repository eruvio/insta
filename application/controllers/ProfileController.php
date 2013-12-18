<?php

class ProfileController
    extends Insta_MainController {
  
    public function indexAction(){
        
        // Init models
        $modelImages = new Application_Model_Images();
        
        // Fetch images for feed
        $images = $modelImages->fetchFeedImagesByID($this->_auth->user->id);

        // Asign to view
        $this->view->assign(array(
            'images' => $images,
            'user' => $this->_user
        ));
        
    }
    
    public function friendsAction(){
        
        // Init models
        $modelFriend = new Application_Model_Friend();        
        $modelProfile = new Application_Model_Profile();
        
        if($this->_request->isPost()){
            
            // Fetch list from request
            $to_friend = $this->_request->getParam('friends', array());
            
            // Sanitize
            $to_friend = array_map('intval', $to_friend);
            
            // Update friends listing
            $modelFriend->updateFriends($this->_user->id, $to_friend);
            
        }
        
        // Fetch all users
        $users = $modelProfile->fetchAllUsers($this->_user->id);
        
        // Assign to view
        $this->view->assign(array(
            'users' => $users
        ));
    }
    
    public function photosAction(){
        
        // Init models
        $modelImages = new Application_Model_Images();
        
        // Fetch all images
        $userImages = $modelImages->fetchImagesByID($this->_user->id);
        
        // Assign to view
        $this->view->assign(array(
            'images' => $userImages
        ));
    }
    
    public function settingsAction(){
        
        // Init models
        $modelLogin = new Application_Model_Login();
        
        if($this->_request->isPost()){
            
            // Update profile
            $modelLogin->updateAccount($this->_user->id, $this->_request->getPost());
            
            // Redirect
            $this->redirect('/profile/settings');

            //@todo update session with new row
            
        }
        
        // Fetch settings for current user
        $user = $modelLogin->fetchUserData($this->_user->id);
        
        // Assign to view
        $this->view->assign(array(
            'user' => $user
        ));
        
    }
    
}

