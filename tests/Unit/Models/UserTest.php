<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\ServiceOrder;
use App\Models\Evaluation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function is_client_returns_true_when_user_type_is_client()
    {
        $user = User::factory()->make(['user_type' => 'Client']);
        $this->assertTrue($user->isClient());
    }

    #[Test]
    public function is_professional_returns_true_when_user_type_is_professional()
    {
        $user = User::factory()->make(['user_type' => 'Professional']);
        $this->assertTrue($user->isProfessional());
    }

    #[Test]
    public function is_admin_returns_true_when_user_type_is_admin()
    {
        $user = User::factory()->make(['user_type' => 'Admin']);
        $this->assertTrue($user->isAdmin());
    }

    #[Test]
    public function user_has_many_service_requests_as_client()
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(HasMany::class, $user->serviceRequestsAsClient());
    }

    #[Test]
    public function user_has_many_services()
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(HasMany::class, $user->services());
    }

}
