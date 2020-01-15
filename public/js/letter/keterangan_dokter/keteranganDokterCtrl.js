app.controller('keteranganDokter', ['$scope', '$compile', '$http', function($scope, $compile, $http) {
  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    order : [[0, 'desc']],
    ajax: {
      url : baseUrl+'/datatable/letter/keterangan_dokter',
      data : x => Object.assign(x, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Surat Keterangan Dokter - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Surat Keterangan Dokter'
      },
    ],

    columns:[
      {
        data:null, 
        name:"code",
        render : resp => "<a class='font-weight-bold' href='" + baseUrl + "/surat/keterangan_dokter/" + resp.id +  "'>" + resp.code + "</a>"
      },
      {data:"medical_record.code", name:"medical_record.code"},
      {data:"medical_record.patient.name", name:"medical_record.patient.name"},
      {data:"medical_record.patient.address", name:"medical_record.patient.address"},
      {data:"doctor.name", name:"doctor.name"},
      {data:"doctor.specialization.name", name:"doctor.specialization.name"},
      
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => 
        "<div class='btn-group'>" + 
        "<a class='btn btn-xs btn-danger' allow_destroy_keterangan_dokter ng-click='delete($event.currentTarget)' title='Hapus'><i class='fa fa-trash'></i></a>" +  
        "<a class='btn btn-xs btn-success' allow_edit_keterangan_dokter  href='" + baseUrl + "/surat/keterangan_dokter/edit/" + resp.id +  "' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-xs btn-default' href='" + baseUrl + "/surat/keterangan_dokter/" + resp.id +  "' allow_show_keterangan_dokter title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
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

  $scope.delete = function(e) {
    var tr, data, id;
    is_delete = confirm('Apakah anda ingin menghapus data ini ?');
    if(is_delete)
        tr = $(e).parents('tr')
        data = oTable.row(tr).data()
        id = data.id
        $http.delete(baseUrl + '/controller/letter/keterangan_dokter/' + id).then(function(data) {
            oTable.ajax.reload();
            toastr.success("Data Berhasil dihapus !");
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
          $http.put(baseUrl + '/controller/user/keteranganDokter/activate/' + id).then(function(data) {
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