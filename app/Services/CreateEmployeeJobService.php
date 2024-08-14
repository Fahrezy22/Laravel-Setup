<?php

namespace App\Services;

use App\Base\ServiceBase;
use App\Repositories\EmployeeJobRepository;
use App\Responses\ServiceResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class CreateEmployeeJobService extends ServiceBase
{
    public function __construct(protected Request $request)
    {
        
    }

    /**
     * Validate the data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validate(): \Illuminate\Contracts\Validation\Validator {
        return Validator::make($this->request->all(), [
            'name' => ['required','min:3'],
        ]);
    }

    /**
     * Main method of this service
     *
     * @return ServiceResponse
     */
    public function call(): ServiceResponse
    {
        if ($this->validate()->fails()) {
            return self::error($this->validate()->errors()->messages(), implode(',',$this->validate()->errors()->all()));
        }
        try {
            $mapping = $this->mapping($this->request->all());
            $repo = (new EmployeeJobRepository)->store($mapping);
            return  self::success([], "Success Save Data");
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