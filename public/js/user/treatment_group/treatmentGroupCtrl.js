app.controller('treatmentGroup', ['$scope', '$compile', '$http', '$filter', function($scope, $compile, $http, $filter) {
  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl+'/datatable/user/treatment_group',
      data : x => Object.assign(x, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Paket Tindakan - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Paket Tindakan'
      },
    ],

    columns:[
      {data:"grup_nota.slug", name:"grup_nota.slug"},
      {data:"item.name", name:"item.name"},
      {
        data:null, 
        name:"item.price",
        className : 'text-right',
        render:resp => $filter('number')(resp.item.price)
      },
     
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
          resp.is_active == 1 ? "<button allow_destroy_treatment_group class='btn btn-xs btn-danger' ng-click='delete(" + resp.id + ")' title='Non-aktifkan'><i class='fa fa-trash-o'></i></button>"
          : "<button allow_activate_treatment_group class='btn btn-xs btn-primary' ng-click='activate(" + resp.id + ")' title='Aktifkan'><i class='fa fa-check'></i></button>"
        ) +
        "<a allow_edit_treatment_group class='btn btn-xs btn-success' href='" + baseUrl + "/treatment_group/edit/" + resp.id +  "' title='Edit'><i class='fa fa-pencil'></i></a><a allow_show_treatment_group class='btn btn-xs btn-default' href='" + baseUrl + "/treatment_group/" + resp.id +  "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
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
        $http.delete(baseUrl + '/controller/user/treatment_group/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/user/treatment_group/activate/' + id).then(function(data) {
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