<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
    <!-- Bootstrap core CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href=="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      

    </style>
  </head>
  <body>
    <h1>One Social</h1>
<?php include 'facebook.php';
include 'Merg.php';

$user=getUser();

?>
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Collapsible Group Item #1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Collapsible Group Item #2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Collapsible Group Item #3
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>

    <?php if ($user): ?>
    	<?php
    	$logoutUrl=getlogout($user); ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
      	<?php
    	$loginUrl=getlogged();
    	?>
        Login to Facebook:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>

    <?php endif ?>



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
	
     echo "<img src='".$value["image"]."'/>";
     echo " ".$value["name"]." - ".$value["created"];
	
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

              <script src="https://code.jquery.com/jquery.js"></script>
    <script src=="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    <script src="Bootstrap/bootstrap-3.0.0/assets/js/holder.js"></script>
  </body>
</html>
