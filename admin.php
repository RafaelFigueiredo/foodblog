<!DOCTYPE html>
<html ng-app="blogApp">

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

<body>
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
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Dashboard</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="#">LOREM IPSUM DOLOR</a></li>
        <li><a href="#">LOREM IPSUM DOLOR</a></li>
        <li><a href="#">LOREM IPSUM DOLOR</a></li>
        <li><a href="#">LOREM IPSUM DOLOR</a></li>
        <li><a href="#">LOREM IPSUM DOLOR</a></li>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </nav>



  <!-- Begin page content -->
  <div class="container" ng-scope ng-controller="modalController as modal">
    <div class="col-sm-12 col-md-12">
      <div class="thumbnail">
        <div >
          <button type="button" class="btn btn-success pull-right" ng-click="modal.new();"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;&nbsp;New post</button>
        </div>

        <table class="table table-hover" ng-controller="postsController as postCtrl">
          <thead>
            <tr>
              <th>id</th>
              <th>Title</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="post in posts"  ng-click="modal.edit(post);">
              <th scope="row">{{post.post_id}}</th>
              <td>{{post.title}}</td>
            </tr>
          </tbody>
        </table>
        </div>
    </div>



    </div>


    <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>


<!-- Modal -->
<div class="modal fade" id="modalEditPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" ng-controller="modalController as modal" ng-scope>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
    <form ng-submit="submit()" ng-controller="postsController" ng-scope>
    <input type="hidden" id="hiddenId" name="hiddenId" value="">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{modal.title}}</h4>
      </div>
      <div class="modal-body">

      
        <div class="row">
                 <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 control-label" for="txtTitle">Title</label>  
                  <div class="col-md-8 col-sm-8">
                  <input id="txtTitle" name="txtTitle" type="text" placeholder="The name of my dish is ..." class="form-control input-md" required="">

                  </div>
                </div>



                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-3  col-sm-3 control-label" for="txtSubtitle">Subtitle</label>  
                  <div class="col-md-8 col-sm-8">
                  <input id="txtSubtitle" name="txtSubtitle" type="text" placeholder="(optional)" class="form-control input-md">
                  </div>
                </div>



                <!-- File Button --> 
                <div class="form-group">
                  <label class="col-md-3 col-sm-3 control-label" for="fileCover">Cover picture</label>
                  <div class="col-md-4 col-sm-8">

                    <br>Upload:
                    <input type="file" ngf-select ng-model="picFile" name="file"    
                           accept="image/*" ngf-max-size="2MB" required
                           ngf-model-invalid="errorFile">
                    <i ng-show="myForm.file.$error.required">*required</i><br>
                    <i ng-show="myForm.file.$error.maxSize">File too large 
                        {{errorFile.size / 1000000|number:1}}MB: max 2M</i>
                    <img ng-show="myForm.file.$valid" ngf-thumbnail="picFile" class="thumb">
                    <button ng-click="picFile = null" ng-show="picFile">Remove</button>
      




                  </div>
                </div>
          </div>
          <hr>
          <div class="row">
                <!-- Textarea -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="txtText">Text</label>
                  <div class="col-md-12">                     
                    <textarea class="form-control" id="txtText" name="txtText"></textarea>
                  </div>
                </div>
          </div>
      </div>







      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="btnRemove" type="button" class="btn btn-danger disabled" data-dismiss="modal" ng-click="delete()">Delete</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


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