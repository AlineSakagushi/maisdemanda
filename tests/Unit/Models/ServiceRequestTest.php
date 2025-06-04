<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\ServiceRequest;
use App\Models\User;
use App\Models\Service;
use App\Models\ServiceOrder;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PHPUnit\Framework\Attributes\Test;

class ServiceRequestTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function is_expired_returns_true_when_expiration_date_is_past(): void
    {
        $expiredDate = Carbon::now()->subDays(1);
        $serviceRequest = ServiceRequest::factory()->make([
            'expiration_date' => $expiredDate,
        ]);

        $this->assertTrue($serviceRequest->isExpired());
    }

    #[Test]
    public function is_expired_returns_false_when_expiration_date_is_future(): void
    {
        $futureDate = Carbon::now()->addDays(7);
        $serviceRequest = ServiceRequest::factory()->make([
            'expiration_date' => $futureDate,
        ]);

        $this->assertFalse($serviceRequest->isExpired());
    }

    #[Test]
    public function is_expired_returns_false_when_expiration_date_is_null(): void
    {
        $serviceRequest = ServiceRequest::factory()->make([
            'expiration_date' => null,
        ]);

        $this->assertFalse($serviceRequest->isExpired());
    }

    #[Test]
    public function can_be_accepted_returns_true_when_status_is_open_and_not_expired(): void
    {
        $futureDate = Carbon::now()->addDays(7);
        $serviceRequest = ServiceRequest::factory()->make([
            'status' => 'open',
            'expiration_date' => $futureDate,
        ]);

        $this->assertTrue($serviceRequest->canBeAccepted());
    }

    #[Test]
    public function can_be_accepted_returns_false_when_status_is_not_open(): void
    {
        $futureDate = Carbon::now()->addDays(7);
        $serviceRequest = ServiceRequest::factory()->make([
            'status' => 'closed',
            'expiration_date' => $futureDate,
        ]);

        $this->assertFalse($serviceRequest->canBeAccepted());
    }

    #[Test]
    public function can_be_accepted_returns_false_when_expired(): void
    {
        $expiredDate = Carbon::now()->subDays(1);
        $serviceRequest = ServiceRequest::factory()->make([
            'status' => 'open',
            'expiration_date' => $expiredDate,
        ]);

        $this->assertFalse($serviceRequest->canBeAccepted());
    }

    #[Test]
    public function service_request_belongs_to_client_relationship(): void
    {
        $serviceRequest = new ServiceRequest();

        $this->assertInstanceOf(BelongsTo::class, $serviceRequest->client());
    }

    #[Test]
    public function service_request_belongs_to_service_relationship(): void
    {
        $serviceRequest = new ServiceRequest();

        $this->assertInstanceOf(BelongsTo::class, $serviceRequest->service());
    }

    #[Test]
    public function uses_correct_table_name(): void
    {
        $serviceRequest = new ServiceRequest();

        $this->assertEquals('service_requests', $serviceRequest->getTable());
    }

    #[Test]
    public function can_fill_allowed_attributes(): void
    {
        $requestData = [
            'client_id' => 1,
            'service_id' => 1,
            'title' => 'Limpeza urgente',
            'description' => 'Preciso de limpeza completa',
            'expected_budget' => 200.00,
            'urgency' => 'high',
            'status' => 'open',
        ];

        $serviceRequest = new ServiceRequest();
        $serviceRequest->fill($requestData);

        $this->assertEquals(1, $serviceRequest->client_id);
        $this->assertEquals(1, $serviceRequest->service_id);
        $this->assertEquals('Limpeza urgente', $serviceRequest->title);
        $this->assertEquals('Preciso de limpeza completa', $serviceRequest->description);
        $this->assertEquals(200.00, $serviceRequest->expected_budget);
        $this->assertEquals('high', $serviceRequest->urgency);
        $this->assertEquals('open', $serviceRequest->status);
    }

    #[Test]
    public function can_be_accepted_with_multiple_scenarios(): void
    {
        // Cenário 1: Pode ser aceito
        $validRequest = ServiceRequest::factory()->make([
            'status' => 'open',
            'expiration_date' => Carbon::now()->addDays(5),
        ]);
        $this->assertTrue($validRequest->canBeAccepted());

        // Cenário 2: Não pode ser aceito - status errado
        $wrongStatusRequest = ServiceRequest::factory()->make([
            'status' => 'in_negotiation',
            'expiration_date' => Carbon::now()->addDays(5),
        ]);
        $this->assertFalse($wrongStatusRequest->canBeAccepted());

        // Cenário 3: Não pode ser aceito - expirado
        $expiredRequest = ServiceRequest::factory()->make([
            'status' => 'open',
            'expiration_date' => Carbon::now()->subDays(1),
        ]);
        $this->assertFalse($expiredRequest->canBeAccepted());
    }
}
