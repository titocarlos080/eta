<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use App\Models\RoleMenu;
use App\Models\Tematica;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        Tematica::factory()->create(['nombre' => 'Dia']);
        Tematica::factory()->create(['nombre' => 'Noche']);
        Tematica::factory()->create(['nombre' => 'Niño']);
        Tematica::factory()->create(['nombre' => 'Joven']);
        Tematica::factory()->create(['nombre' => 'Adulto']);
        // Top-level menu
        $usuarios = Menu::create(['name' => 'Gestión de Usuarios', 'icon' => 'fas fa-users', 'order' => 1, 'parent_id' => 0,]);
        $gestiones = Menu::create(['name' => 'Gestión de Gestiones', 'icon' => 'fas fa-calendar-alt', 'order' => 2, 'parent_id' => 0,]);
        $materias = Menu::create(['name' => 'Gestión de Materias', 'icon' => 'fas fa-book', 'order' => 3, 'parent_id' => 0,]);
        $carreras = Menu::create(['name' => 'Gestión de Carreras', 'icon' => 'fas fa-graduation-cap', 'order' => 4, 'parent_id' => 0,]);
        $ofertas = Menu::create(['name' => 'Gestión de Ofertas', 'icon' => 'fas fa-clipboard-list', 'order' => 5, 'parent_id' => 0,]);
        $inscripciones = Menu::create(['name' => 'Gestión de Inscripciones', 'icon' => 'fas fa-user-check', 'order' => 6, 'parent_id' => 0,]);
        $pagos = Menu::create(['name' => 'Gestión de Pagos', 'icon' => 'fas fa-money-bill-wave', 'order' => 7, 'parent_id' => 0,]);
        $reportes = Menu::create(['name' => 'Reportes y Estadísticas', 'icon' => 'fas fa-chart-bar', 'order' => 8, 'parent_id' => 0,]);
        $configuraciones = Menu::create(['name' => 'Configuración', 'icon' => 'fas fa-cog', 'order' => 9, 'parent_id' => 0,]);

        // Submenu items
        $this->createSubMenu($usuarios, 'Crear Usuario', 'usuarios/create', 'fas fa-user-plus');
        $this->createSubMenu($usuarios, 'Listar Usuarios', 'usuarios', 'fas fa-users');
        $this->createSubMenu($usuarios, 'Estudiantes', 'estudiantes', 'fas fa-user-graduate');
        $this->createSubMenu($usuarios, 'Docentes', 'docentes', 'fas fa-chalkboard-teacher');
        $this->createSubMenu($usuarios, 'Administrativos', 'administrativos', 'fas fa-user-tie');

        $this->createSubMenu($gestiones, 'Crear Gestión', 'gestiones/create', 'fas fa-calendar-plus');
        $this->createSubMenu($gestiones, 'Listar Gestiones', 'gestiones', 'fas fa-calendar-alt');

        $this->createSubMenu($materias, 'Crear Materia', 'materias/create', 'fas fa-book-medical');
        $this->createSubMenu($materias, 'Listar Materias', 'materias', 'fas fa-book');

        $this->createSubMenu($carreras, 'Crear Carrera', 'carreras/create', 'fas fa-graduation-cap');
        $this->createSubMenu($carreras, 'Listar Carreras', 'carreras', 'fas fa-list-alt');
        $this->createSubMenu($carreras, 'Niveles', 'niveles', 'fas fa-layer-group');
        $this->createSubMenu($carreras, 'Grupos', 'grupos', 'fas fa-users-cog');
        $this->createSubMenu($carreras, 'Horarios', 'horarios', 'fas fa-clock');

        $this->createSubMenu($ofertas, 'Crear Oferta', 'ofertas/create', 'fas fa-plus-square');
        $this->createSubMenu($ofertas, 'Listar Ofertas', 'ofertas', 'fas fa-th-list');

        $this->createSubMenu($inscripciones, 'Crear Inscripción', 'inscripciones/create', 'fas fa-clipboard-check');
        $this->createSubMenu($inscripciones, 'Listar Inscripciones', 'inscripciones', 'fas fa-clipboard-list');
        
        $this->createSubMenu($pagos, 'Crear Pago', 'pagos/create', 'fas fa-money-check-alt');
        $this->createSubMenu($pagos, 'Listar Pagos', 'pagos', 'fas fa-money-bill-wave');
        $this->createSubMenu($pagos, 'Pagar QR', 'pagos/qr', 'fas fa-qrcode');
        $this->createSubMenu($pagos, 'Pagos por QR', 'pagos/lista-qr', 'fas fa-file-invoice-dollar');
        
        $this->createSubMenu($reportes, 'Crear Reporte', 'reportes/create', 'fas fa-file-alt');
        $this->createSubMenu($reportes, 'Listar Reportes', 'reportes', 'fas fa-chart-line');
        $this->createSubMenu($reportes, 'Ver Estadísticas', 'estadisticas/estudiantes', 'fas fa-chart-pie');

        $this->createSubMenu($configuraciones, 'Permisos', 'permisos', 'fas fa-user-shield');
        $this->createSubMenu($configuraciones, 'Roles', 'roles', 'fas fa-user-tag');







        // 1. Create the admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(['nombre' => 'admin']);
        $adminRole2 = Role::firstOrCreate(['nombre' => 'docente']);
        $adminRole3 = Role::firstOrCreate(['nombre' => 'estudiante']);

        // 2. Get all menu IDs
        $menuIds = Menu::pluck('id')->toArray();

        foreach ($menuIds as $menuId) {
            RoleMenu::create([
                'role_id' => $adminRole->id,
                'menu_id' => $menuId,
            ]);
        }

        $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();

        DB::table('usuarios')->insert([
            [
                'name' => 'titocarlos',
                'email' => 'titocarlos080@gmail.com',
                'password' => Hash::make('123'),
                'password_reset' => null,
                'rol_id' => 1, // Asegúrate de que este rol exista
                'tematica_id' => 1, // Asegúrate de que esta temática exista

            ],

            [
                'name' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('password123'),
                'password_reset' => null,
                'rol_id' => 2, // Asegúrate de que este rol exista
                'tematica_id' => 2, // Asegúrate de que esta temática exista

            ],
            [
                'name' => 'Veronica Antezana',
                'email' => 'vero@gmail.com',
                'password' => Hash::make('1234'),
                'password_reset' => null,
                'rol_id' => 1, // Asegúrate de que este rol exista
                'tematica_id' => 2, // Asegúrate de que esta temática exista
                
            ],

            // Agrega más usuarios según sea necesario
        ]);
    }


    private function createSubMenu(Menu $parent, $name, $url, $icon)
    {
        Menu::create([
            'name' => $name,
            'url' => $url,
            'icon' => $icon,
            'parent_id' => $parent->id,
            'order' => Menu::where('parent_id', $parent->id)->max('order') + 1
        ]);
    }
}
