<?php

class AjaxController
    extends Insta_MainController {
    
   public function uploadAction(){

        // Init
        $upload = new Zend_File_Transfer();
        $modelImages = new Application_Model_Images();
        $dbAdapter = $modelImages->getDefaultAdapter();

        // Set location
        $uploadDir = realpath(WEB_ROOT . '/users/images');        
        $upload->setDestination($uploadDir);
        
        // Add Validators
        $upload->addValidator('Extension', false, array('jpg', 'jpeg'));
        $upload->addValidator('FilesSize', false, 4000000);
        $upload->addValidator('IsImage', false);
        
        // Default response
        $response = array(
            'status' => false
        );
        
        foreach($upload->getFileInfo() as $file => $info){
            
            if($upload->isValid($file)){
                
                // Get extension of image
                $extension = strtolower(pathinfo($info['name'], PATHINFO_EXTENSION));
                
                // Generate new filename
                $filename = md5(microtime()) . '.' . $extension;
                
                // Rename uploaded file
                $upload->addFilter('Rename', $filename);
                
                // Take a break
                usleep(10);
                
                if($upload->receive()){ // Successful upload
                    
                    // Rescale the image
                    $source_image = imagecreatefromjpeg($uploadDir . '/' . $filename);
                    $source_imagex = imagesx($source_image);
                    
                    // Validate the size of upload
                    if($source_imagex < max($this->widths)){
                        @unlink($uploadDir . '/' . $filename);
                        return false;
                    }
                    
                    // Calculate aspect ratio + orientation
                    $source_imagey = imagesy($source_image);
                    $aspectRatio = $source_imagex/$source_imagey;
                    $orientation = ($source_imagex > $source_imagey) ? 'landscape' : 'portrait';
                    
                    // Container for new files
                    $filenames = array();
                    
                    // Process image @ variou widths
                    foreach($this->imageWidths as $key=>$width){
                        
                        // Calculate new height
                        $newHeight = $orientation == 'landscape' ? ($width / $aspectRatio) : ($width / $aspectRatio);
                        
                        // Create new image with proper size
                        $dest_image = imagecreatetruecolor($width, $newHeight);
                        imagecopyresampled($dest_image, $source_image, 0, 0, 0, 0, $width, 
                                    $newHeight, $source_imagex, $source_imagey);
                        imagejpeg($dest_image, $uploadDir . '/' . $key . '_' . $filename ,80);
                        
                        // Append file to container
                        $filenames[] = str_replace(WEB_ROOT, '', $uploadDir . '/' . $key . '_' . $filename);
                    }
                    
                    // Remove original
                    @unlink($uploadDir . '/' . $filename);
                                        
                    try{
                        
                        // Start transaction
                        $dbAdapter->beginTransaction();
                        
                        // Add image reference
                        $image = $modelImages->addImage($this->_user->id, $filenames[0], $filenames[1]);

                        // Commit transaction
                        $dbAdapter->commit();
                        
                        $response = array(
                            'status' => true,
                            'id' => intval($image),
                            'image_src' => $filenames[0]
                        );
                        
                    } catch(Exception $e){
                        // Rollback transaction
                        $dbAdapter->rollBack();
                    }
                }
            }
        }
        
        die(json_encode($response));
   }
    
}