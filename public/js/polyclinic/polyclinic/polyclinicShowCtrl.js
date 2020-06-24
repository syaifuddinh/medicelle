app.controller('polyclinicShow', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope,  $compile) {
  $scope.title = 'Detail Pasien';
  $scope.pivot = {}
  $scope.formData = {}
  $scope.data = {}
  var path = window.location.pathname
  id = path.replace(/.+\/(\d+)\/\d*/, '$1');
  pivot_medical_record_id = path.replace(/.+\/(\d+)\/(\d*)/, '$2');
  
  if( path.indexOf('polyclinic') > -1) {
      flag = 'polyclinic'
  } else if( path.indexOf('radiology') > -1) {
      flag = 'radiology'
  } else if( path.indexOf('chemoterapy') > -1) {
      flag = 'chemoterapy'
  }  else if( path.indexOf('laboratory') > -1) {
      flag = 'laboratory'
  } else if( path.indexOf('ruang_tindakan') > -1) {
      flag = 'ruang_tindakan'
  } else if( path.indexOf('medical_checkup') > -1) {
      flag = 'medical_checkup'
  }
  $scope.edit_role = 'allow_edit_' + flag + '_medical_record' 
  $scope.flag = flag
  
  $scope.openPDF = function() {
      if(path.indexOf('ruang_tindakan') > -1) {
          window.open( baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/ruang_tindakan/pdf')
      } else if(path.indexOf('radiology') > -1) {
          window.open( baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/radiology/pdf')
      } else if(path.indexOf('chemoterapy') > -1) {
          window.open( baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/chemoterapy/pdf')
      } else if(path.indexOf('laboratory') > -1) {
            if($scope.pivot.is_laboratory == 1) {

                window.open( baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/laboratory/pdf')
            } else if($scope.pivot.is_laboratory_treatment == 1) {
              
                window.open( baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/laboratory_form/pdf')
            }
      }
  }

  $scope.submitAdditionalPivot = function(key)  {
      var data = {}
      data[key] = $scope.pivotData[key]
      
      $http.put(baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/additional', data).then(function(data) {
        
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
  
  $scope.pivot = function() {

      $http.get(baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id).then(function(data) {
        $scope.pivot = data.data
        $scope.pivotData = $scope.pivot.additional;
        if($scope.pivot.is_laboratory_treatment == 1) {
            var laboratory_treatment_form = $('#laboratory_treatment_form')
            var unit, subunit, col, formgroup
            $scope.laboratoryData = $scope.pivot.parent.additional.treatment 
            for(x in $scope.pivot.parent.additional.treatment) {
                unit = $scope.pivot.parent.additional.treatment[x]
                for(y in unit.detail) {
                    subunit = unit.detail[y]
                    if(subunit.is_active == 1) {
                        col = $("<div class='col-md-6'><h4>" + subunit.name + "</h4></div>")
                        formgroup = $('<div class="form-group"><label>Hasil</label><textarea class="form-control" ng-change="submitLaboratoryForm(' + x +', ' + y + ', \'hasil\')" ng-model="laboratoryData[' + x + '].detail[' + y + '].hasil"></textarea></div>')
                        col.append(formgroup)
                        formgroup = $('<div class="form-group"><label>Satuan</label><textarea class="form-control" ng-change="submitLaboratoryForm(' + x +', ' + y + ', \'satuan\')" ng-model="laboratoryData[' + x + '].detail[' + y + '].satuan"></textarea></div>')
                        col.append(formgroup)
                        formgroup = $('<div class="form-group"><label>Nilai Normal</label><textarea class="form-control" ng-change="submitLaboratoryForm(' + x +', ' + y + ', \'nilai_normal\')" ng-model="laboratoryData[' + x + '].detail[' + y + '].nilai_normal"></textarea></div>')
                        col.append(formgroup)
                        formgroup = $('<div class="form-group"><label>Keterangan</label><textarea class="form-control" ng-change="submitLaboratoryForm(' + x +', ' + y + ', \'keterangan\')" ng-model="laboratoryData[' + x + '].detail[' + y + '].keterangan"></textarea></div>')
                        col.append(formgroup)
                        laboratory_treatment_form.append(col)
                    }
                }
            }

            $compile(laboratory_treatment_datatable)($scope);
            $compile(laboratory_treatment_form)($scope);
        }
      }, function(error) {
        $scope.pivot()
      });
  }
  $scope.pivot()

  $scope.submitLaboratoryForm = function(x, y, key) {
      var data = {
          "row" : x,
          "column" : y,
          "key" : key,
          "value" : $scope.pivot.parent.additional.treatment[x].detail[y][key]
      }

      $http.put(baseUrl + '/controller/registration/medical_record/pivot/' + $scope.pivot.parent.id + '/laboratory_form', data).then(function(data) {
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

  $scope.updateRuangTindakanDescription = function() {
      $http.put(baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/ruang_tindakan/description', $scope.pivotData).then(function(data) {
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

  $scope.updatePivot = function() {
      $http.put(baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/additional', $scope.pivotData).then(function(data) {
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

  $http.get(baseUrl + '/controller/registration/registration/' + id).then(function(data) {
    $scope.formData = data.data
    var assesment_url = $('#assesmentButton').attr('href') + '/' + data.data.assesment.id
    $('#assesmentButton').attr('href', assesment_url)
    $http.get(baseUrl + '/controller/master/polyclinic').then(function(data) {
      $scope.data.polyclinic = data.data

      $http.get(baseUrl + '/controller/master/doctor').then(function(data) {
        $scope.data.doctor = data.data

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


  polyclinic_detail_datatable = $('#polyclinic_detail_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    {
      data : null,
      className : 'capitalize',
      render : function(resp) {
        console.log(resp)
        if(resp.destination == 'POLIKLINIK') {
          var poly = $scope.data.polyclinic.find(x => x.id == resp.polyclinic_id);
          return 'Poliklinik ' + poly.name
        } else {
          return resp.destination.toLowerCase()
        }
      }
    },
    {
      data : 'time',
    },
    {
      data : null,
      render : function(resp) {
        var doctor = $scope.data.doctor.find(x => x.id == resp.doctor_id)
        return doctor.name;
      }
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
    if(is_delete)
      $http.delete(baseUrl + '/controller/master/polyclinic/' + id).then(function(data) {
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
      $http.put(baseUrl + '/controller/master/polyclinic/activate/' + id).then(function(data) {
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