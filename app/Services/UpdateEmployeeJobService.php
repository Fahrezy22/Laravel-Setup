<?php

namespace App\Services;

use App\Base\ServiceBase;
use App\Repositories\EmployeeJobRepository;
use App\Responses\ServiceResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class UpdateEmployeeJobService extends ServiceBase
{
    public function __construct(protected int $id, protected Request $request)
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
            $mapping = $this->mapping($this->request->all());
            $repo = (new EmployeeJobRepository)->update($this->id, $mapping);

            if ($repo) {
                return  self::success([], "Success Save Data");
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

    private function mapping($request)
    {
        return [
            'name' => $request['name'],
        ];
    }
}