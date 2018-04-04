<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('homepage'));
});

Breadcrumbs::register('settings', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Settings', route('dashboard.settings'));
});

Breadcrumbs::register('division', function ($breadcrumbs,$division) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($division->division_name, route('dashboard.division', $division->id));
});

Breadcrumbs::register('prov', function ($breadcrumbs,$division,$prov) {
    $breadcrumbs->parent('division',$division);
    $breadcrumbs->push($prov->province_name, route('dashboard.province', [$division->id,$prov->province_code]));
});

Breadcrumbs::register('site', function ($breadcrumbs,$division,$prov,$site) {
    $breadcrumbs->parent('prov',$division,$prov);
    $breadcrumbs->push($site->site_name, route('dashboard.site', [$division->id,$prov->province_code,$site->id]));
});

// Breadcrumbs::register('blog', function ($breadcrumbs) {
//     $breadcrumbs->parent('home');
//     $breadcrumbs->push('Blog', route('blog'));
// });

// Breadcrumbs::register('category', function ($breadcrumbs, $category) {
//     $breadcrumbs->parent('blog');
//     $breadcrumbs->push($category->title, route('category', $category->id));
// });

// Breadcrumbs::register('post', function ($breadcrumbs, $post) {
//     $breadcrumbs->parent('category', $post->category);
//     $breadcrumbs->push($post->title, route('post', $post));
// });