<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\Factory as View;

class HomeAction extends Controller
{
    private View $view;
    
    public function __construct(View $view)
    {
        $this->view = $view;
    }
    
    public function __invoke()
    {
        return $this->view->make('home');
    }  
}
