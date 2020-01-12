app.controller('registration', ['$scope', '$compile', '$http', '$filter', function($scope, $compile, $http, $filter) {
  var currentDate = new Date()
  var date = currentDate.getFullYear() + '-' + ( currentDate.getMonth() + 1 ).toString().padStart(2, 0) + '-' + currentDate.getDate().toString().padStart(2, 0)
  $scope.formData = {
      'date_start' : date, 
      'date_end' : date 
  }
  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl+'/datatable/registration/registration',
      data : x => Object.assign(x, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Registrasi - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Registrasi'
      },
    ],

    columns:[
      {
        data:null,
        name:'code',
        render: function(resp) {
            var url = '#';
            if(roles['allow_show_registration'] == 1) {
                url = baseUrl + "/registration/" + resp.id
            }
            return "<a href='" + url +  "'>" + resp.code + "</a>"
        } 
      },
      {data:"medical_record.code", name:"medical_record.code", orderable:false, searchable:false},
      {
        data:null, 
        searchable:false,
        orderable:false,
        render:resp => $filter('fullDate')(resp.date),
      },
      {
        data:null, 
        name:"patient.name", 
        render: function(resp) {
          var url = '#';
          if(roles['allow_show_patient'] == 1) {
              url = baseUrl + "/patient/" + resp.patient_id
          }
          return "<a href='" + url +  "'>" + resp.patient.name + "</a>"
        } 
      },
      {data:"patient.phone", name:"patient.phone", orderable:false, searchable:false},
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : function(resp) {
          var className;
          if(resp.status == 1) {
            className = 'default';
          } else if(resp.status == 2) {
            className = 'success';
          } else if(resp.status == 3) {
            className = 'danger';
          }
          return "<span class='label label-" + className + "'>" + resp.status_name + "</span>";
        },
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => 
        "<div class='btn-group'>" + 
        ( 
          resp.status == 1 ? "<button class='btn btn-xs btn-danger' allow_destroy_registration ng-click='delete(" + resp.id + ")' title='Batalkan'><i class='fa fa-trash-o'></i></button><button class='btn btn-xs btn-primary' allow_attend_registration ng-click='attend(" + resp.id + ")' title='Hadir'><i class='fa fa-check'></i></button><a allow_edit_registration class='btn btn-xs btn-success' href='" + baseUrl + "/registration/edit/" + resp.id +  "' title='Edit'><i class='fa fa-pencil'></i></a>"
          : ""
        ) +
        "<a allow_show_registration class='btn btn-xs btn-default' href='" + baseUrl + "/registration/" + resp.id +  "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );
  
  $scope.filter = function() {
    is_date = /\d+-\d+-\d+/
    if(is_date.test($scope.formData.date_start) && is_date.test($scope.formData.date_end)  || !$scope.formData.date_end || !$scope.formData.date_start) {
      
      oTable.ajax.reload()
    }
  }
  // $scope.filter()

  $scope.delete = function(id) {
    is_delete = confirm('Apakah registrasi pasien ini dibatalkan ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/registration/registration/' + id).then(function(data) {
            oTable.ajax.reload();
            toastr.success("Pasien dibatalkan !");
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

  $scope.attend = function(id) {
    is_activate = confirm('Pasien sudah hadir ?');
      if(is_activate)
          $http.put(baseUrl + '/controller/registration/registration/attend/' + id).then(function(data) {
              toastr.success("Kehadiran pasien berhasil disetujui !");
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