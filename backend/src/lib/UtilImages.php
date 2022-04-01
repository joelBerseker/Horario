<?php

namespace User\Backend\lib;

class UtilImages{
    public static function storeImage(string $dir,array $photo):string{
        $target_dir = "public/img/".$dir;
        $extarr = explode('.',$photo["name"]);
        $filename = $extarr[sizeof($extarr)-2];
        $ext = $extarr[sizeof($extarr)-1];
        $hash = md5(Date('Ymdgi').$filename).'.'.$ext;
        $target_file=$target_dir.$hash;
        $uploadOk=1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($photo["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            //$this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPHOTO_FORMAT]);
        // if everything is ok, try to upload file
        } else {
            
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
               return $target_file;
            } else {
                return NULL;
            }
        }
    }
}