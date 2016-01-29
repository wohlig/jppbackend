<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class restapi_model extends CI_Model
{
    public function getGallerySlide($id)
    {   
        //GALLERY
        
            $query=$this->db->query("SELECT `id`, `order`, `gallery`, `name`, `image` FROM `jpp_galleryslide` WHERE           `gallery`='$id' ORDER BY `order` ASC")->result();
        
      
        return $query;
    }   
    public function getVideos($id)
    {   
        //VIDEOS
        
        
             $query=$this->db->query("SELECT `id`, `videogallery`, `order`, `name`, `url`, `image` FROM `jpp_videos` WHERE `videogallery`='$id' ORDER BY `order` ASC")->result();
        
        return $query;
    }
    public function getAllPoints()
    {
         $query=$this->db->query("SELECT `jpp_point`.`id` AS `id` , `jpp_point`.`played` AS `played` , `jpp_point`.`wins` AS `wins` , `jpp_point`.`lost` AS `lost` , `jpp_point`.`point` AS `point` , `jpp_team`.`name` AS `name` FROM `jpp_point` LEFT OUTER JOIN `jpp_team` ON `jpp_team`.`id`=`jpp_point`.`team` ORDER BY `jpp_point`.`point`, `jpp_point`.`played` DESC")->result();
        return $query;
    }
    public function getAllGallery()
    {
         $query=$this->db->query("SELECT `jpp_gallery`.`id` AS `id` , `jpp_gallery`.`order` AS `order` , `jpp_gallery`.`name` AS `name` , `jpp_gallery`.`image` AS `image` FROM `jpp_gallery` ORDER BY `order` ASC")->result();
        return $query;
    } 
    public function getAllVideoGallery()
    {
         $query=$this->db->query("SELECT * FROM `jpp_videogallery` ORDER BY `order` ASC")->result();
        return $query;
    } 
    public function getAllSliders()
    {
         $query=$this->db->query("SELECT `id`, `name`, `image`, `order`, `status` FROM `jpp_slider` WHERE `status`=1 ORDER BY `order` ASC")->result();
        return $query;
    } 
    public function getWallpaper($type)
    {
        if($type==1)
        {
            //for mobile
            $query=$this->db->query("SELECT `id`, `wallpapercategory`, `name`, `image1` as `image` FROM `jpp_wallpaper` WHERE `wallpapercategory`='2'")->result();
        }
        else if($type==2){
            //for desktop
            $query=$this->db->query("SELECT `id`, `wallpapercategory`, `name`, `image1` as `image` FROM `jpp_wallpaper`")->result();
        } 
        else if($type==3){
            //for iOS
            $query=$this->db->query("SELECT `id`, `wallpapercategory`, `name`, `image1` as `image` FROM `jpp_wallpaper` WHERE `wallpapercategory`='3'")->result();
        }
        if($query){
            return $query;
        }
         else{
             return false;
         }
        
    } 
    public function getallnews()
    {
         $query=$this->db->query("SELECT `jpp_news`.`id` AS `id` , `jpp_news`.`name` AS `name` , `jpp_news`.`image` AS `image` ,`jpp_news`.`logo` AS `logo`, DATE_FORMAT(`jpp_news`.`timestamp`, '%d %b %Y') as `timestamp` , `jpp_news`.`content` AS `content` FROM `jpp_news` ORDER BY `id` DESC")->result();
        return $query;
    } 
    public function getHomeContent()
    {
         $query['latestupdate']=$this->db->query("SELECT `jpp_schedule`.`id`, `jpp_stadium`.`name` as `stadium`, `jppteam1`.`name` as `team1`,`jppteam1`.`id` as `team1id`, `jppteam2`.`name` as `team2`,`jppteam2`.`id` as `team2id`, `jpp_schedule`.`bookticket`, `jpp_schedule`.`score1`, `jpp_schedule`.`score2`,substring(CONCAT(DATE_FORMAT(`jpp_schedule`.`startdate`, '%d %b %Y'), ', ', `starttime`), 1, length(CONCAT(DATE_FORMAT(`jpp_schedule`.`startdate`, '%d %b %Y'), ', ', `starttime`)) - 3) as `starttimedate`
FROM `jpp_schedule` 
LEFT OUTER JOIN `jpp_stadium` ON `jpp_stadium`.`id`=`jpp_schedule`.`stadium`
LEFT OUTER JOIN `jpp_team` as `jppteam1`ON `jppteam1`.`id`=`jpp_schedule`.`team1`
LEFT OUTER JOIN `jpp_team` as `jppteam2`ON `jppteam2`.`id`=`jpp_schedule`.`team2`
WHERE `jpp_schedule`.`score1`<>'' AND `jpp_schedule`.`score2`<>'' AND `jpp_schedule`.`timestamp` < NOW()")->row();
        $query['news']=$this->db->query("SELECT `id`, `name`, `image`, DATE_FORMAT(`timestamp`,'%d %b %Y, %h:%i') as `timestamp`, `content` FROM `jpp_news` ORDER BY `timestamp` DESC")->row();    
        $query['points']=$this->db->query("SELECT `jpp_point`.`id` AS `id` , `jpp_point`.`played` AS `played` , `jpp_point`.`wins` AS `wins` , `jpp_point`.`lost` AS `lost` , `jpp_point`.`point` AS `point` , `jpp_team`.`name` AS `name` FROM `jpp_point` LEFT OUTER JOIN `jpp_team` ON `jpp_team`.`id`=`jpp_point`.`team` ORDER BY `point` DESC")->result();
        return $query;
    } 
    public function getSchedule()
    {
         $query=$this->db->query("SELECT `jpp_schedule`.`id`, `jpp_stadium`.`name` as `stadium`, `jppteam1`.`name` as `team1`,`jppteam1`.`id` as `team1id`, `jppteam2`.`name` as `team2`,`jppteam2`.`id` as `team2id`,`jpp_schedule`.`bookticket`, `jpp_schedule`.`score1`, `jpp_schedule`.`score2`,substring(CONCAT(DATE_FORMAT(`jpp_schedule`.`startdate`, '%d %b %Y'), ', ', `starttime`), 1, length(CONCAT(DATE_FORMAT(`jpp_schedule`.`startdate`, '%d %b %Y'), ', ', `starttime`)) - 3) as `starttimedate`
FROM `jpp_schedule` 
LEFT OUTER JOIN `jpp_stadium` ON `jpp_stadium`.`id`=`jpp_schedule`.`stadium`
LEFT OUTER JOIN `jpp_team` as `jppteam1`ON `jppteam1`.`id`=`jpp_schedule`.`team1`
LEFT OUTER JOIN `jpp_team` as `jppteam2`ON `jppteam2`.`id`=`jpp_schedule`.`team2`
WHERE `jpp_schedule`.`score1`='' AND `jpp_schedule`.`score2`='' AND CONCAT(`jpp_schedule`.`startdate`, ' ', `starttime`) > NOW()
ORDER BY CONCAT(`jpp_schedule`.`startdate`, ' ', `starttime`) ASC")->result();
        return $query;
    }
}
?>