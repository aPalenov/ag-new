<?php

namespace App\Http\Controllers;

use App\Data\PageBuilder\PageData;
use App\Services\PageBuilder\PageBuilder;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(protected PageBuilder $pageBuilder) {}

    public function show(Request $request)
    {
        $tenant = config('app.tenant');

        $this->breadcrumbs()->add('Тест', 'test');

        $this->meta()->setTitle("Тестовый заголовок - {$tenant}");
        $this->meta()->setDescription('Описание главной страницы');

        return new PageData($this->pageBuilder->buildPage());
    }
}
