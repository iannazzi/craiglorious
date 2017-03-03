<?php

namespace Iannazzi\Generators\Models;

use App\Classes\Library\ArrayOperator;
use File;
use Iannazzi\Generators\BaseGenerator;
use Iannazzi\Generators\Migrations\SchemaGenerator;

class ModelGenerator extends BaseGenerator
{
   public function makeModelsFromExistingDatabase($dbc, $model_path, $map)
   {



       /*$this->removeFiles($model_path, $map, function ($name)
       {
           return self::getModelName($name);

       });*/

       foreach ($map['tables'] as $table => $table_map)
       {
           if (isset($map['tables'][ $table ]['make_model']))
           {
               //although this says continue, we are skipping this migration
               continue;
           }

           //skip pivot tables....
           $table_type = $map['tables'][ $table ]['type'];
           if($table_type == 'pivot') continue;

           $model_name = $this->getModelName($map['tables'][ $table ]['new_name']);
           $file_name = $model_path . '/'.$model_name . '.php';

           $this->deleteFile($file_name);

           $this->output->writeln('Creating Model File  ' . $model_name);

           $fields = $this->getFields($dbc,$table, $map);

           $contents['fillable'] = $this->getFillable($fields);



//           $schema = (new SchemaParser)->parseFields($fields);
//           $meta['action'] = 'create';
//           $meta['table'] = $table_name;
//           $schema = (new SyntaxBuilder)->create($schema, $meta);
//           $schema = $this->modifySchema($schema, $table_name);
//           $migration_name = 'create_' . $table_name . '_table';
//
           $this->makeModel($model_name, $model_path, $contents);
       }

   }
    protected function getFillable($fields)
    {
        $return_array = [];
        foreach($fields as $field)
        {
            if(is_array($field['field']))
            {
                continue;
            }
            if($field['type'] == 'increments')
            {
                continue;
            }
            $return_array[] = $field['field'];
        }
        return $return_array;

    }
    protected function makeModel($model_name, $model_path, $contents)
    {
        $model_filename = $model_path . '/' . $model_name . '.php';
        if ($this->files->exists($model_filename))
        {
            dd($model_filename . ' already exists!');
        }
        $this->makeDirectory($model_filename);

        $compileModelStub = $this->compileModelStub($model_path, $model_name, $contents);

        //dd($compileModelStub);

        $this->files->put($model_filename, $compileModelStub);

        $this->output->writeln($model_name . ' model created successfully.');
    }




    protected function compileModelStub($model_path, $model_name, $contents)
    {
        $stub = $this->files->get(__DIR__ . '/../stubs/model.stub');
        $this->replaceClassName($stub, $model_name)
            ->replaceFillable($stub, $contents['fillable'])
            ->replaceNamespace($stub, $model_path);

        return $stub;
    }

    protected function replaceNamespace(&$stub, $model_path)
    {
        $namespace = $this->getNamespace('App', $model_path);
        $stub = str_replace('{{namespace}}', $namespace, $stub);
        return $this;
    }
    protected function replaceClassName(&$stub, $model_name)
    {
        $stub = str_replace('{{class}}', $model_name, $stub);
        return $this;
    }
    protected function replaceFillable(&$stub, $fillable)
    {

        $fillable = ArrayOperator::exportArrayAsString($fillable);
        $stub = str_replace('{{fillable}}',$fillable, $stub);

        return $this;
    }
}