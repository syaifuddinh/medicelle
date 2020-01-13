app.controller('employee', ['$scope', '$compile', '$http', function($scope, $compile, $http) {
  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    order : [[0, 'desc']],
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl+'/datatable/master/employee',
      data : x => Object.assign(x, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Karyawan - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Karyawan'
      },
    ],

    columns:[
      {
        data:null, 
        name:"code",
        render : function(resp){
            var url = '#'
            if(roles['allow_show_employee'] == 1) {
                url = baseUrl + "/employee/" + resp.id
            }
            return "<a class='' href='" + url +  "' title='Detail'>" + resp.code + "</a>" 
        } 
      },
      {
        data:null, 
        name:"name",
        render : function(resp){
            var url = '#'
            if(roles['allow_show_employee'] == 1) {
                url = baseUrl + "/employee/" + resp.id
            }
            return "<a class='' href='" + url +  "' title='Detail'>" + resp.name + "</a>" 
        }
      },
      {data:"pin", name:"pin"},
      {data:"group_user.name", name:"group_user.name"},
      {data:"city.name", name:"city.name"},
      {data:"phone", name:"phone"},
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => resp.is_active == 1 ? '<label class="label label-success">Aktif</label>' : '<label class="label label-danger">Tidak Aktif</label>'
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => 
        "<div class='btn-group'>" + 
        ( 
          resp.is_active == 1 ? "<button allow_destroy_employee class='btn btn-xs btn-danger' ng-click='delete(" + resp.id + ")' title='Non-aktifkan'><i class='fa fa-trash-o'></i></button>"
          : "<button class='btn btn-xs btn-primary' allow_activate_employee ng-click='activate(" + resp.id + ")' title='Aktifkan'><i class='fa fa-check'></i></button>"
        ) +
        "<a allow_edit_employee class='btn btn-xs btn-success' href='" + baseUrl + "/employee/edit/" + resp.id +  "' title='Edit'><i class='fa fa-pencil'></i></a><a allow_show_employee class='btn btn-xs btn-default' href='" + baseUrl + "/employee/" + resp.id +  "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
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
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/master/employee/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/master/employee/activate/' + id).then(function(data) {
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