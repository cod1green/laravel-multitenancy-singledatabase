<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('site.home'));
});

// Admin
Breadcrumbs::for('admin', function ($trail) {
    $trail->parent('home');
    $trail->push('Painel', route('admin.dashboard'));
});

// Admin > Plans
Breadcrumbs::for('plans', function ($trail) {
    $trail->parent('admin');
    $trail->push('Planos', route('plans.index'));
});

// Admin > Plans > create
Breadcrumbs::for('plansCreate', function ($trail) {
    $trail->parent('admin');
    $trail->push('Planos', route('plans.index'));
    $trail->push('Novo');
});

// Admin > Plans > edit
Breadcrumbs::for('plansEdit', function ($trail) {
    $trail->parent('admin');
    $trail->push('Planos', route('plans.index'));
    $trail->push('Editar');
});

// Admin > Plans > view
Breadcrumbs::for('plansView', function ($trail) {
    $trail->parent('admin');
    $trail->push('Planos', route('plans.index'));
    $trail->push('Visualizar');
});

// Painel > Planos > detalhes
Breadcrumbs::for('details', function ($trail, $plan) {
    $trail->parent('admin');
    $trail->push('Planos', route('plans.index'));
    $trail->push('Detalhes');
});

// Painel > Planos > Detalhes > create
Breadcrumbs::for('PlansDetailsCreate', function ($trail, $plan) {
    $trail->parent('admin');
    $trail->push('Planos', route('plans.index'));
    $trail->push('Detalhes', route('details.plan.index', $plan->url));
    $trail->push('Novo');
});

// Painel > Planos > Detalhes > edit
Breadcrumbs::for('PlansDetailsEdit', function ($trail, $plan) {
    $trail->parent('admin');
    $trail->push('Planos', route('plans.index'));
    $trail->push('Detalhes', route('details.plan.index', $plan->url));
    $trail->push('Editar');
});

// Painel > Planos > Detalhes > view
Breadcrumbs::for('PlansDetailsView', function ($trail, $plan) {
    $trail->parent('admin');
    $trail->push('Planos', route('plans.index'));
    $trail->push('Detalhes', route('details.plan.index', $plan->url));
    $trail->push('Visualizar');
});

// Admin > Plans > groups
Breadcrumbs::for('plansGroups', function ($trail) {
    $trail->parent('admin');
    $trail->push('Planos', route('plans.index'));
    $trail->push('Grupos do plano');
});

// Admin > Permissions > Groups > available
Breadcrumbs::for('plansGroupsAvailable', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push('Planos', route('plans.index'));
    $trail->push('Grupos do plano', route('plans.groups', $item->id));
    $trail->push('Vincular grupo');
});

// Admin > Products
Breadcrumbs::for('products', function ($trail) {
    $trail->parent('admin');
    $trail->push('Produtos', route('products.index'));
});

// Admin > Products > create
Breadcrumbs::for('productsCreate', function ($trail) {
    $trail->parent('admin');
    $trail->push('Produtos', route('products.index'));
    $trail->push('Novo');
});

// Admin > Products > edit
Breadcrumbs::for('productsEdit', function ($trail) {
    $trail->parent('admin');
    $trail->push('Produtos', route('products.index'));
    $trail->push('Editar');
});

// Admin > Products > view
Breadcrumbs::for('productsView', function ($trail) {
    $trail->parent('admin');
    $trail->push('Produtos', route('products.index'));
    $trail->push('Visualizar');
});

// Painel > Products > categories
Breadcrumbs::for('productsCategories', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push("Produtos", route('products.index'));
    $trail->push('Categorias do produto');
});

// Admin > Products > Categories > available
Breadcrumbs::for('productsCategoriesAvailable', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push('Produtos', route('products.index'));
    $trail->push('Categoria do produto', route('products.categories', $item->id));
    $trail->push('Vincular categoria');
});

// Admin > Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('admin');
    $trail->push('Categorias', route('categories.index'));
});

// Admin > Categories > create
Breadcrumbs::for('categoriesCreate', function ($trail) {
    $trail->parent('admin');
    $trail->push('Categorias', route('categories.index'));
    $trail->push('Novo');
});

