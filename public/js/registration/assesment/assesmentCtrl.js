app.controller('assesment', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
  $scope.formData = {}
  var path = window.location.pathname;
  patient_id = path.replace(/.+\/(\d+)\/patient.*/, '$1');

  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl+'/datatable/registration/assesment/' + patient_id,
      data : d => Object.assign(d, $scope.formData)
    },

    columns:[
      {
        data:null, 
        orderable:false,
        searchable:false,
        width : '45mm',
        render:resp => $filter('fullDate')(resp.date)
      },
      {data:"main_complaint", name:"main_complaint", orderable:false},
      {data:"nurse.name", name:"nurse.name", orderable:false, searchable:false},
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => 
        "<div class='btn-group'>" + 
        "<a allow_update_assesment class='btn btn-xs btn-success' href='" + baseUrl + "/assesment/step/1/edit/" + resp.id +  "' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-xs btn-default' href='" + baseUrl + "/assesment/step/1/show/" + resp.id +  "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.filter = function() {
    oTable.ajax.reload();
  }

  $scope.patient = function() {
        $http.get(baseUrl + '/controller/master/patient/' + patient_id).then(function(data) {
                $scope.patient = data.data
                
            }, function(error) {
              $rootScope.disBtn=false;
              if (error.status==422) {
                var det="";
                angular.forEach(error.data.errors,function(val,i) {
                  det+="- "+val+"<br>";
                });
                toastr.warning(det,error.data.message);
              } else {
                $scope.patient()
                toastr.error(error.data.message,"Error Has Found !");
              }
        });
    }
    $scope.patient()

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/registration/assesment/' + id).then(function(data) {
            oTable.ajax.reload();
            toastr.success("Data Berhasil dinon-aktifkan !");
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
          $http.put(baseUrl + '/controller/registration/assesment/activate/' + id).then(function(data) {
              toastr.success("Data Berhasil diaktifkan !");
              oTable.ajax.reload();
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