<?php namespace Config;
class OrmExtension {
    public static $modelNamespace = ['App\Models\\'];
    public static $entityNamespace = ['App\Entities\\'];

    /*
     * Provide Namespace for Xamarin models folder
     */
    public $xamarinModelsNamespace          = 'App.Models';
    public $xamarinBaseModelNamespace       = 'App.Models';
}