<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\ServiceOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function is_active_returns_true_when_status_is_active()
    {
        $service = Service::factory()->make(['status' => 'active']);
        $this->assertTrue($service->isActive());
    }

    #[Test]
    public function is_active_returns_false_when_status_is_inactive()
    {
        $service = Service::factory()->make(['status' => 'active']);
        $this->assertFalse($service->isActive());
    }

    #[Test]
    public function formatted_price_returns_correct_brazilian_format()
    {
        $service = Service::factory()->make(['price' => 150.75]);
        $this->assertEquals('R$ 150,75', $service->formattedPrice());
    }

    #[Test]
    public function formatted_price_with_zero_value()
    {
        $service = Service::factory()->make(['price' => 0]);
        $this->assertEquals('R$ 0,00', $service->formattedPrice());
    }

    #[Test]
    public function formatted_duration_returns_hours_and_minutes()
    {
        $service = Service::factory()->make(['estimated_duration' => 125]);
        $this->assertEquals('2h 5min', $service->formattedDuration());
    }

    #[Test]
    public function formatted_duration_returns_only_hours()
    {
        $service = Service::factory()->make(['estimated_duration' => 120]);
        $this->assertEquals('2h ', $service->formattedDuration());
    }

    #[Test]
    public function formatted_duration_returns_only_minutes()
    {
        $service = Service::factory()->make(['estimated_duration' => 45]);
        $this->assertEquals('45min', $service->formattedDuration());
    }

    #[Test]
    public function formatted_duration_returns_not_informed_when_null()
    {
        $service = Service::factory()->make(['estimated_duration' => null]);
        $this->assertEquals('Não informado', $service->formattedDuration());
    }

    #[Test]
    public function service_has_many_requests_relationship()
    {
        $service = new Service();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $service->requests());
    }

    #[Test]
    public function uses_correct_table_name()
    {
        $service = new Service();
        $this->assertEquals('services', $service->getTable());
    }

    #[Test]
    public function can_fill_allowed_attributes()
    {
        $serviceData = [
            'name' => 'Limpeza Residencial',
            'description' => 'Serviço completo de limpeza',
            'price' => 150.00,
            'estimated_duration' => 180,
            'status' => 'active'
        ];

        $service = new Service();
        $service->fill($serviceData);

        $this->assertEquals('Limpeza Residencial', $service->name);
        $this->assertEquals('Serviço completo de limpeza', $service->description);
        $this->assertEquals(150.00, $service->price);
        $this->assertEquals(180, $service->estimated_duration);
        $this->assertEquals('active', $service->status);
    }

    #[Test]
    public function fillable_attributes_are_correct()
    {
        $service = new Service();
        $expectedFillable = [
            'name',
            'description',
            'service_category_id',
            'price',
            'estimated_duration',
            'status',
        ];

        $this->assertEquals($expectedFillable, $service->getFillable());
    }
}
