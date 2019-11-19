<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class MakeViewCommand extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new blade template.';

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
        $features = config('app.features');
        foreach($features as $head) {
            foreach ($head['child'] as $body) {
                # code...
                $pages = ['index', 'create', 'edit', 'show'];
                foreach ($pages as $page) {
                    # code...
                    $view = $head['slug'] . '/' . $body['slug'] . '/' . $page;
                    $path = $this->viewPath($view);
                    $this->createDir($path);

                    if (File::exists($path))
                    {
                        $this->info("File {$path} sudah ada. Silahkan diperiksa");
                    }
                    else {

                        File::put($path, $path);

                        $this->info("File {$path} created.");
                    }
                }
                $path = $this->viewPath($view);

            }
        }

    }

     /**
     * Get the view full path.
     *
     * @param string $view
     *
     * @return string
     */
    public function viewPath($view)
    {
        $view = str_replace('.', '/', $view) . '.blade.php';

        $path = "resources/views/{$view}";

        return $path;
    }

    /**
     * Create view directory if not exists.
     *
     * @param $path
     */
    public function createDir($path)
    {
        $dir = dirname($path);

        if (!file_exists($dir))
        {
            mkdir($dir, 0777, true);
        }
    }
}
