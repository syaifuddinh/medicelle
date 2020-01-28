app.controller('specializationCreate', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope, $compile) {
    $scope.title = 'Tambah Spesialisasi';
    $scope.data = {}
    $scope.formData = {
        'doctor_roles' : {},
        'nurse_roles' : {},
        'grup_nota_roles' : []
    }
    var path = window.location.pathname;

    $scope.uncheckAll = function() {
      var doctor = $('#doctor')
      var nurse = $('#nurse')
      var flag;

      if(doctor.hasClass('active')) {
         flag = 'doctor'
      } else {
          flag = 'nurse'
      }
      $scope.formData[flag + '_roles'] = {}
    }

    $scope.checkAll = function() {
      var doctor = $('#doctor')
      var nurse = $('#nurse')
      var flag;

      if(doctor.hasClass('active')) {
         flag = 'doctor'
      } else {
          flag = 'nurse'
      }

      var roles = $('[ng-model*="formData.' + flag + '_roles"]');
      var role, unit;
      var regex = new RegExp("formData\." + flag + "_roles\.(.+)")
      for(model = 0;model < roles.length;model++) {
          unit = $(roles[model])
          if(unit.length > 0) {
            role = unit.attr('ng-model').replace(regex, '$1')
            console.log(role)
            $scope.formData[flag + '_roles'][role] = 1
          }

      }
    }

    $scope.show = function() {
        if(/edit/.test(path)) {
            $scope.title = 'Edit Spesialisasi';
            id = path.replace(/.+\/(\d+)/, '$1');
            $http.get(baseUrl + '/controller/master/specialization/' + id).then(function(data) {
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
            }, function(){
                  $scope.show()
            });
        }
    }
    $scope.show()

    $scope.medical_record_roles = function() {
        $http.get(baseUrl + '/controller/master/specialization/medical_record_roles').then(function(data) {
                var roles, role, row, medical_record_roles = data.data
                medical_record_doctor_roles_table = $('#medical_record_doctor_roles_table');
                medical_record_nurse_roles_table = $('#medical_record_nurse_roles_table');
                for(x in medical_record_roles) {
                    roles = medical_record_roles[x];
                    row = $('<tr><td><b>' + roles.name + '</b></td><td></td><td></td></tr>')
                    medical_record_doctor_roles_table.append(row)
                    medical_record_nurse_roles_table.append(row.clone())
                    for(y in roles.child) {
                        role = roles.child[y]
                        row = $('<tr><td style="padding-left:10mm">' + role.label + '</td><td class="text-right"><label class="radio-inline"><input type="checkbox" ng-model="formData.doctor_roles.' + role.name + '" ng-true-value="1" ng-false-value="0"></label><td class="text-right"><label class="radio-inline"><input type="checkbox" ng-model="formData.doctor_roles.' + role.name + '_editable" ng-true-value="1" ng-false-value="0"></label></td></tr>')
                        medical_record_doctor_roles_table.append(row)
                        row = $('<tr><td style="padding-left:10mm">' + role.label + '</td><td class="text-right"><label class="radio-inline"><input type="checkbox" ng-model="formData.nurse_roles.' + role.name + '" ng-true-value="1" ng-false-value="0"></label></td><td class="text-right"><label class="radio-inline"><input type="checkbox" ng-model="formData.nurse_roles.' + role.name + '_editable" ng-true-value="1" ng-false-value="0"></label></td></tr>')
                        medical_record_nurse_roles_table.append(row)
                    }
                }
                $compile(angular.element(medical_record_nurse_roles_table).contents())($scope);
                $compile(angular.element(medical_record_doctor_roles_table).contents())($scope);
            }, function(error) {
              $rootScope.disBtn=false;
              toastr.error(error.data.message,"Error Has Found !");
              $scope.medical_record_roles()
            });
    }
    $scope.medical_record_roles()

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/master/specialization';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/master/specialization/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/specialization'          
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