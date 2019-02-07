<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // name routes: index, show, edit. destroy

      //Roles
      Permission::create([
          'name'          => 'Navegar roles',
          'slug'          => 'roles.index',
          'description'   => 'Lista y navega todos los roles del sistema',
      ]);

      Permission::create([
          'name'          => 'Ver detalle de un rol',
          'slug'          => 'roles.show',
          'description'   => 'Ve en detalle cada rol del sistema',
      ]);

      Permission::create([
          'name'          => 'Creación de roles',
          'slug'          => 'roles.create',
          'description'   => 'Podría crear nuevos roles en el sistema',
      ]);

      Permission::create([
          'name'          => 'Edición de roles',
          'slug'          => 'roles.edit',
          'description'   => 'Podría editar cualquier dato de un rol del sistema',
      ]);

      Permission::create([
          'name'          => 'Eliminar roles',
          'slug'          => 'roles.destroy',
          'description'   => 'Podría eliminar cualquier rol del sistema',
      ]);

      Permission::create([
          'name'          => 'Creación de roles Request HTTP',
          'slug'          => 'roles.store',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de roles Request HTTP',
          'slug'          => 'roles.update',
          'description'   => '...',
      ]);

      // Clientes
      Permission::create([
          'name'          => 'Navegar Clientes',
          'slug'          => 'clients.index',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Ver detalle de Clientes',
          'slug'          => 'clients.show',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Clientes',
          'slug'          => 'clients.edit',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Eliminar Clientes',
          'slug'          => 'clients.destroy',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Clientes Request HTTP',
          'slug'          => 'clients.store',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Clientes Request HTTP',
          'slug'          => 'clients.update',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Clientes',
          'slug'          => 'clients.create',
          'description'   => '...',
      ]);

      // Funciones FRAME
      Permission::create([
          'name'          => 'Navegar Funciones FRAME',
          'slug'          => 'frame_functions.index',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Ver detalle de Funciones FRAME',
          'slug'          => 'frame_functions.show',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Funciones FRAME',
          'slug'          => 'frame_functions.edit',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Eliminar Funciones FRAME',
          'slug'          => 'frame_functions.destroy',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Funciones FRAME Request HTTP',
          'slug'          => 'frame_functions.store',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Funciones FRAME Request HTTP',
          'slug'          => 'frame_functions.update',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Funciones FRAME',
          'slug'          => 'frame_functions.create',
          'description'   => '...',
      ]);

      // Proyectos
      Permission::create([
          'name'          => 'Navegar Proyectos',
          'slug'          => 'projects.index',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Ver detalle de Proyectos',
          'slug'          => 'projects.show',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Proyectos',
          'slug'          => 'projects.edit',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Eliminar Proyectos',
          'slug'          => 'projects.destroy',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Proyectos Request HTTP',
          'slug'          => 'projects.store',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Proyectos Request HTTP',
          'slug'          => 'projects.update',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Proyectos',
          'slug'          => 'projects.create',
          'description'   => '...',
      ]);

      // Proveedores
      Permission::create([
          'name'          => 'Navegar Proveedores',
          'slug'          => 'providers.index',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Ver detalle de Proveedores',
          'slug'          => 'providers.show',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Proveedores',
          'slug'          => 'providers.edit',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Eliminar Proveedores',
          'slug'          => 'providers.destroy',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Proveedores Request HTTP',
          'slug'          => 'providers.store',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Proveedores Request HTTP',
          'slug'          => 'providers.update',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Proveedores',
          'slug'          => 'providers.create',
          'description'   => '...',
      ]);

      // Funciones SAT
      Permission::create([
          'name'          => 'Navegar Funciones SAT',
          'slug'          => 'sat_functions.index',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Ver detalle de Funciones SAT',
          'slug'          => 'sat_functions.show',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Funciones SAT',
          'slug'          => 'sat_functions.edit',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Eliminar Funciones SAT',
          'slug'          => 'sat_functions.destroy',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Funciones SAT Request HTTP',
          'slug'          => 'sat_functions.store',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Funciones SAT Request HTTP',
          'slug'          => 'sat_functions.update',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Funciones SAT',
          'slug'          => 'sat_functions.create',
          'description'   => '...',
      ]);

      // Categorias de Trabajos
      Permission::create([
          'name'          => 'Navegar Categorias de Trabajos',
          'slug'          => 'workers_categories.index',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Ver detalle de Categorias de Trabajos',
          'slug'          => 'workers_categories.show',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Categorias de Trabajos',
          'slug'          => 'workers_categories.edit',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Eliminar Categorias de Trabajos',
          'slug'          => 'workers_categories.destroy',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Categorias de Trabajos Request HTTP',
          'slug'          => 'workers_categories.store',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Categorias de Trabajos Request HTTP',
          'slug'          => 'workers_categories.update',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Categorias de Trabajos',
          'slug'          => 'workers_categories.create',
          'description'   => '...',
      ]);

      // Utilidades / Contratos
      Permission::create([
          'name'          => 'Navegar Utilidades / Contratos',
          'slug'          => 'contracts.index',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Ver detalle de Utilidades / Contratos',
          'slug'          => 'contracts.show',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Utilidades / Contratos',
          'slug'          => 'contracts.edit',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Eliminar Utilidades / Contratos',
          'slug'          => 'contracts.destroy',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Utilidades / Contratos Request HTTP',
          'slug'          => 'contracts.store',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Utilidades / Contratos Request HTTP',
          'slug'          => 'contracts.update',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Utilidades / Contratos',
          'slug'          => 'contracts.create',
          'description'   => '...',
      ]);

      // Utilidades / Paises
      Permission::create([
          'name'          => 'Navegar Utilidades / Paises',
          'slug'          => 'countries.index',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Ver detalle de Utilidades / Paises',
          'slug'          => 'countries.show',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Utilidades / Paises',
          'slug'          => 'countries.edit',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Eliminar Utilidades / Paises',
          'slug'          => 'countries.destroy',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Utilidades / Paises Request HTTP',
          'slug'          => 'countries.store',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Utilidades / Paises Request HTTP',
          'slug'          => 'countries.update',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Utilidades / Paises',
          'slug'          => 'countries.create',
          'description'   => '...',
      ]);

      // Utilidades / Categorias de Proyectos
      Permission::create([
          'name'          => 'Navegar Utilidades / Categorias de Proyectos',
          'slug'          => 'proyect_categories.index',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Ver detalle de Utilidades / Categorias de Proyectos',
          'slug'          => 'proyect_categories.show',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Utilidades / Categorias de Proyectos',
          'slug'          => 'proyect_categories.edit',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Eliminar Utilidades / Categorias de Proyectos',
          'slug'          => 'proyect_categories.destroy',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Utilidades / Categorias de Proyectos Request HTTP',
          'slug'          => 'proyect_categories.store',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Utilidades / Categorias de Proyectos Request HTTP',
          'slug'          => 'proyect_categories.update',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Utilidades / Categorias de Proyectos',
          'slug'          => 'proyect_categories.create',
          'description'   => '...',
      ]);

      // Utilidades / Niveles Educativos
      Permission::create([
          'name'          => 'Navegar Utilidades / Niveles Educativos',
          'slug'          => 'studies.index',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Ver detalle de Utilidades / Niveles Educativos',
          'slug'          => 'studies.show',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Utilidades / Niveles Educativos',
          'slug'          => 'studies.edit',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Eliminar Utilidades / Niveles Educativos',
          'slug'          => 'studies.destroy',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Utilidades / Niveles Educativos Request HTTP',
          'slug'          => 'studies.store',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Utilidades / Niveles Educativos Request HTTP',
          'slug'          => 'studies.update',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Utilidades / Niveles Educativos',
          'slug'          => 'studies.create',
          'description'   => '...',
      ]);

      // Utilidades / Jornadas de Trabajos
      Permission::create([
          'name'          => 'Navegar Utilidades / Jornadas de Trabajos',
          'slug'          => 'workdays.index',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Ver detalle de Utilidades / Jornadas de Trabajos',
          'slug'          => 'workdays.show',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Utilidades / Jornadas de Trabajos',
          'slug'          => 'workdays.edit',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Eliminar Utilidades / Jornadas de Trabajos',
          'slug'          => 'workdays.destroy',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Utilidades / Jornadas de Trabajos Request HTTP',
          'slug'          => 'workdays.store',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Edición de Utilidades / Jornadas de Trabajos Request HTTP',
          'slug'          => 'workdays.update',
          'description'   => '...',
      ]);

      Permission::create([
          'name'          => 'Creación de Utilidades / Jornadas de Trabajos',
          'slug'          => 'workdays.create',
          'description'   => '...',
      ]);

    }
}
