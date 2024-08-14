<?php

namespace App\Services;

use App\Base\ServiceBase;
use App\Repositories\EmployeeJobRepository;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class DeleteEmployeeJobService extends ServiceBase
{
    public function __construct(protected int $id)
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
            $repo = (new EmployeeJobRepository)->delete($this->id);
            if ($repo) {
                return  self::success([], "Success delete Data");
            } else {
                return  self::error(null, "Data not found !");
            }
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