// Admin > Categories > edit
Breadcrumbs::for('categoriesEdit', function ($trail) {
    $trail->parent('admin');
    $trail->push('Categorias', route('categories.index'));
    $trail->push('Editar');
});

// Admin > Categories > view
Breadcrumbs::for('categoriesView', function ($trail) {
    $trail->parent('admin');
    $trail->push('Categorias', route('categories.index'));
    $trail->push('Visualizar');
});

// Admin > Groups
Breadcrumbs::for('groups', function ($trail) {
    $trail->parent('admin');
    $trail->push('Grupos', route('groups.index'));
});

// Admin > Groups > create
Breadcrumbs::for('groupsCreate', function ($trail) {
    $trail->parent('admin');
    $trail->push('Grupos', route('groups.index'));
    $trail->push('Novo');
});

// Admin > Groups > edit
Breadcrumbs::for('groupsEdit', function ($trail) {
    $trail->parent('admin');
    $trail->push('Grupos', route('groups.index'));
    $trail->push('Editar');
});


// Admin > Groups > view
Breadcrumbs::for('groupsView', function ($trail) {
    $trail->parent('admin');
    $trail->push('Grupos', route('groups.index'));
    $trail->push('Visualizar');
});

// Painel > groups > permissions
Breadcrumbs::for('groupsPermissions', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push("Grupos", route('groups.index'));
    $trail->push('Permissões do grupo');
});

// Admin > Groups > Permissions > available
Breadcrumbs::for('groupPermissions', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push('Grupos', route('groups.index'));
    $trail->push('Permissões do grupo', route('groups.permissions', $item->id));
    $trail->push('Vincular permissão');
});

// Admin > Permissions
Breadcrumbs::for('permissions', function ($trail) {
    $trail->parent('admin');
    $trail->push('Permissões', route('permissions.index'));
});

// Admin > Permissions > create
Breadcrumbs::for('permissionsCreate', function ($trail) {
    $trail->parent('admin');
    $trail->push('Permissões', route('permissions.index'));
    $trail->push('Novo');
});

// Admin > Permissions > edit
Breadcrumbs::for('permissionsEdit', function ($trail) {
    $trail->parent('admin');
    $trail->push('Permissões', route('permissions.index'));
    $trail->push('Editar');
});


// Admin > Permissions > view
Breadcrumbs::for('permissionsView', function ($trail) {
    $trail->parent('admin');
    $trail->push('Permissões', route('permissions.index'));
    $trail->push('Visualizar');
});

// Painel > Permissions > group
Breadcrumbs::for('permissionsGroup', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push("Permissões", route('permissions.index'));
    $trail->push('Grupo por permissão');
});

// Admin > Permissions > Groups > available
Breadcrumbs::for('permissionGroups', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push('Permissões', route('permissions.index'));
    $trail->push('Grupos da permissão', route('permissions.groups', $item->id));
    $trail->push('Vincular grupo');
});

// Painel > Permissions > roles
Breadcrumbs::for('PermissionsRoles', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push("Permissions", route('permissions.index'));
    $trail->push('Cargo por permissão');
});

// Admin > Permissions > Roles > available
Breadcrumbs::for('permissionRolesAvailable', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push('Permissões', route('permissions.index'));
    $trail->push('Cargos da permissão', route('permissions.roles', $item->id));
    $trail->push('Vincular cargo');
});

// Admin > Roles
Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('admin');
    $trail->push('Cargos', route('roles.index'));
});

// Admin > Roles > create
Breadcrumbs::for('rolesCreate', function ($trail) {
    $trail->parent('admin');
    $trail->push('Cargos', route('roles.index'));
    $trail->push('Novo');
});

// Admin > Roles > edit
Breadcrumbs::for('rolesEdit', function ($trail) {
    $trail->parent('admin');
    $trail->push('Cargos', route('roles.index'));
    $trail->push('Editar');
});

// Admin > Roles > view
Breadcrumbs::for('rolesView', function ($trail) {
    $trail->parent('admin');
    $trail->push('Cargos', route('roles.index'));
    $trail->push('Visualização');
});

// Painel > Roles > permissions
Breadcrumbs::for('rolesPermissions', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push("Cargos", route('roles.index'));
    $trail->push('Permissão por cargo');
});

