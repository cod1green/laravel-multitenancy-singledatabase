<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, Group, Order, Permission, Plan, Product, Role, Table, Tenant, User};

class DashboardController extends Controller
{
    public function index()
    {
        $tenant = auth()->user();
        $totalUsers = User::where('tenant_id', $tenant->id)->count();

        $totalOrders = Order::count();
        $totalTables = Table::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalTenants = Tenant::count();
        $totalPlans = Plan::count();
        $totalRoles = Role::count();
        $totalGroups = Group::count();
        $totalPermissions = Permission::count();

        return view('admin.pages.dashboard.index', compact(
            'totalOrders',
            'totalUsers',
            'totalTables',
            'totalProducts',
            'totalCategories',
            'totalTenants',
            'totalPlans',
            'totalRoles',
            'totalGroups',
            'totalPermissions',
        ));
    }
}
