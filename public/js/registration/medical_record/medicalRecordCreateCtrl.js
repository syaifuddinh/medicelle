app.controller('medicalRecordCreate', ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope) {
    $scope.title = 'Form Rekam Medis';
    $scope.formData = {}
    $scope.data = {}
    $scope.disease_history = {}
    $scope.family_disease_history = {}
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');
    $http.get(baseUrl + '/controller/registration/medical_record/' + id).then(function(data) {
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
    });


  $scope.submitDiseaseHistory = function() {
      disease_history_datatable.row.add($scope.disease_history).draw()
      $scope.disease_history = {}
  }

  $scope.submitFamilyDiseaseHistory = function() {
      family_disease_history_datatable.row.add($scope.family_disease_history).draw()
      $scope.family_disease_history = {}
  }

  $http.get(baseUrl + '/controller/master/disease').then(function(data) {
    $scope.data.disease = data.data
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


  disease_history_datatable = $('#disease_history_datatable').DataTable({
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
    
  $scope.deleteDiseaseHistory = function(e) {
    var tr = $(e).parents('tr');
    disease_history_datatable.row(tr).remove().draw()
  }

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/registration/medical_record';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/registration/medical_record/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/medical_record'          
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