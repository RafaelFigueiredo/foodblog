# Food Blog

This app was developed as part of selection proccess to interniship as front-end developer at Webedia Group in Rio de Janeiro.

## Links
[Blog](http://editordoapp.16mb.com/blog/)
[Administrative Area](http://editordoapp.16mb.com/blog/admin.php)
## Tools
 - [Codeigniter](http://codeigniter.com) - PHP Framework
 - [Bootstrap](http://getbootstrap.com) - CSS Framework
 - [AngularJS](https://angularjs.org/) - Javascript framwork
 - (MySQL + Apache + PHP) free host at [Hostinger](http://www.hostinger.com.br).

## API
**Read**
```javascript
//Data url
var dataUrl = "post_id=all";
//Fire a ajax request
$http({
method: 'POST',
url: 'api/index.php/blog/read/',  //<<---- API FUNCTION HERE
data: dataUrl,
headers: {'Content-Type': 'application/x-www-form-urlencoded'}
}).then(
    function(){/* success callback*/},
    function(){/* error callback*/}
);
```

**Submit** - Could be used to create or update a post
```javascript
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
```
**Delete**
```javascript
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
```


    
## Database
The database was designed using [DBDesigner.net](dbdesigner.net) and exported to a MYSQL server.

![enter image description here](https://lh3.googleusercontent.com/-syWGGsd9SyA/WVViQYjrefI/AAAAAAAAAQQ/lUMhQiDGFfkG_7eINRcBx_7TC6VaQIQzQCLcBGAs/s0/db.png "db.png")




> Written with [StackEdit](https://stackedit.io/).
