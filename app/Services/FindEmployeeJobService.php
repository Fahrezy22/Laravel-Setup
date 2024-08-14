<?php

namespace App\Services;

use App\Base\ServiceBase;
use App\Repositories\EmployeeJobRepository;
use App\Responses\ServiceResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class FindEmployeeJobService extends ServiceBase
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
            $condition = ['id' => $this->id];
            $repo = (new EmployeeJobRepository)->findByCondition($condition);
            if (!$repo){
                return  self::success([], "Empty");
            }
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