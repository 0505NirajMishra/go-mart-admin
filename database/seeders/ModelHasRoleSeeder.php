<?php

namespace Database\Seeders;
use App\Models\ModelHasRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $model_has_role=['role_id' => '1', 'model_type' => 'App\\Models\\User','model_id'=>'1'];
        ModelHasRole::create($model_has_role);
    }
}
