app.controller('lokasi', ['$scope', '$compile', '$http', function($scope, $compile, $http) {
  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl+'/datatable/master/lokasi'
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Lokasi - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Lokasi'
      },
    ],

    columns:[
      {
        data:null, 
        name:"name",
        render : resp => "<a class='' href='" + baseUrl + "/lokasi/edit/" + resp.id +  "' title='Edit'>" + resp.name + "</a>"
      },
      {data:"description", name:"description"},
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
          resp.is_active == 1 ? "<button class='btn btn-xs btn-danger' allow_destroy_lokasi ng-click='delete(" + resp.id + ")' title='Non-aktifkan'><i class='fa fa-trash-o'></i></button>"
          : "<button class='btn btn-xs btn-primary' ng-click='activate(" + resp.id + ")' allow_activate_lokasi title='Aktifkan'><i class='fa fa-check'></i></button>"
        ) +
        "<a class='btn btn-xs btn-success' href='" + baseUrl + "/lokasi/edit/" + resp.id +  "' title='Edit'  allow_edit_lokasi><i class='fa fa-pencil'></i></a></div>"
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.showGudangFarmasi = function() {
      $http.get(baseUrl + '/controller/master/lokasi/gudang_farmasi').then(function(data) {
            $scope.gudang_farmasi_name = data.data.name
        }, function(error) {
            $scope.showGudangFarmasi()
      });
  }
  $scope.showGudangFarmasi()

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/master/lokasi/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/master/lokasi/activate/' + id).then(function(data) {
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