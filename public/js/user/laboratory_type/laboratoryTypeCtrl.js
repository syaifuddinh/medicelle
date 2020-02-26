app.controller('laboratoryType', ['$scope', '$compile', '$http', function($scope, $compile, $http) {
  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl+'/datatable/user/laboratory_type',
      data : x => Object.assign(x, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Jenis Pemeriksaan Laboratorium - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Jenis Pemeriksaan Laboratorium'
      },
    ],

    columns:[
      {
        data:null, 
        orderable : false,
        searchable:false,
        render : resp => resp.description == 'laboratoryType1' ? 'Jenis Pemeriksaan Laboratorium 1' : 'Jenis Pemeriksaan Laboratorium 2'
      },
      {data:"name", name:"name"},
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
          resp.is_active == 1 ? "<button allow_destroy_laboratoryType class='btn btn-xs btn-danger' ng-click='delete(" + resp.id + ")' title='Non-aktifkan'><i class='fa fa-trash-o'></i></button>"
          : "<button class='btn btn-xs btn-primary' allow_activate_laboratoryType ng-click='activate(" + resp.id + ")' title='Aktifkan'><i class='fa fa-check'></i></button>"
        ) +
        "<a class='btn btn-xs btn-success' allow_edit_laboratoryType href='" + baseUrl + "/laboratory_type/edit/" + resp.id +  "' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-xs btn-default' allow_show_laboratoryType href='" + baseUrl + "/laboratory_type/" + resp.id +  "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  $scope.filter = function() {
    oTable.ajax.reload()
  }

  oTable.buttons().container().appendTo( '.export_button' );

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/user/laboratory_type/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/user/laboratory_type/activate/' + id).then(function(data) {
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