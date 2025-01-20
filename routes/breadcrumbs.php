<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
  $trail->push(__('Home'), route('home'));
});

// Home > Page
Breadcrumbs::for('page', function (BreadcrumbTrail $trail, $page) {
  $trail->parent('home');
  $trail->push($page->title, $page->slug);
});