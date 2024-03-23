<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pages;
use App\Controllers\News;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('news', [News::class, 'index']);           // Add this line

$routes->get('news/new', [News::class, 'new']); // 뉴스 등록하기 주소생성
$routes->post('news', [News::class, 'create']); // 뉴스 등록하기 create 페이지 생성
$routes->get('news/(:hash)', [News::class, 'show']); // Add this line
$routes->post('news/(:hash)', [News::class, 'del']); // 삭제하기
$routes->get('news/recreate/(:segment)', [News::class, 'recreate']); // 수정하기
$routes->post('news/recreate/(:segment)', [News::class, 'update']); // 뉴스 수정하기 update

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
