app.controller('registration', ['$scope', '$compile', '$http', '$filter', function($scope, $compile, $http, $filter) {
  var currentDate = new Date()
  var date = currentDate.getFullYear() + '-' + ( currentDate.getMonth() + 1 ) + '-' + currentDate.getDate()
  $scope.formData = {
      'date_end' : date 
  }
  setTimeout(function () {    
        $('[ng-model="formData.date_end"]').val( $filter('fullDate')($scope.formData.date_end))
  }, 300)
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
        render: resp => "<a href='" + baseUrl + "/registration/" + resp.id +  "'>" + resp.code + "</a>"
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
        render: resp => "<a href='" + baseUrl + "/patient/" + resp.patient_id +  "'>" + resp.patient.name + "</a>"
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
          resp.status == 1 ? "<button class='btn btn-xs btn-danger' ng-click='delete(" + resp.id + ")' title='Batalkan'><i class='fa fa-trash-o'></i></button><button class='btn btn-xs btn-primary' ng-click='attend(" + resp.id + ")' title='Hadir'><i class='fa fa-check'></i></button><a class='btn btn-xs btn-success' href='" + baseUrl + "/registration/edit/" + resp.id +  "' title='Edit'><i class='fa fa-pencil'></i></a>"
          : ""
        ) +
        "<a class='btn btn-xs btn-default' href='" + baseUrl + "/registration/" + resp.id +  "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.filter = function() {
    oTable.ajax.reload()
  }

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