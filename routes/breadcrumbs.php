<?php

// Home
//
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('dashboard'));
});

// Companies
//
Breadcrumbs::register('companies.index', function ($breadcrumbs) {
    $breadcrumbs->push('Company Management', route('companies.index'));
});

Breadcrumbs::register('companies.create', function ($breadcrumbs) {
    $breadcrumbs->parent('companies.index');
    $breadcrumbs->push('Create Company', route('companies.create'));
});

Breadcrumbs::register('companies.show', function ($breadcrumbs, $company) {
    $breadcrumbs->parent('companies.index', $company);
    $breadcrumbs->push('Company Details', route('companies.show', $company));
});

Breadcrumbs::register('companies.edit', function ($breadcrumbs, $company) {
    $breadcrumbs->parent('companies.index', $company);
    $breadcrumbs->push('Edit Company', route('companies.edit', $company));
});

// Contacts
//
Breadcrumbs::register('contacts.index', function ($breadcrumbs) {
    $breadcrumbs->push('Contacts Management', route('contacts.index'));
});

Breadcrumbs::register('contacts.leads', function ($breadcrumbs) {
    $breadcrumbs->parent('contacts.index');
    $breadcrumbs->push('Leads', route('contacts.leads'));
});

Breadcrumbs::register('contacts.opportunities', function ($breadcrumbs) {
    $breadcrumbs->parent('contacts.index');
    $breadcrumbs->push('Opportunities', route('contacts.opportunities'));
});

Breadcrumbs::register('contacts.customers', function ($breadcrumbs) {
    $breadcrumbs->parent('contacts.index');
    $breadcrumbs->push('Customers', route('contacts.customers'));
});

Breadcrumbs::register('contacts.archived', function ($breadcrumbs) {
    $breadcrumbs->parent('contacts.archived');
    $breadcrumbs->push('Archived Contacts', route('contacts.archived'));
});

Breadcrumbs::register('contacts.create', function ($breadcrumbs) {
    $breadcrumbs->parent('contacts.index');
    $breadcrumbs->push('New Contact', route('contacts.create'));
});

Breadcrumbs::register('contacts.show', function ($breadcrumbs, $contact) {
    $breadcrumbs->parent('contacts.index', $contact);
    $breadcrumbs->push('Contact Details', route('contacts.show', $contact));
});

Breadcrumbs::register('contacts.edit', function ($breadcrumbs, $contact) {
    $breadcrumbs->parent('contacts.index', $contact);
    $breadcrumbs->push('Edit Contact', route('contacts.edit', $contact));
});

// Users
//
Breadcrumbs::register('users.index', function ($breadcrumbs) {
    $breadcrumbs->push('User Management', route('users.index'));
});

Breadcrumbs::register('users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push('New User', route('users.create'));
});

Breadcrumbs::register('users.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users.index', $user);
    $breadcrumbs->push('Edit User', route('users.edit', $user));
});

Breadcrumbs::register('users.show', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users.index', $user);
    $breadcrumbs->push('User Details', route('users.show', $user));
});

Breadcrumbs::register('users.profile', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users.index', $user);
    $breadcrumbs->push('User Profile', route('users.profile', $user));
});

Breadcrumbs::register('users.settings', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users.index', $user);
    $breadcrumbs->push('User Settings', route('users.settings', $user));
});
