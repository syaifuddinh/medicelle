app.controller('specializationShow', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope, $compile) {
    $scope.title = 'Detail Spesialisasi';
    $scope.formData = {}
    var path = window.location.pathname
    id = path.replace(/.+\/(\d+)/, '$1');
    $scope.is_hidden = 1
    var roles_container = $('.roles_container')
    var cover = $('<div style="position:absolute;width:100%;height:100%;top:0;left:0"></div>')
    roles_container.css('position', 'relative')
    roles_container.append(cover)

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

    $scope.show = function() {

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
    $scope.show()

    $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
      if(is_delete)
          $http.delete(baseUrl + '/controller/master/specialization/' + id).then(function(data) {
              toastr.success("Data Berhasil dinon-aktifkan !");
              setTimeout(function () {
                  location.reload();
              }, 1500)
          }, function(error) {
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

    $scope.activate = function(id) {
    is_activate = confirm('Apakah anda ingin mengaktifkan data ini ?');
      if(is_activate)
          $http.put(baseUrl + '/controller/master/specialization/activate/' + id).then(function(data) {
              toastr.success("Data Berhasil diaktifkan !");
              setTimeout(function () {
                  location.reload();
              }, 1500)
          }, function(error) {
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