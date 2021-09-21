app.controller('outgoingStock', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
  $scope.formData = {}
  $scope.data = {}
  var path = window.location.pathname;

  $scope.showTable = function() {
    var columns = [
          {
            data:null, 
            searchable : false,
            orderable: false,
            name:'date',
            render : x => $filter('fullDate')(x.date)
          },
          {
            data:'patient_name', 
            name:'contacts.name' 
          },
          {
            data:'rm_code', 
            name:'medical_records.code' 
          },
          {
            data:'reg_code', 
            name:'registrations.code' 
          },
          {
            data:'item_name', 
            name:'items.name' 
          },
          {
            data:'out_qty', 
            name:'invoice_details.qty' 
          }
    ]

    oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl + '/datatable/report/outgoing_stock',
      data : d => Object.assign(d, $scope.formData)
    },
    "order": [[0, "asc"]],
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Laporan Pengeluaran Barang - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Laporan Pengeluaran Barang'
      },
    ],

    'columns': columns,
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
        }
      });
    oTable.buttons().container().appendTo( '.export_button' );
  }

  $scope.showTable()

  $scope.filter = function() {
    oTable.ajax.reload();
  }


}]);