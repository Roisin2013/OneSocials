<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
    <!-- Bootstrap core CSS -->
    <link href="Bootstrap/bootstrap-3.0.0/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="Bootstrap/bootstrap-3.0.0/dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
      
    </style>
  </head>
  <body>
    <h1>php-sdk</h1>
<?php include 'facebook.php';
include 'Merg.php';

$user=getUser();

?>
    <?php if ($user): ?>
    	<?php 
    	$logoutUrl=getlogout($user); ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
      	<?php 
    	$loginUrl=getlogged(); 
    	?>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
      
    <?php endif ?>

    <h3>PHP Session</h3>
    
<table><tr><td style="width:500px;">
    <?php if ($user): 
      $facebook=facbookPost($user);
	  
	  include 'Twitter.php';
   $twitter=twitterConnect();
   $merged=array_merge($facebook, $twitter);
   $sorted=reverse($merged);
   echo "<div class='accordion' id='accordion2'>";
   $One=1;
   foreach ($sorted as $value) {
   	echo "<div class='accordion-group'>";
    echo "<div class='accordion-heading'>";
    echo "<div class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapse".$One."'>";
    echo "<div class='well'>";
	  if($value["network"]=="Facebook"){
    echo "<button type='button' class='btn btn-lg btn-primary'>";
		 
	}
	else{
	echo "<button type='button' class='btn btn-lg btn-info'>";
		
	}
     echo "<img src='".$value["image"]."'/>";
     echo " ".$value["name"]." - ".$value["created"];
	 echo "</button>";
	 echo "</div>";
	 echo"</div>";
    echo"</div>";
    echo "<div id='collapse".$One."' class='accordion-body collapse'>";
      echo "<div class='accordion-inner'>";
	  
	  if($value["network"]=="Facebook"){
    echo "<div class='well well-sm' style=''>";
	}
	else{
	echo "<div class='well well-sm' style=''>";
		
	}
	
       if(array_key_exists("postImage", $value)){
	   	echo "<img src='".$value["postImage"]."'/>";
	   }
       if(array_key_exists("header", $value) && array_key_exists("link", $value)){
       	echo "<a href='".$value["link"]."'>".$value["header"]."</a></br>";
       }
	   else if(array_key_exists("header", $value) ){
       	echo $value["header"]."</br>";
       }
       if(array_key_exists("text", $value)){
       	echo $value["text"];
       }
	   //if($value["network"]=="Facebook"){
    
	   //echo"</div>";
		 //  }
	   echo "</div>";
      // print_r($value);
      
    echo"</div>";
	if($value["network"]=="Twitter"){
  echo "</br>";
  }
  echo "</div>";
       $One=$One+1;
  }
   echo "</div>";
      ?>
      	
          
  
 

      
    <?php else: ?>
      <strong><em>You are not Connected.</em></strong>
    <?php endif ?>
    </td><td style="vertical-align:text-top;">
        	
              <script src="Bootstrap/bootstrap-3.0.0/assets/js/jquery.js"></script>
    <script src="Bootstrap/bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>
    <script src="Bootstrap/bootstrap-3.0.0/assets/js/holder.js"></script>
  </body>
</html>