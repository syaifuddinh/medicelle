app.controller('groupUserCreate', ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope) {
    $scope.title = 'Tambah Group User';
    $scope.formData = {}
    var path = window.location.pathname;
    if(/edit/.test(path)) {
        $scope.title = 'Edit Group User';
        id = path.replace(/.+\/(\d+)/, '$1');
        $http.get(baseUrl + '/controller/user/group_user/' + id).then(function(data) {
            $scope.formData = data.data
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      if($scope.formData.id) {

          $http.put(baseUrl + '/controller/user/group_user/' + id, $scope.formData).then(function(data) {
            toastr.success("Data Berhasil Disimpan !");
            setTimeout(function () {
              window.location = baseUrl + '/group_user'          
            }, 1000)
          }, function(error) {
            $rootScope.disBtn=false;
            if (error.status==422) {
              var det="";
              angular.forEach(error.data.errors,function(val,i) {
                det+="- "+val+"<br>";
              });
              toastr.warning(det,error.data.message);
            } else {
              toastr.error(error.data.message,"Error Has Found !");
            }
          });
      } else {

          $http.post(baseUrl + '/controller/user/group_user', $scope.formData).then(function(data) {
            toastr.success("Data Berhasil Disimpan !");
            setTimeout(function () {
              window.location = baseUrl + '/group_user'          
            }, 1000)
          }, function(error) {
            $rootScope.disBtn=false;
            if (error.status==422) {
              var det="";
              angular.forEach(error.data.errors,function(val,i) {
                det+="- "+val+"<br>";
              });
              toastr.warning(det,error.data.message);
            } else {
              toastr.error(error.data.message,"Error Has Found !");
            }
          });
      }
    }
}]);