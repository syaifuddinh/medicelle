app.controller('nurse_helperCreate', ['$scope', '$http', '$rootScope', '$filter', function($scope, $http, $rootScope, $filter) {
    $scope.title = 'Tambah Penunjang Medis';
    $scope.formData = {}
    $scope.data = {}
    var path = window.location.pathname;
    if(/edit/.test(path)) {
        $scope.title = 'Edit Penunjang Medis';
        id = path.replace(/.+\/(\d+)/, '$1');
        $http.get(baseUrl + '/controller/master/nurse_helper/' + id).then(function(data) {
            $scope.formData = data.data
            setTimeout(function () {
              
                $('[ng-model="formData.birth_date"]').val( $filter('fullDate')($scope.formData.birth_date))
                $('[ng-model="formData.start_date"]').val( $filter('fullDate')($scope.formData.start_date))
            }, 300)
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


    $http.get(baseUrl + '/controller/master/city').then(function(data) {
        $scope.data.city = data.data
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


    $http.get(baseUrl + '/controller/master/specialization/').then(function(data) {
        $scope.data.specialization = data.data

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


    $http.get(baseUrl + '/controller/user/group_user/').then(function(data) {
        $scope.data.group_user = data.data

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


    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/master/nurse_helper';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/master/nurse_helper/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/nurse_helper'          
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
}]);