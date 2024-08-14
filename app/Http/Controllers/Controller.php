<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponser;

    protected function logError(\Throwable $th, string $context) : void {
        logger()->error($context, [
            'Message ' => $th->getMessage(),
            'On File ' => $th->getFile(),
            'On Line ' => $th->getLine()
        ]);
    }
}
