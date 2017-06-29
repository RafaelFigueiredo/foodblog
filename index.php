<!DOCTYPE html>
<html lang="en" ng-app="blogApp">
<head>
  <!-- Charset and Viewport -->
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Title !-->
	<title>Teste Rafael Figueiredo</title>

  <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Home CSS -->
  <link rel="stylesheet" href="assets/css/fonts.css">
  <link rel="stylesheet" href="assets/css/home.css">
</head>

<body  ng-controller="postsController as postCtrl" ng-scope>

  <!-- Logo on Top -->
	<div class="row">
		<center>
			<img class="img-logo-top" src="assets/img/logo.png" alt="">
		</center>
	</div>


  <!-- Navbar -->
   
<!-- Navigation -->
  <nav class="navbar navbar-default" role="navigation">
  <div class="container">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle toggle-menu menu-left push-body pull-left" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar top-bar"></span>
          <span class="icon-bar middle-bar"></span>
          <span class="icon-bar bottom-bar"></span>
      </button>
      <a class="navbar-brand img-logo-menu" href="#"><img class="" src="assets/img/logo.png" alt=""></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">LOREM IPSUM</a></li>
        <li><a href="#">LOREM IPSUM</a></li>
        <li><a href="#">LOREM IPSUM</a></li>
        <li><a href="#">LOREM IPSUM</a></li>
        <li><a href="#">LOREM IPSUM</a></li>
        <li><a href="#">LOREM IPSUM</a></li>
        <li><a href="#">LOREM IPSUM</a></li>
        <li><a href="#">LOREM IPSUM</a></li>
        <li><a href="#">LOREM IPSUM</a></li>
        <li><a href="#">LOREM IPSUM</a></li>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </nav>

    <!-- Begin page content -->
    <div class="container">
    	<div class="row">
		  <div class="col-sm-12 col-md-12">
		    <div class="thumbnail">
	        	<h1>{{posts[0].title | uppercase}}</h1>
          <img class="img-food" src="uploads/{{posts[0].image}}" alt="...">
		      <hr>
		      <center>
			      <h2>{{posts[0].subtitle | uppercase}}</h2>
			      <p>
			      	{{posts[0].content}}
			      </p>
		      </center>
		    </div>
		  </div>
		</div>

   

		<div class="row">
		  <div class="col-sm-12 col-md-6" ng-repeat="post in filteredPosts">
      
		    <div class="thumbnail href">
		      <div class="caption">
		        <h3>{{post.title | uppercase}}</h3>
		      </div>
		      <img src="uploads/{{post.image}}" alt="...">
          <a href="#"><span></span></a>
          <div class="onMobile">
          <hr>
          <center><h3>{{post.subtitle | uppercase}}</h3></center>
          <p>{{post.content}}</p>
          </div>
		    </div>
		  </div>
      
		</div>

    </div>

    <div class="row">
    <center>
      <nav aria-label="Page navigation">
        <pagination 
            ng-model="currentPage"
            total-items="4"
            max-size="maxSize"  
            boundary-links="true">
          </pagination>
      </nav>

    </center>
    </div>

	


    <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>


    
</body>
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>


  <!-- Angulas JS -->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
  <script type="text/javascript" src="https://angular-file-upload.appspot.com/js/ng-file-upload-shim.js"></script>   
  <script type="text/javascript" src="https://angular-file-upload.appspot.com/js/ng-file-upload.js"></script>

  <script data-require="ui-bootstrap@*" data-semver="0.12.1" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.1.min.js"></script>

  <script type="text/javascript" src="assets/js/app.js"></script>
  <script type="text/javascript" src="assets/js/push-menu.js"></script>
</html>