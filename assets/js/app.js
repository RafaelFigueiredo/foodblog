var test=[];

(function(){
  //Angular Module
  var app = angular.module('blogApp', ['ngFileUpload','ui.bootstrap']);

  /*******************************************
   *               Modal Controller          *
   ******************************************/
  app.controller('modalController', function(){
    this.title = "Write a new post...";

    this.postData = [
      { title:'',
        subtitle: '',
        text:''
      }
    ];


    this.new = function(){
      //disable the Remove Button
      $('#btnRemove').addClass('disabled');
      //erase the content
      $('#hiddenId').val('');
      $('#txtTitle').val('');
      $('#txtSubtitle').val('');
      $('#fileCover').val('');        //@todo
      $('#txtText').val('');

      //open modal window
      $('#modalEditPost').modal()                      // initialized with defaults
      $('#modalEditPost').modal({ keyboard: false })   // initialized with no keyboard
      $('#modalEditPost').modal('show')
    };


    this.edit = function(post){
      //enable the Remove Button
      $('#btnRemove').removeClass('disabled');
      //fill the content
      $('#hiddenId').val(post.post_id);
      $('#txtTitle').val(post.title);
      $('#txtSubtitle').val(post.subtitle);
      $('#txtText').val(post.content);
      //open modal window
      $('#modalEditPost').modal()                      // initialized with defaults
      $('#modalEditPost').modal({ keyboard: false })   // initialized with no keyboard
      $('#modalEditPost').modal('show')
    };
  });


  /*******************************************
   *               Posts Controller          *
   ******************************************/
  app.controller('postsController', ['$scope', '$http','Upload', '$timeout', function ($scope, $http,Upload, $timeout) {
    $scope.posts = [];
    //AJAX Functions
    
    //@function Read
    $scope.read = function(){
        //Data url
        var dataUrl = "post_id=all";
        
        //Fire a ajax request
        $http({
            method: 'POST',
            url: 'api/index.php/blog/read/',  //<<---- API FUNCTION HERE
            data: dataUrl,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(
        //success callback
          function(response, status, headers, config) {
              $scope.posts = response.data.posts;
              $scope.paginate();
          },

        //error callback
          function(data, status, headers, config) {
              alert( "error message: " + JSON.stringify({data: data}));
          }
        );
    };

    //@function Submit - Save all changes
    $scope.submit = function(){
        var file =$scope.picFile;
        file.upload = Upload.upload({
          url: 'api/index.php/blog/save/',
          data:{
                post_id: $('#hiddenId').val(),
                title: $('#txtTitle').val(),
                subtitle: $('#txtSubtitle').val(),
                content: $('#txtText').val(),
                file: file},


        });

        file.upload.then(function (response) {
          $timeout(function () {
            file.result = response.data;
            console.log(response.data);
          });
        }, function (response) {
          if (response.status > 0)
            $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
          // Math.min is to fix IE which reports 200% sometimes
          file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });


        //Just for debug
        console.log("submit");
        //Data url
        
        
        
    };


    //@function Delete
    $scope.delete = function(){
        //Just for debug
        console.log("delete");
        //Data url
        var dataUrl = "post_id="    + $('#hiddenId').val();
        
        //Fire a ajax request
        $http({
            method: 'POST',
            url: 'api/index.php/blog/delete/',  //<<---- API FUNCTION HERE
            data: dataUrl,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(
        //Success callback
          function(response, status, headers, config) {
              console.log(response.data);
          },

        //Error callback
          function(data, status, headers, config) {
              alert( "error message: " + JSON.stringify({data: data}));
          }
        );
    };

    
    $scope.paginate = function(){
      console.log("data:");
      console.log($scope.posts);

      $scope.filteredPosts = [];
      $scope.currentPage = 1;
      $scope.numPerPage = 5;
      $scope.maxSize = 5;

      $scope.numOfPage = $scope.posts.length % $scope.numPerPage;
      console.log($scope.numOfPage);
      
      
      $scope.$watch('currentPage + numPerPage', function() {
        var begin = (($scope.currentPage - 1) * $scope.numPerPage);
        var end = begin + $scope.numPerPage;
        console.log('begin'+begin);
        console.log('end'+end);
        
        $scope.filteredPosts = $scope.posts.slice(begin, end);
        console.log($scope.filteredPosts);
        $scope.filteredPosts.shift();
      });

      



    };



    //call the fist read to DB
    $scope.read();





  }]);//end-postController









})();