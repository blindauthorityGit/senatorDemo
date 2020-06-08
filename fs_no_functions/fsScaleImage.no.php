<?php

function fsScaleImage($tempName, $mimeType)
{
    $targetHeight = 480;
    // $templateHight = 150;

    if($mimeType == "image/jpeg")
    {      
        if(!$image = imagecreatefromjpeg($tempName))
        {                    
            return false;
        }
    }

    if($mimeType == "image/png")
    {      
        if(!$image = imagecreatefrompng($tempName))
        {                    
            return false;
        }
    }

    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);

    $scaleFactor = $targetHeight / $imageHeight;

    $scaleWidth = intval($imageWidth * $scaleFactor);
    $scaleHeight = intval($imageHeight * $scaleFactor);

    $newImage = imagecreatetruecolor($scaleWidth, $scaleHeight);

    // $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
    // imagefilledrectangle($newImage, 0, 0, $scaleWidth, $scaleHeight, $transparent);

    imagealphablending($newImage, false);
    imagesavealpha($newImage,true);

    if(!imagecopyresampled($newImage, $image, 0, 0, 0, 0, $scaleWidth, $scaleHeight, $imageWidth, $imageHeight))
    {
        imagedestroy ($image);
        imagedestroy ($newImage);
        return false;
    }

    if($mimeType == "image/jpeg")
    {      
        $success = imagejpeg($newImage, $tempName, -1);
    }

    if($mimeType == "image/png")
    {      
        $success = imagepng($newImage, $tempName, -1);
    }
       
    imagedestroy ($image);
    imagedestroy ($newImage);

    return $success;
}
