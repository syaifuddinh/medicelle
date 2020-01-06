app.controller('laboratoryCreate', ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope) {
    $scope.title = 'Tambah Item Pemeriksaan Laboratorium';
    $scope.formData = {
        is_category : 0
    }
    $scope.data = {}
    var path = window.location.pathname;

    $scope.show = function() {
        if(/edit/.test(path)) {
            $scope.title = 'Edit Item Pemeriksaan Laboratorium';
            id = path.replace(/.+\/(\d+)/, '$1');
            $http.get(baseUrl + '/controller/master/laboratory/' + id).then(function(data) {
                $scope.formData = data.data
                $scope.formData.grup_nota_id = data.data.price.grup_nota_id
                $scope.formData.price = data.data.rate
                $scope.changeSampleCode()
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
        $http.get(baseUrl + '/controller/master/laboratory/category/actived').then(function(data) {
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
      var url = baseUrl + '/controller/master/laboratory';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/master/laboratory/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/laboratory'          
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