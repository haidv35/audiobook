<?php
namespace App\Services;
class UploadService{
    public function handleUploadedImage($image_upload){
        if (!is_null($image_upload)) {
            $new_name = rand() . md5($image_upload->getClientOriginalName()) . rand() . '.' . $image_upload->getClientOriginalExtension();
            $image_upload->move(public_path('images'), $new_name);
            // $image_upload->move(realpath(base_path().'/../tastore.club/images/'), $new_name);

            $image_link = url('/')."/images/".$new_name;
            // $image_link = realpath(base_path().'/../tastore.club/images/').$new_name;
        }
        else{
            $image_link = "";
        }
        return $image_link;
    }
}
