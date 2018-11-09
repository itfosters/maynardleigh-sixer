<?php
function image_thumb($thb_image_name, $image, $width, $height, $start_width, $start_height, $scale)
{
     $itf =& get_instance();

    list($imagewidth, $imageheight, $imageType) = getimagesize($image);
    $imageType = image_type_to_mime_type($imageType);
 
    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
    switch($imageType) {
        case "image/gif":
            $source=imagecreatefromgif($image);
            break;
        case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
            $source=imagecreatefromjpeg($image);
            break;
        case "image/png":
        case "image/x-png":
            $source=imagecreatefrompng($image);
            break;
      }
      
    imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
    switch($imageType) {
        case "image/gif":
              imagegif($newImage,$thb_image_name);
            break;
          case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
              imagejpeg($newImage,$thb_image_name,90);
            break;
        case "image/png":
        case "image/x-png":
            imagepng($newImage,$thb_image_name);  
            break;
    }
    //chmod($thb_image_name, 0777);
    return $thb_image_name;
}

function is_home()
{
	$itf =& get_instance();
	if($itf->router->class=="welcome" and $itf->router->method=="index")
		return true;
	else
		return false;
	
}


function adsBanner($page_id="",$position_id="")
{
    $itf =& get_instance();
    $banners = $itf->addmanagers->getBanners($page_id,$position_id);
    //print_r($banners); die;
    
    $htmlstring = "";
    $banner_width="";
    $banner_height="";
    $impressioncount=array();
    if(count($banners)>0)
    {
        $ipaddress = $itf->input->ip_address();
        $user_agent = $itf->input->user_agent();

        $htmlstring.="<div id='adds_".$page_id."_".$position_id."'><ul class='bjqs' >";
        foreach($banners as $k=>$bb)
        {
            if($k==0) 
            {
                $banner_width=$bb->banner_width;
                $banner_height=$bb->banner_height;
            }
            $htmlstring.='<li><a href="'.site_url("addmanager/view/".$bb->id).'" target="_blank"><img src="'.base_url("assests/itf_public/vendorbanner/".$bb->vendorbanner_image).'"></a></li>';            
            $impressioncount[]=array("vender_banner_id"=>$bb->id,"click_type"=>"i","ipaddress"=>$ipaddress,"user_agent"=>$user_agent);
        }        
        $htmlstring.="</ul></div>";
        $htmlstring.='<script type="text/javascript">$(document).ready(function(){$("#adds_'.$page_id.'_'.$position_id.'").bjqs({"height" : '.$banner_height.',"width" : '.$banner_width.',"responsive" : true,"showcontrols":false,"showmarkers":false });});</script>';
        //Add Impression
        $itf->addmanagers->addImpression($impressioncount);        
    }else{

        $bannerinfo = $itf->addmanagers->getBannerpositionInfo(array("banner_page_id"=>$page_id,"banner_position_id"=>$position_id));
        if(isset($bannerinfo->default_image) and !empty($bannerinfo->default_image))
            $htmlstring='<img src="'.base_url("assests/itf_public/bannertemplate/default/".$bannerinfo->default_image).'">';        
    }
    
    return $htmlstring;
}

function showImage($path="",$imagename="")
{

    if(!empty($imagename) and file_exists(PUBLIC_PATH.$path.$imagename))
        return PUBLIC_ULR.$path.$imagename;
    else
        return PUBLIC_ULR."default.jpg";
}