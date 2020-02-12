app.controller('obatCreate', ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope) {
    $scope.title = 'Tambah Obat';
    $scope.formData = {
        is_category : 0,
        additional : {}
    }
    $scope.insertData = {}
    $scope.data = {}
    var path = window.location.pathname;

    $scope.show = function() {
        if(/edit/.test(path)) {
            $scope.title = 'Edit Obat';
            id = path.replace(/.+\/(\d+)/, '$1');
            $http.get(baseUrl + '/controller/master/obat/' + id).then(function(data) {
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

    $scope.insert = function(flag) {
      var label
      switch (flag) {
        case 'category' :
          label = 'Jenis Administrasi'
          break
        case 'classification' :
          label = 'Kelas'
          break
        case 'subclassification' :
          label = 'Sub-Kelas'
          break
        case 'generic' :
          label = 'Generic'
          break
      }
      $scope.insert_title = 'Tambah ' + label
      $scope.componentState = flag
      $('#insertModal').modal()
    }

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
        $http.get(baseUrl + '/controller/master/obat/category/actived').then(function(data) {
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

    $scope.classification = function() {
        $http.get(baseUrl + '/controller/master/obat/classification/actived').then(function(data) {
            $scope.data.classification = data.data
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
            
            $scope.classification()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.classification()

    $scope.subclassification = function() {
        $http.get(baseUrl + '/controller/master/obat/subclassification/actived').then(function(data) {
            $scope.data.subclassification = data.data
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
            
            $scope.subclassification()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.subclassification()

    $scope.generic = function() {
        $http.get(baseUrl + '/controller/master/obat/generic/actived').then(function(data) {
            $scope.data.generic = data.data
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
            
            $scope.generic()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.generic()

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
      var url = baseUrl + '/controller/master/obat';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/master/obat/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/obat'          
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
    $scope.submitComponent=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/master/obat/' + $scope.componentState;
      var method = 'post';
      $http[method](url, $scope.insertData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        $scope.category()
        $scope.classification()
        $scope.subclassification()
        $scope.generic()

        $scope.insertData = {}
        $('#insertModal').modal('hide')
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