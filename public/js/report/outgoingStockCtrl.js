app.controller('outgoingStock', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
  $scope.formData = {}
  $scope.data = {}
  var path = window.location.pathname;

  $scope.showTable = function() {
    var columns = [
          {
            data:null, 
            searchable : false,
            name:'date',
            render : x => $filter('fullDate')(x.date)
          },
          {
            data:'item_name', 
            name:'items.name' 
          },
          {
            data:'out_qty', 
            name:'out_qty' 
          },
          {
            data:'description', 
            name:'description'
          }
    ]

    oTable = $('#listview').DataTable({
    processing: true,
    order:[[0, 'desc']],
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl + '/datatable/report/outgoing_stock',
      data : d => Object.assign(d, $scope.formData)
    },
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