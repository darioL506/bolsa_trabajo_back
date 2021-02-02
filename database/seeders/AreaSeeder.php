<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['GS Enseñanza y Animación Socio Deportiva', 
        'GS Acondicionamiento Físico', 
        'GM Gestión Administrativa', 
        'GS Administración y Finanzas', 
        'GM Actividades Comerciales', 
        'GS Gestión de Ventas y Espacios Comerciales', 
        'GS Transporte y Logística', 
        'GM Mecanizado', 
        'GM Soldadura y Calderería', 
        'GS Construcciones Metálicas', 
        'GS Programación de la Producción en Fabricación Mecánica', 
        'GS Eficiencia Energética y Energía Solar Térmica', 
        'GM Sistemas Microinformáticos y Redes', 
        'GS Administración de Sistemas Informáticos en Red', 
        'GS Desarrollo de Aplicaciones Multiplataforma', 
        'GS Desarrollo de Aplicaciones Web', 
        'GS Sistemas Informáticos en Red (E-Learning)',
        'GM Instalaciones Frigoríficas y de Climatización',
        'GM Instalaciones de Producción de Calor'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
