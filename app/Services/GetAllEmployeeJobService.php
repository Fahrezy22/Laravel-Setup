<?php

namespace App\Services;

use App\Base\ServiceBase;
use App\Repositories\EmployeeJobRepository;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class GetAllEmployeeJobService extends ServiceBase
{
    public function __construct()
    {
        
    }

    /**
     * Main method of this service
     *
     * @return ServiceResponse
     */
    public function call(): ServiceResponse
    {
        try {

            $repo = (new EmployeeJobRepository)->getAll();
            return  self::success($repo, "Success");
        } catch (Throwable $th) {
            
            Log::error(self::class, [
                'Message ' => $th->getMessage(),
                'On file ' => $th->getFile(),
                'On line ' => $th->getLine()
            ]);
            return self::error(null, $th->getMessage());
        }
    }
}