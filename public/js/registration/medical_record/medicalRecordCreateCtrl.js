app.controller('medicalRecordCreate', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Form Rekam Medis';
    $scope.data = {}
    
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');
    step = path.replace(/.*step\/(\d+)\/.*/, '$1')
    step = parseInt(step)
    
  $scope.show = function() {
      $http.get(baseUrl + '/controller/registration/medical_record/' + id).then(function(data) {
        $scope.formData = data.data
        $scope.patient = data.data.patient
        $scope.code = data.data.code
        disease_history_datatable.rows.add(data.data.disease_history).draw()
        family_disease_history_datatable.rows.add(data.data.family_disease_history).draw()
        pain_history_datatable.rows.add(data.data.pain_history).draw()
        pain_cure_history_datatable.rows.add(data.data.pain_cure_history).draw()
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

  $scope.submitDiseaseHistory = function() {
      disease_history_datatable.row.add($scope.disease_history).draw()
      $scope.disease_history = {}
  }

  $scope.submitFamilyDiseaseHistory = function() {
      family_disease_history_datatable.row.add($scope.family_disease_history).draw()
      $scope.family_disease_history = {}
  }


  $scope.submitPainHistory = function() {
      $scope.pain_history.is_other_pain_type = $scope.pain_history.is_other_pain_type ? '1' : '0';
      pain_history_datatable.row.add($scope.pain_history).draw()
      $scope.pain_history = {}
  }

  $scope.submitPainCureHistory = function() {
      $scope.pain_cure_history.is_other_pain_cure_type = $scope.pain_cure_history.is_other_pain_cure_type ? '1' : '0';
      pain_cure_history_datatable.row.add($scope.pain_cure_history).draw()
      $scope.pain_cure_history = {}
  }

  $http.get(baseUrl + '/controller/master/disease').then(function(data) {
    $scope.data.disease = data.data
    $scope.show()
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


  pain_history_datatable = $('#pain_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    {data : 'pain_location'},
    {data : 'pain_type'},
    {data : 'pain_duration'},
    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deletePainHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  pain_cure_history_datatable = $('#pain_cure_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    {data : 'cure'},
    {data : 'emergence_time'},
    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deletePainCureHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  disease_history_datatable = $('#disease_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    {
      data : null,
      render : function(resp) {
        var disease = $scope.data.disease.find(x => x.id == resp.disease_id);
        return disease.name
      }
    },
    {data : 'cure'},
    {
      data : null,
      render : function(resp) {
        return $filter('fullDate')(resp.last_checkup_date);
      }
    },

    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteDiseaseHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  family_disease_history_datatable = $('#family_disease_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    {
      data : null,
      render : function(resp) {
        var disease = $scope.data.disease.find(x => x.id == resp.disease_id);
        return disease.name
      }
    },
    {data : 'cure'},
    {
      data : null,
      render : function(resp) {
        return $filter('fullDate')(resp.last_checkup_date);
      }
    },

    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteFamilyDiseaseHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  $scope.reset = function() {
      $scope.formData = {
        code : $scope.code,
        patient : $scope.patient
      }
      $scope.disease_history = {}
      $scope.family_disease_history = {}
      $scope.pain_history = {}
      $scope.pain_cure_history = {}

      disease_history_datatable.clear().draw();
      family_disease_history_datatable.clear().draw();
      pain_history_datatable.clear().draw();

      window.scrollTo(0, 0)
  }
  $scope.reset()
    
  $scope.deletePainHistory = function(e) {
    var tr = $(e).parents('tr');
    pain_history_datatable.row(tr).remove().draw()
  }
    
  $scope.deletePainCureHistory = function(e) {
    var tr = $(e).parents('tr');
    pain_cure_history_datatable.row(tr).remove().draw()
  }
    
  $scope.deleteDiseaseHistory = function(e) {
    var tr = $(e).parents('tr');
    disease_history_datatable.row(tr).remove().draw()
  }

  $scope.deleteFamilyDiseaseHistory = function(e) {
    var tr = $(e).parents('tr');
    family_disease_history_datatable.row(tr).remove().draw()
  }

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/registration/medical_record/' + id;
      var method = 'put';
      
      $scope.formData.pain_history = pain_history_datatable.data().toArray()
      $scope.formData.pain_cure_history = pain_cure_history_datatable.data().toArray()
      $scope.formData.disease_history = disease_history_datatable.data().toArray()
      $scope.formData.family_disease_history = family_disease_history_datatable.data().toArray()
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/medical_record/step/' + (step + 1) + '/edit/' + id          
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