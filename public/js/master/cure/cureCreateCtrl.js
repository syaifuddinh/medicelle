app.controller('cureCreate', ['$scope', '$http', '$rootScope','$filter', function($scope, $http, $rootScope, $filter) {
    $scope.title = 'Tambah Item Medis';
    $scope.formData = {
        is_category : 0,
        additional : {}
    }
    $scope.data = {}
    var path = window.location.pathname;


    $scope.countPrice = function() {
        $scope.formData.price = parseInt($scope.formData.purchase_price) * ( 100 + parseInt($scope.formData.additional.margin)) / 100
    }

    $scope.show = function() {
        if(/edit/.test(path)) {
            $scope.title = 'Edit Item Medis';
            id = path.replace(/.+\/(\d+)/, '$1');
            $http.get(baseUrl + '/controller/master/medical_item/' + id).then(function(data) {
                $scope.formData = data.data
                $scope.formData.grup_nota_id = data.data.price.grup_nota_id
                $scope.formData.price = data.data.rate
                $scope.changeSampleCode()
                $scope.countPrice()
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
    }
    $scope.show()

    $scope.grup_nota = function() {
        $http.get(baseUrl + '/controller/user/grup_nota').then(function(data) {
            $scope.data.grup_nota = data.data
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.grup_nota()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.grup_nota()

    $scope.emptyCategory = function() {
        $scope.formData.category_id = null
        $scope.changeSampleCode()
    }

    $scope.category = function() {
        $http.get(baseUrl + '/controller/master/medical_item/category/actived').then(function(data) {
            $scope.data.category = data.data
            if(/edit/.test(path)) {
                $scope.show()
            }
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.category()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.category()

    $scope.piece = function() {
        $http.get(baseUrl + '/controller/master/piece/actived').then(function(data) {
            $scope.data.piece = data.data
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.piece()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.piece()

    $scope.changeSampleCode = function() {
        var prefix = '';
        var code = '';
        if($scope.formData.code) {
          
            if($scope.formData.is_category == 0 && $scope.formData.category_id) {
                prefix = $scope.data.category.find(x => x.id == $scope.formData.category_id).code
                prefix = prefix.padStart(3, 0) + '.'
            }

            var code = $scope.formData.code.padStart(3, 0)
        }
        $scope.sample_code = prefix +  code
    }

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/master/medical_item';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/master/medical_item/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/medical_item'          
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