// Admin > Roles > Permissions > available
Breadcrumbs::for('RolePermissionAvailable', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push('Cargos', route('roles.index'));
    $trail->push('Permissão do cargo', route('roles.permissions', $item->id));
    $trail->push('Vincular permissão');
});

// Admin > Roles > users
Breadcrumbs::for('roleUsers', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push('Cargos', route('roles.index'));
    $trail->push('Usuários do cargo', route('roles.users', $item->id));
});

// Admin > Roles > Users > available
Breadcrumbs::for('roleUsersAvailable', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push('Cargos', route('roles.index'));
    $trail->push('Usuários do cargo', route('roles.users', $item->id));
    $trail->push('Vincular usuário');
});

// Admin > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('admin');
    $trail->push('Usuários', route('users.index'));
});

// Admin > Users > create
Breadcrumbs::for('usersCreate', function ($trail) {
    $trail->parent('admin');
    $trail->push('Usuários', route('users.index'));
    $trail->push('Novo', route('users.create'));
});

// Admin > Users > edit
Breadcrumbs::for('usersEdit', function ($trail) {
    $trail->parent('admin');
    $trail->push('Usuários', route('users.index'));
    $trail->push('Editar');
});

// Admin > Users > view
Breadcrumbs::for('usersView', function ($trail) {
    $trail->parent('admin');
    $trail->push('Usuários', route('users.index'));
    $trail->push('Visualizar');
});

// Admin > Users > profile
Breadcrumbs::for('usersProfile', function ($trail) {
    $trail->parent('admin');
    $trail->push('Usuários', route('users.index'));
    $trail->push('Perfil');
});

// Admin > Users > invoices
Breadcrumbs::for('usersInvoices', function ($trail) {
    $trail->parent('admin');
    $trail->push('Usuários', route('users.index'));
    $trail->push('Minhas faturas');
});

// Admin > Users > roles
Breadcrumbs::for('userRoles', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push('Usuários', route('users.index'));
    $trail->push('Cargos do usuários', route('users.roles', $item->id));
});

// Admin > Users > Roles > available
Breadcrumbs::for('userRolesAvailable', function ($trail, $item) {
    $trail->parent('admin');
    $trail->push('Usuários', route('users.index'));
    $trail->push('Cargos do usuários', route('users.roles', $item->id));
    $trail->push('Vincular cargo');
});

// Admin > Tables
Breadcrumbs::for('tables', function ($trail) {
    $trail->parent('admin');
    $trail->push('Mesas', route('tables.index'));
});

// Admin > Tables > create
Breadcrumbs::for('tablesCreate', function ($trail) {
    $trail->parent('admin');
    $trail->push('Mesas', route('tables.index'));
    $trail->push('Novo');
});

// Admin > Tables > edit
Breadcrumbs::for('tablesEdit', function ($trail) {
    $trail->parent('admin');
    $trail->push('Mesas', route('tables.index'));
    $trail->push('Editar');
});

// Admin > Tables > view
Breadcrumbs::for('tablesView', function ($trail) {
    $trail->parent('admin');
    $trail->push('Mesas', route('tables.index'));
    $trail->push('Visualizar');
});

// Admin > Tenants
Breadcrumbs::for('tenants', function ($trail) {
    $trail->parent('admin');
    $trail->push('Empresas', route('tenants.index'));
});

// Admin > Tenants > create
Breadcrumbs::for('tenantsCreate', function ($trail) {
    $trail->parent('admin');
    $trail->push('Empresas', route('tenants.index'));
    $trail->push('Novo');
});

// Admin > Tenants > edit
Breadcrumbs::for('tenantsEdit', function ($trail) {
    $trail->parent('admin');
    $trail->push('Empresas', route('tenants.index'));
    $trail->push('Editar');
});

// Admin > Tenants > view
Breadcrumbs::for('tenantsView', function ($trail) {
    $trail->parent('admin');
    $trail->push('Empresas', route('tenants.index'));
    $trail->push('Visualização');
});

// Admin > Tenants > view
Breadcrumbs::for('orders', function ($trail) {
    $trail->parent('admin');
    $trail->push(__('Companies'), route('tenants.index'));
    $trail->push(__("Orders"));
});

// Admin > Tenants > view
Breadcrumbs::for('salesPDV', function ($trail) {
    $trail->parent('admin');
    $trail->push(__("Point of Sale"));
});
