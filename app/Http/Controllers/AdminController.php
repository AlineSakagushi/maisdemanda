<?php

namespace App\Http\Controllers;

use App\Models\DashboardGrowth;
use App\Models\User;
use App\Models\ServiceRequest;
use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\DashboardSummary;
use App\Models\UserTypeTotals;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        // Estatísticas gerais

        $summary = DashboardSummary::first();

        $totalUsers = $summary->total_users;
        $totalClients = $summary->total_clients;
        $totalProfessionals = $summary->total_professionals;
        $totalServiceRequests = $summary->total_service_requests;
        
        // Dados financeiros
        $growth = DashboardGrowth::first();

        $totalGuardedMoney = $growth->total_available_balance;
        $monthlyEarnings = [
            'current_month' => $growth->current_month,
            'last_month' => $growth->last_month,
            'growth_percentage' => $growth->growth_percentage
        ];
        
        // Dados para gráficos
        $servicesPerMonth = $this->getServicesPerMonth();
        $professionalsRegistered = $this->getProfessionalsRegistered();


        $totals = UserTypeTotals::first();
        
        $recentClients = $totals->total_clients;
        $recentProfessionals = $totals->total_professionals;
        

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalClients', 
            'totalProfessionals',
            'totalServiceRequests',
            'totalGuardedMoney',
            'monthlyEarnings',
            'servicesPerMonth',
            'professionalsRegistered',
            'recentClients',
            'recentProfessionals'
        ));
    }

    /**
     * Display users management page.
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users', compact('users'));
    }

    /**
     * Display service requests management page.
     */
    public function serviceRequests()
    {
        $serviceRequests = ServiceRequest::with(['client', 'service'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.service-requests', compact('serviceRequests'));
    }

    /**
     * Display financial reports.
     */
    public function reports()
    {
        $monthlyRevenue = $this->getMonthlyRevenue();
        $categoryStats = $this->getCategoryStats();
        $userGrowth = $this->getUserGrowth();
        
        return view('admin.reports', compact(
            'monthlyRevenue',
            'categoryStats', 
            'userGrowth'
        ));
    }

    /**
     * Update user status.
     */
    public function updateUserStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:Active,Inactive,Pending'
        ]);

        $user->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status do usuário atualizado com sucesso!');
    }

    /**
     * Delete user.
     */
    public function deleteUser(User $user)
    {
        // Não permitir deletar outros admins
        if ($user->user_type === 'Admin' && $user->id !== auth()->id()) {
            return redirect()->back()->with('error', 'Não é possível deletar outros administradores.');
        }

        $user->delete();
        
        return redirect()->back()->with('success', 'Usuário deletado com sucesso!');
    }

    // Métodos auxiliares para estatísticas

    private function getMonthlyEarnings()
    {
        // Simulação de ganhos mensais - adapte conforme sua lógica de negócio
        return [
            'current_month' => 27126.67,
            'last_month' => 24500.00,
            'growth_percentage' => 10.7
        ];
    }

    private function getServicesPerMonth()
    {
        return ServiceRequest::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                $monthNames = [
                    1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr',
                    5 => 'Mai', 6 => 'Jun', 7 => 'Jul', 8 => 'Ago',
                    9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez'
                ];
                return [$monthNames[$item->month] => $item->count];
            });
    }

    private function getProfessionalsRegistered()
    {
        return [
            'Veterinario' => 47,
            'Pedreiro' => 42,
            'Jardineiro' => 16,
            'Dentista' => 15,
            'Cabelereiro' => 8
        ];
    }

    private function getMonthlyRevenue()
    {
        // Implementar lógica de receita mensal
        return collect([
            ['month' => 'Jan', 'revenue' => 45000],
            ['month' => 'Fev', 'revenue' => 52000],
            ['month' => 'Mar', 'revenue' => 48000],
            ['month' => 'Abr', 'revenue' => 56000],
        ]);
    }

    private function getCategoryStats()
    {
        return ServiceCategory::withCount('services')->get();
    }

    private function getUserGrowth()
    {
        return User::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }
}