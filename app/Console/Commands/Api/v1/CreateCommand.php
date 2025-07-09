<?php

namespace App\Console\Commands\Api\v1;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create differents features';

    /**
     * 
     * @var array
     */
    private $featureOptions = [
        'Controller' => 'controller',
        'Model' => 'model',
        'Form Request' => 'request',
        'Middleware' => 'middleware',
        'Event' => 'event',
        'Listener' => 'listener',
        'Enum' => 'enum',
        'Job' => 'job',
        'Resource' => 'resource',
        'Migration' => 'migration',
        'Interface' => 'interface',
        'Class' => 'class',
        'Service' => 'class',
        'Repository' => 'class',
    ];

    /**
     * 
     * @return array|string
     */
    private function getApiVersion()
    {
        $apiVersion = $this->choice('Choose a version', [
            'v1'
        ], 0);
        return $apiVersion;
    }

    /**
     * 
     * @return array|string
     */
    private function getFeature()
    {
        $feature = $this->choice('Choose a feature', [
            'Class',
            'Controller',
            'Enum',
            'Event',
            'Form Request',
            'Interface',
            'Job',
            'Listener',
            'Model',
            'Middleware',
            'Repository',
            'Resource',
            'Service',
            'Other',
        ], 0);

        return $feature;
    }

    /**
     * 
     * @param mixed $option
     * @param mixed $fileName
     * @param mixed $apiVersion
     * @return string
     */
    private function createPathName($option, $fileName, $apiVersion)
    {
        $folderFeature = $this->featureOptions[$option];
        $fullPathName = "";

        if ($folderFeature == "class") {
            $folderFeature = match ($option) {
                'Class' => 'Classes',
                'Service' => 'Services',
                'Repository' => 'Repositories',
                'Enum' => 'Enums',
            };
            $fullPathName .= "App/$folderFeature/";
        }
        $fullPathName .= "Api/$apiVersion/$fileName.php";

        return $fullPathName;
    }

    private function getFileName()
    {
        $fileName = $this->ask('Write a name:');

        if (empty($fileName)) {
            $this->printMessage("Name can't be empty");
        }

        return $fileName;
    }

    private function getConsoleOptions()
    {
        $options = $this->ask('Add options:');
        return $options;
    }

    private function printMessage(string $message)
    {
        echo $message;
    }

    /**
     * 
     * @return void
     */
    public function handle()
    {
        // getApiVersion
        $apiVersion = $this->getApiVersion();

        // getFeature
        $featureOption = $this->getFeature();

        // getFileName
        $fileName = $this->getFileName();

        // getFileName
        // $options = $this->getConsoleOptions();

        // createPathName
        $fullPathName = $this->createPathName($featureOption, $fileName, $apiVersion);

        $this->makeFeature($featureOption, $fullPathName, empty($options) ? null : $options);
    }

    /**
     * 
     * @param mixed $option
     * @param mixed $name
     * @return void
     */
    private function makeFeature($featureOption, $name, $options)
    {
        $featureName = $this->featureOptions[$featureOption];

        // $args = ['name' => $name, '--option' => $options ?? ''];
        $args = ['name' => $name];

        // var_dump($args);

        $this->call("make:$featureName", $args);
    }
}
