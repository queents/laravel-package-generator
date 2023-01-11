<?php

namespace Queents\LaravelPackageGenerator\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Queents\ConsoleHelpers\Traits\HandleFiles;
use Queents\ConsoleHelpers\Traits\RunCommand;

class LaravelPackageGenerator extends Command
{
    use RunCommand;
    use HandleFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'package:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'use this command to generate package boilerplate';

    public function __construct()
    {
        parent::__construct();
        $this->publish = __DIR__ .'../../publish/';
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $packageName = null;
        while(empty($packageName)){
            $packageName = $this->ask("Enter your package name");
        }
        $packageVendor = null;
        while(empty($packageVendor)){
            $packageVendor =  $this->ask("Enter your package vendor name");
        }

        $packageDescription = $this->ask("Enter your package description");
        $packageAuthor = $this->ask("Enter your package author");
        $packageAuthorEmail = $this->ask("Enter your package author email");
        $packageConfig = $this->ask("Has Config file? (yes/no)");
        $packageRoute = $this->ask("Has Routes ? (yes/no)");
        $packageView = $this->ask("Has Views ? (yes/no)");
        $packageMigration = $this->ask("Has Migrations? (yes/no)");

        $this->info('Generating package boilerplate...');

        //create package directory
        if(!File::exists(base_path('packages'))){
            File::makeDirectory(base_path('packages'));
        }

        //Create vendor directory
        if(!File::exists(base_path('packages/'.$packageVendor))){
            File::makeDirectory(base_path('packages/'.$packageVendor));
        }

        //Build a package inside vendor directory
        $this->handelFile('config', base_path('packages'.$packageVendor), 'folder');
        $this->handelFile('database', base_path('packages'.$packageVendor), 'folder');
        $this->handelFile('resources', base_path('packages'.$packageVendor), 'folder');
        $this->handelFile('routes', base_path('packages'.$packageVendor), 'folder');
        $this->handelFile('src', base_path('packages'.$packageVendor), 'folder');
        $this->handelFile('tests', base_path('packages'.$packageVendor), 'folder');
        $this->handelFile('LICENSE.md', base_path('packages'.$packageVendor));


        $this->info('Package boilerplate generated successfully');
    }
}
