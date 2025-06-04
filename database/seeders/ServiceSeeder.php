<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Serviços Gerais', 'description' => 'Categoria padrão para serviços'],
            ['name' => 'Limpeza', 'description' => 'Serviços de limpeza'],
            ['name' => 'Reparos', 'description' => 'Serviços de reparos gerais'],
            ['name' => 'Educação', 'description' => 'Serviços educacionais e aulas'],
            ['name' => 'Beleza', 'description' => 'Serviços de beleza, como cabeleireiro'],
            ['name' => 'Eletricista', 'description' => 'Serviços de eletricista'],
            ['name' => 'Encanador', 'description' => 'Serviços de encanamento'],
            ['name' => 'Hidráulico', 'description' => 'Serviços hidráulicos em geral'],
            ['name' => 'Jardinagem', 'description' => 'Serviços de jardinagem e paisagismo'],
            ['name' => 'Técnico em Ar-Condicionado', 'description' => 'Manutenção e instalação de ar-condicionado'],
            ['name' => 'Manutenção de Computadores', 'description' => 'Reparos e manutenção de equipamentos de informática'],
            ['name' => 'Serviços Automotivos', 'description' => 'Serviços relacionados a veículos e automóveis'],
            ['name' => 'Serviços de Transporte', 'description' => 'Mudanças, entregas e transportes variados'],
            ['name' => 'Consultoria', 'description' => 'Consultorias diversas para empresas e pessoas'],
            ['name' => 'Eventos', 'description' => 'Organização e serviços para eventos e festas'],
            ['name' => 'Saúde e Bem-estar', 'description' => 'Serviços relacionados à saúde, como massagem e personal trainer'],
        ];

        foreach ($categories as $category) {
            ServiceCategory::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
