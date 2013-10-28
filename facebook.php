<?php
    include 'libs/facebook.php';
	$facebook=new FaceBook(array(
	'appId'=>'647463888626937',
	'secret'=>'ec308941131a8e1c07d27d66bd27216b',
	'cookie'=> true));
	function getUser(){
	$facebook=new FaceBook(array(
	'appId'=>'647463888626937',
	'secret'=>'ec308941131a8e1c07d27d66bd27216b',
	'cookie'=> true));
	$user = $facebook->getUser();
	$accessToken='647463888626937|ELx4XrN0ZCnKKsjJtVyvTdvTX9w';
	if ($user) {
	try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
	
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
  //function to retrieve posts from facebook's server

}
function getlogout($user) {
	$facebook=new FaceBook(array(
	'appId'=>'647463888626937',
	'secret'=>'ec308941131a8e1c07d27d66bd27216b',
	'cookie'=> true));
  return $logoutUrl = $facebook->getLogoutUrl();
} 
function getlogged() {
	$facebook=new FaceBook(array(
	'appId'=>'647463888626937',
	'secret'=>'ec308941131a8e1c07d27d66bd27216b',
	'cookie'=> true));
  return $loginUrl = $facebook->getLoginUrl(array('scope'=>"read_stream"));
}
// Login or logout url will be needed depending on current user state.


// This call will always work since we are fetching public data.

return $user;

	}


?>
<?php
function facbookPost($user){
	//loop through all the posts we got from facebook
$facebook=new FaceBook(array(
	'appId'=>'647463888626937',
	'secret'=>'ec308941131a8e1c07d27d66bd27216b',
	'cookie'=> true));
 $feed=$facebook->api('/me/feed');
 $facebookArray=array();
      foreach($feed as $posts){
      	foreach($posts as $post){
      		
      		if(is_array($post)){
      			$accessToken='647463888626937|ELx4XrN0ZCnKKsjJtVyvTdvTX9w';
				
      			$personfrom=null;
				$message=NULL;
				$images=null;
				$link=null;
				$name=null;
				$story=null;
				$actions=null;
				$captions=null;
				$dates=null;
      			if(array_key_exists("from", $post)==TRUE){
				$from=$post["from"];
				$personfrom= $from["name"];
			}
      		if(array_key_exists("message", $post)==TRUE){
      	$message=$post["message"];
				//print_r($post);
		}
			if(array_key_exists("picture", $post)==TRUE){
				$images=$post["picture"];
			}
			
			if(array_key_exists("icon", $post)==TRUE){
				$icon=$post["icon"];
			}
			if(array_key_exists("link", $post)==TRUE){
				if(array_key_exists("name", $post)==TRUE){
				
				$link=$post["link"];
				$name=$post["name"];
				}
				else if (array_key_exists("story", $post)==TRUE){
					$link=$post["link"];
					$name=$post["story"];
					
				}
				else {
					$link=$post["link"];
					$name="For more";
				}
			}
			
			else if(array_key_exists("name", $post)==TRUE){
				$name=$post["name"];
			}
			else if(array_key_exists("story", $post)==TRUE){
				$name=$post["story"];
			}
			
			if(array_key_exists("actions", $post)==TRUE && count($post["actions"]>0)){
						$actions=$post["actions"];
					//foreach ($post["actions"] as $link) {
						
				//echo "<a href='".$link["link"]."'>".$link["name"]."</a>|";
					//}
			
			if(array_key_exists("caption", $post)==TRUE){
				$captions=$post["caption"];
				//echo $captions;
			}
			
							
				if(array_key_exists("created_time", $post)==TRUE){
				
				$dateString = $post["created_time"];
$date = strtotime($dateString);
$dates = date('D d-M-Y H:i:s', strtotime($dateString));

		}
				$postItem=array("network"=>"Facebook","image"=>"https://graph.facebook.com/".$user."/picture?access_token=".$accessToken."", "name"=>$personfrom, "text"=>$message, "created"=>$dates, "link"=>$link, "header"=>$name, "postImage"=> $images, "actions"=>$actions, );
	array_push($facebookArray, $postItem);
			}
			}
			
			
			//foreach($post as $mytest){
				//echo "</br> </br>";
				//print_r($mytest);
			//}
			//print_r($post);
			
		
		
	  }
      
}
return $facebookArray;

}
?>