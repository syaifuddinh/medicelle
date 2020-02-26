app.controller('polyclinicShow', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope,  $compile) {
  $scope.title = 'Detail Pasien';
  $scope.pivot = {}
  $scope.formData = {}
  $scope.data = {}
  var path = window.location.pathname
  id = path.replace(/.+\/(\d+)\/\d*/, '$1');
  pivot_medical_record_id = path.replace(/.+\/(\d+)\/(\d*)/, '$2');
  

  
  $scope.openPDF = function() {
      if(path.indexOf('ruang_tindakan') > -1) {
          window.open( baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/ruang_tindakan/pdf')
      } else if(path.indexOf('radiology') > -1) {
          if($scope.pivot.medical_record_detail.item.price.radiology_group == "USG MAMMAE") {
              window.open( baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/usg_mammae/pdf')
          } else if($scope.pivot.medical_record_detail.item.price.radiology_group == "USG ABDOMEN UPPER LOWER WANITA") {
              window.open( baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/usg_abdomen_upper_lower_wanita/pdf')
          } else if($scope.pivot.medical_record_detail.item.price.radiology_group == "USG ABDOMEN UPPER LOWER PRIA") {
              window.open( baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/usg_abdomen_upper_lower_pria/pdf')
          } else if($scope.pivot.medical_record_detail.item.price.radiology_group == "USG THYROID") {
              window.open( baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/usg_thyroid/pdf')
          } else if($scope.pivot.medical_record_detail.item.price.radiology_group == "MAMMOGRAFI") {
              window.open( baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/mammografi/pdf')
          } else if($scope.pivot.medical_record_detail.item.price.radiology_group == "X-RAY") {
              window.open( baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/xray/pdf')
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
      }, function(error) {
        $scope.pivot()
      });
  }
  $scope.pivot()

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