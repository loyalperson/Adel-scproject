<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// Home > Dashboard > User Management
Breadcrumbs::for('user-management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User Management', route('user-management.users.index'));
});

// Home > Dashboard > Scraper
Breadcrumbs::for('scraper.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Scraper', route('scraper.index'));
});

// Home > Dashboard > Scraper
Breadcrumbs::for('scraper.scheduler', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Schedule Scraping', route('scraper.scheduler'));
});

// Home > Dashboard > Scraper
Breadcrumbs::for('scraper.show-schedule', function (BreadcrumbTrail $trail) {
    $trail->parent('scraper.scheduler');
    $trail->push('Scraping Schedule', route('scraper.show-schedule'));
});

// Home > Dashboard > Scraper > Scraper Result
Breadcrumbs::for('scraper.result', function (BreadcrumbTrail $trail) {
    $trail->parent('scraper.index');
    $trail->push('Scraper Result', route('scraper.index'));
});

// Home > Dashboard > Scraper > Scraper History
Breadcrumbs::for('scraper.history', function (BreadcrumbTrail $trail) {
    $trail->parent('scraper.index');
    $trail->push('Scraping History', route('scraper.history'));
});

// Home > Dashboard > Scraper > Scraper History > Favourites
Breadcrumbs::for('scraper.history.favourites', function (BreadcrumbTrail $trail) {
    $trail->parent('scraper.history');
    $trail->push('Favourites', route('scraper.history.favourites'));
});

// Home > Dashboard > Scraper > Scraper History > Scrape Details
Breadcrumbs::for('scraper.history.details', function (BreadcrumbTrail $trail) {
    $trail->parent('scraper.history');
    $trail->push('Scrape Details', route('scraper.history.details'));
});

// Home > Dashboard > User Management > Users
Breadcrumbs::for('user-management.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Users', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users > [User]
Breadcrumbs::for('user-management.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('user-management.users.index');
    $trail->push(ucwords($user->name), route('user-management.users.show', $user));
});

// Home > Dashboard > User Management > Roles
Breadcrumbs::for('user-management.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Roles', route('user-management.roles.index'));
});

// Home > Dashboard > User Management > Roles > [Role]
Breadcrumbs::for('user-management.roles.show', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('user-management.roles.index');
    $trail->push(ucwords($role->name), route('user-management.roles.show', $role));
});

// Home > Dashboard > User Management > Permission
Breadcrumbs::for('user-management.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Permissions', route('user-management.permissions.index'));
});

// Home > Dashboard > Customer > Customer-List
Breadcrumbs::for('customers.customers-list.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Customer List', route('customers.customers-list.index'));
});

// Home > Dashboard > Customer > Customers-Details
Breadcrumbs::for('customers.customers-details.index', function (BreadcrumbTrail $trail) {
    $trail->parent('customers.customers-list.index');
    $trail->push('Customer Details', route('customers.customers-details.index'));
});

// Home > Dashboard > Tickets
Breadcrumbs::for('tickets.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Tickets', route('tickets.submit-ticket.index'));
});

// Home > Dashboard > Tickets-List
Breadcrumbs::for('tickets.tickets-list.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Tickets List', route('tickets.tickets-list.index'));
});

// Home > Dashboard > Tickets > Submit-Ticket
Breadcrumbs::for('tickets.submit-ticket.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Submit Ticket', route('tickets.submit-ticket.index'));
});