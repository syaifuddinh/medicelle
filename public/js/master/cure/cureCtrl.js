app.controller('cure', ['$scope', '$compile', '$http', function($scope, $compile, $http) {
  $scope.formData = {}
  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl+'/datatable/master/medical_item',
      data : x => Object.assign(x, $scope.formData)
    },
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'BMHP - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'BMHP'
      },
    ],

    columns:[
      {
        data:null, 
        name:'unique_code',
        render:resp => "<a href='" + baseUrl + "/medical_item/" + resp.id +  "' title='Detail'>" + resp.unique_code + "</a>"
      },
      {
        data:null, 
        name:"name",
        render:resp => "<a href='" + baseUrl + "/medical_item/" + resp.id +  "' title='Detail'>" + resp.name + "</a>"
      },
      {data:"group.name", name:"group.name"},
      {data:"price.grup_nota.slug", name:"price.grup_nota.slug"},
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
          resp.is_active == 1 ? "<button class='btn btn-xs btn-danger' allow_destroy_medical_item ng-click='delete(" + resp.id + ")' title='Non-aktifkan'><i class='fa fa-trash-o'></i></button>"
          : "<button class='btn btn-xs btn-primary' allow_activate_medical_item ng-click='activate(" + resp.id + ")' title='Aktifkan'><i class='fa fa-check'></i></button>"
        ) +
        "<a class='btn btn-xs btn-success' href='" + baseUrl + "/medical_item/edit/" + resp.id +  "' title='Edit' allow_edit_medical_item><i class='fa fa-pencil'></i></a><a class='btn btn-xs btn-default' allow_show_medical_item href='" + baseUrl + "/medical_item/" + resp.id +  "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
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
        $http.delete(baseUrl + '/controller/master/medical_item/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/master/cure/activate/' + id).then(function(data) {
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