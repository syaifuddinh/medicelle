app.controller('purchaseRequestShow', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Detail Rekam Medis';
    $scope.data = {}
    $scope.priceSlider = 209
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');
    step = path.replace(/.*step\/(\d+)\/.*/, '$1')
    step = parseInt(step)

  $scope.backtohome = function() {
      var home_url = baseUrl + '/purchase_request/' + $scope.patient.id + '/patient';  
      window.location = home_url
  }
    
  $scope.show = function() {
      $http.get(baseUrl + '/controller/pharmacy/purchase_request/' + id).then(function(data) {
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
        $scope.show()
        toastr.error(error.data.message,"Error Has Found !");
      }
    });
  }


  $scope.reset = function() {
      $scope.formData = {
      }
      
  }
  $scope.reset()
  

}]);