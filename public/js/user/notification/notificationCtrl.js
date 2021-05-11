app.controller('notification', ['$scope', '$compile', '$http', function($scope, $compile, $http) {
  $scope.data = {}
  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url : baseUrl+'/datatable/user/notification',
      data : x => Object.assign(x, $scope.formData)
    },
    
    columns:[
      {
        data:null, 
        name:"title",
        render : resp => '<div ng-click="readNotif($event.currentTarget)">' + resp.title + '</div>'
      },
      {
        data:null, 
        name:"description",
        render : resp => '<div ng-click="readNotif($event.currentTarget)">' + resp.description + '</div>'
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => resp.is_read == 1 ? '<label class="label label-success">Sudah Dibaca</label>' : '<label class="label label-danger">Belum Dibaca</label>'
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : function(resp) {
            var btn = ''
            btn += "<button  class='btn btn-xs btn-danger' ng-click='delete(" + resp.id + ")' title='Non-aktifkan'><i class='fa fa-trash-o'></i></button>"
            return btn
        }
      }
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menghapus data ini ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/user/notification/' + id).then(function(data) {
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

  $scope.filter = function() {
    oTable.ajax.reload()
  }

  $scope.readNotif = function(obj) {
        var tr = $(obj).parents('tr')
        var data = oTable.row(tr).data()
        $http.get(baseUrl + '/controller/user/notification/' + data.id).then(function(data) {
            var resp =  data.data
            location.href = resp.route_link
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