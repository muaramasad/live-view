<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('HOME', route('homepage'));
});

// Home > About
Breadcrumbs::register('map', function ($breadcrumbs, $division) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($division->division_name, route('map.division', $division->id));
});

// Home > Blog
Breadcrumbs::register('blog', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::register('category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('blog');
    $breadcrumbs->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::register('post', function ($breadcrumbs, $post) {
    $breadcrumbs->parent('category', $post->category);
    $breadcrumbs->push($post->title, route('post', $post));
});