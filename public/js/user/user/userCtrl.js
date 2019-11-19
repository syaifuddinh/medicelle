app.controller('user', ['$scope', '$compile', '$http', function($scope, $compile, $http) {
  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl+'/datatable/user/user'
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'User - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'User'
      },
    ],

    columns:[
      {data:"code", name:"code"},
      {data:"name", name:"name"},
      {data:"group_user.name", name:"group_user.name"},
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
        render : resp => "<div class='btn-group'><button class='btn btn-xs btn-danger' ng-click='delete(" + resp.id + ")' title='Non-aktifkan'><i class='fa fa-trash-o'></i></button><a class='btn btn-xs btn-success' href='" + baseUrl + "/group_user/edit/" + resp.id +  "' title='Edit'><i class='fa fa-pencil'></i></a></div>"
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menghapus data ini ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/user/group_user/' + id).then(function(data) {
            oTable.ajax.reload();
            toastr.success("Data Berhasil Dihapus !");
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