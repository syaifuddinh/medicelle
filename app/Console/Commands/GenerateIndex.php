<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use File;

class GenerateIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate halaman index di tiap fitur';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
       
        $features = config('app.features');
        foreach($features as $x) {
            foreach($x['child'] as $y) {
                $page = '
                <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="list-group mb-2" ng-show="isFilter">
                    <div class="list-group-item">
                        FilterFields
                        <div class="form-group row">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info" ng-click="filterData()">Cari</button>
                                <button type="button" class="btn btn-warning" ng-click="resetData()">Reset</button>
                            </div>
                        </div>      
                    </div>
                </div>
                <div class="d-md-flex align-items-center">
                                    <div class="ml-auto d-flex no-block align-items-center">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary" ng-click="isFilter = !isFilter">Filter</button>
                                            <a class="btn btn-info" href="{{ url(\'\') }}/InsertURL">Tambah</a>
                                        </div>
                                        
                                    </div>
                                </div>
                <div class="table-responsive mt-2">
                    <table id="datatable" class="table table-striped table-bordered display">
                        <thead>
                            <tr>
                                TitleColumn
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
                ';   
                // Generate filter
                $filter_fields = "";
                if(array_key_exists('index', $y)) {

                    if(array_key_exists('filter', $y['index'])) {

                        foreach ($y['index']['filter'] as $filter) {
                            # code...
                            $filter_column = preg_replace('/_/', ' ', $filter['column']);
                            $filter_column = ucwords($filter_column);
                            if( preg_match('/date/', $filter['column']) == true ) {
                                $filter_fields .= '
                                <div class="form-group row">
                                        <label class="col-md-2 control-label text-right">' . $filter_column . '</label> 
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control" ng-model="formData.' . $filter['column'] . '_start" datepick>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">S/D</div>
                                                </div>
                                                <input type="text" class="form-control" ng-model="formData.' . $filter['column'] . '_end" datepick>
                                            </div>
                                        </div>
                                </div>';
                            }
                            else if( preg_match('/id_/', $filter['column']) == true) {
                                $filter_column = preg_replace('/_/', ' ', $filter['column']);
                                $nickname = preg_replace('/id_/', '', $filter['column']);
                                $table = 'master_' . $nickname;
                                $column = $nickname . '_name';
                                $filter_column = str_replace('id ', '', $filter_column);
                                $filter_column .= ' name';
                                $filter_column  = ucwords($filter_column);
                                $filter_fields .= '<div class="form-group row">
                                        <label class="col-md-2 control-label text-right">' . $filter_column . '</label> 
                                        <div class="col-md-8">
                                            <select name="" id="" ng-model="formData.id_' . $nickname . '" class="select2" ng-options="s.id_' . $nickname . ' as s.' . $nickname . '_name for s in data.' . $table . '">
                                            </select>
                                        </div>
                                </div>';
                            }
                            else if( preg_match('/status/', $filter['column']) == true AND array_key_exists('value', $filter)) {
                                $option_list = '';
                                foreach($filter['value'] as $z) {
                                    $option_list .= "<option value='" . $z['id'] . "'>" . $z['name'] . "</option>";
                                }
                                $status_container = '<div class="form-group row">
                                        <label class="col-md-2 control-label text-right">' . $filter_column . '</label> 
                                        <div class="col-md-8">
                                            <select name="" id="" ng-model="formData.' . $filter['column'] . '" class="select2" style="">
                                                OptionList
                                            </select>
                                        </div>
                                </div>';
                                $status_container = str_replace('OptionList', $option_list, $status_container);
                                $filter_fields .= $status_container;
                            }
                        }
                    }

                    // Generate judul kolom
                    $title_column = '';
                    foreach ($y['index']['column'] as $column) {
                        if( preg_match('/id_(.+)/', $column) == true ) {
                            $nickname = str_replace('id_', '', $column);
                            $nickname = str_replace('_', ' ', $nickname);
                        }
                        else {

                            $nickname = str_replace('_', ' ', $column);
                        }
                        $title_column .= "<th>$nickname</th>";
                    }

                    // Generate url untuk form tambah
                    $insert_url = $x['slug'] . '/' . $y['slug'] . '/create';

                    $page = str_replace('FilterFields', $filter_fields, $page);
                    $page = str_replace('TitleColumn', $title_column, $page);
                    $page = str_replace('InsertURL', $insert_url, $page);


                    $path = 'resources/views/' . $x['slug'] . '/' . $y['slug'] . '/index.blade.php';
                    $this->createDir($path);
                    File::put($path, $page);
                }
            }
        }
    }

    public function createDir($path)
    {
        $dir = dirname($path);

        if (!file_exists($dir))
        {
            mkdir($dir, 0777, true);
        }
    }
}
