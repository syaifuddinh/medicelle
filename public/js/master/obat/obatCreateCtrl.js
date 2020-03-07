app.controller('obatCreate', ['$scope', '$http', '$rootScope', '$filter', function($scope, $http, $rootScope, $filter) {
    $scope.title = 'Tambah Obat';
    $scope.is_allow_classification = 1
    $scope.is_allow_subclassification = 1
    $scope.is_allow_generic = 1
    $scope.formData = {
        is_category : 0,
        additional : {}
    }
    $scope.insertData = {}
    $scope.classification = []
    $scope.subclassification = []
    $scope.generic = []
    $scope.data = {}
    var path = window.location.pathname;

    $scope.countPrice = function() {
        $scope.formData.price = parseInt($scope.formData.purchase_price) * ( 100 + parseInt($scope.formData.additional.margin)) / 100
    }

    $scope.show = function() {
        if(/edit/.test(path)) {
            $scope.title = 'Edit Obat';
            id = path.replace(/.+\/(\d+)/, '$1');
            $http.get(baseUrl + '/controller/master/obat/' + id).then(function(data) {
                $scope.formData = data.data
                $scope.formData.grup_nota_id = data.data.price.grup_nota_id
                $scope.formData.price = data.data.rate
                setTimeout(function () {    
                    $('[ng-model="formData.additional.expired_date"]').val( $filter('fullDate')($scope.formData.additional.expired_date))
              }, 300)
                $scope.changeSampleCode()
                $scope.changeClassification()
                $scope.changeSubclassification()
                $scope.changeGeneric()
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

    $scope.changeClassification = function() {
        if($scope.formData.category_id) {
            classification = $scope.data.classification.filter(x => x.category_id == $scope.formData.category_id)
            $scope.classification = classification
        }
    }

    $scope.changeSubclassification = function() {
        if($scope.formData.classification_id) {
            subclassification = $scope.data.subclassification.filter(x => x.classification_id == $scope.formData.classification_id)
            $scope.subclassification = subclassification
        } 
    }

    $scope.changeGeneric = function() {
        if($scope.formData.subclassification_id) {
            generic = $scope.data.generic.filter(x => x.subclassification_id == $scope.formData.subclassification_id)
            $scope.generic = generic
        }
    }

    $scope.insert = function(flag) {
      var label
      switch (flag) {
        case 'category' :
          label = 'Jenis Administrasi'
          break
        case 'classification' :
          label = 'Kelas'
          $scope.insertData.category_id = $scope.formData.category_id
          break
        case 'subclassification' :
          label = 'Sub-Kelas'
          $scope.insertData.classification_id = $scope.formData.classification_id
          break
        case 'generic' :
          label = 'Generic'
          $scope.insertData.subclassification_id = $scope.formData.subclassification_id
          break
      }
      $scope.insert_title = 'Tambah ' + label
      $scope.componentState = flag
      if(flag != 'category') {
          if(flag == 'classification' && !$scope.formData.category_id) {
              toastr.warning("Jenis administrasi tidak boleh kosong")
          } else if(flag == 'subclassification' && !$scope.formData.classification_id) {
              toastr.warning("Kelas tidak boleh kosong")
          } else if(flag == 'generic' && !$scope.formData.subclassification_id) {
              toastr.warning("Sub-kelas tidak boleh kosong")
          } else {
            $('#insertModal').modal()
          }
      } else {
            $('#insertModal').modal()        
      }
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

    $scope.showClassification = function() {
        $http.get(baseUrl + '/controller/master/obat/classification/actived').then(function(data) {
            $scope.data.classification = data.data
            $scope.changeClassification()
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.showClassification()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.showClassification()

    $scope.showSubclassification = function() {
        $http.get(baseUrl + '/controller/master/obat/subclassification/actived').then(function(data) {
            $scope.data.subclassification = data.data
            $scope.changeSubclassification()
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.showSubclassification()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.showSubclassification()

    $scope.showGeneric = function() {
        $http.get(baseUrl + '/controller/master/obat/generic/actived').then(function(data) {
            $scope.data.generic = data.data
            $scope.changeGeneric()
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.showGeneric()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.showGeneric()

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
          
            if($scope.formData.category_id && $scope.formData.classification_id && $scope.formData.subclassification_id && $scope.formData.generic_id) {
                category_code = $scope.data.category.find(x => x.id == $scope.formData.category_id).code
                category_code = category_code.padStart(2, 0)
                classification_code = $scope.data.classification.find(x => x.id == $scope.formData.classification_id).code
                classification_code = classification_code.padStart(2, 0)
                subclassification_code = $scope.data.subclassification.find(x => x.id == $scope.formData.subclassification_id).code
                subclassification_code = subclassification_code.padStart(2, 0)
                generic_code = $scope.data.generic.find(x => x.id == $scope.formData.generic_id).code
                generic_code = generic_code.padStart(3, 0)

                prefix = '400.01.' + category_code + '.' + classification_code + '.' + subclassification_code + '.' + generic_code + '.'
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
        if($scope.componentState == 'classification') {
            $scope.showClassification()
        } else if($scope.componentState == 'subclassification') {
            $scope.showSubclassification()
        } else if($scope.componentState == 'generic') {
            $scope.showGeneric()
        } else if($scope.componentState == 'category') {
            $scope.category()
        }

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