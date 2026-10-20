<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Replaces the abandoned caffeinated/shinobi tables with spatie/laravel-permission.
 *
 * Existing `roles` / `permissions` tables (shinobi) are kept and extended with
 * `guard_name`; their pivots are copied into the spatie pivots. The legacy
 * `role_user` table stays because App\RoleUser still reads it.
 */
return new class extends Migration
{
    public function up(): void
    {
        $guard = config('auth.defaults.guard', 'web');

        foreach (['roles', 'permissions'] as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName, $guard) {
                    if (! Schema::hasColumn($tableName, 'guard_name')) {
                        $table->string('guard_name')->default($guard);
                    }
                });
            } else {
                Schema::create($tableName, function (Blueprint $table) use ($tableName) {
                    $table->bigIncrements('id');
                    $table->string('name');
                    $table->string('slug')->nullable();
                    $table->string('description')->nullable();
                    if ($tableName === 'roles') {
                        $table->string('special')->nullable();
                    }
                    $table->string('guard_name');
                    $table->timestamps();
                    $table->unique(['name', 'guard_name']);
                });
            }
        }

        if (! Schema::hasTable('role_user')) {
            Schema::create('role_user', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('role_id');
                $table->unsignedBigInteger('user_id');
                $table->timestamps();
            });
        }

        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->index(['model_id', 'model_type'], 'model_has_permissions_model_id_model_type_index');
            $table->primary(['permission_id', 'model_id', 'model_type'], 'model_has_permissions_permission_model_type_primary');
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->index(['model_id', 'model_type'], 'model_has_roles_model_id_model_type_index');
            $table->primary(['role_id', 'model_id', 'model_type'], 'model_has_roles_role_model_type_primary');
        });

        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');
            $table->primary(['permission_id', 'role_id'], 'role_has_permissions_permission_id_role_id_primary');
        });

        if (Schema::hasTable('permission_role')) {
            DB::table('permission_role')->get()->each(fn ($row) => DB::table('role_has_permissions')->insertOrIgnore([
                'permission_id' => $row->permission_id,
                'role_id' => $row->role_id,
            ]));
        }

        if (Schema::hasTable('role_user')) {
            DB::table('role_user')->where('role_id', '>', 0)->get()->each(fn ($row) => DB::table('model_has_roles')->insertOrIgnore([
                'role_id' => $row->role_id,
                'model_type' => 'App\\User',
                'model_id' => $row->user_id,
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('model_has_permissions');
    }
};
