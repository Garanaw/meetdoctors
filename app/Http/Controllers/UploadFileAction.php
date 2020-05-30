<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\View\Factory as View;
use App\Http\Requests\UploadXmlRequest as Request;
use App\Services\UploadService;
use Illuminate\Routing\Redirector;
use Throwable;

class UploadFileAction extends Controller
{
    private Redirector $redirector;
    private UploadService $service;
    private View $view;
    
    public function __construct(
        Redirector $redirector,
        UploadService $service,
        View $view
    )
    {
        $this->redirector = $redirector;
        $this->service = $service;
        $this->view = $view;
    }
    
    public function __invoke(Request $request)
    {
        try {
            $this->service->storeUsersFile($request->file('users'));
        } catch (Throwable $exception) {
            return $this->redirector
                ->back()
                ->withException($exception);
        }
        
        return $this->redirector
            ->route('home')
            ->with('success', __('home.success'));
    }
}
