app.controller('financeSetting', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope, $compile) {
    $scope.title = 'Setting Keuangan';
    $scope.formData = {
      finance : {}
    }



    $scope.show = function() {
        $http.get(baseUrl + '/controller/user/setting/finance').then(function(data) {
            $scope.formData.finance = data.data
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
          $scope.show()
        });
    }
    $scope.show()
    
    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      $scope.formData.finance.asuransi_rate_percentage = $scope.formData.finance.asuransi_rate_percentage || 0 
      var url = baseUrl + '/controller/user/setting/store_finance';
      var method = 'put';
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
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