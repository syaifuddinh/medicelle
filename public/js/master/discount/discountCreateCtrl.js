app.controller('discountCreate', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Tambah Promo';
    $scope.formData = {}
    var path = window.location.pathname;
    if(/edit/.test(path)) {
        $scope.title = 'Edit Promo';
        id = path.replace(/.+\/(\d+)/, '$1');
        $http.get(baseUrl + '/controller/master/discount/' + id).then(function(data) {
            $scope.formData = data.data
            setTimeout(function () {
              
                $('[ng-model="formData.date_start"]').val( $filter('fullDate')($scope.formData.date_start))
                $('[ng-model="formData.date_end"]').val( $filter('fullDate')($scope.formData.date_end))
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

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/master/discount';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/master/discount/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/discount'          
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