<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\CreateEmployeeJobService;
use App\Services\DeleteEmployeeJobService;
use App\Services\FindEmployeeJobService;
use App\Services\GetAllEmployeeJobService;
use App\Services\UpdateEmployeeJobService;
use App\Services\upsertEmployeeJobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class EmployeeJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $call = (new GetAllEmployeeJobService())->call();
            if(@$call->status != 200){
                return $this->error(@$call->message, 'getAllEmployeeJob', 400, @$call->data, 400);
            }
            return $this->success(@$call->data, @$call->message , 'getAllEmployeeJob', $call->status(), 200);
        }catch (Throwable $th){
            Log::error(self::class, [
                'Message ' . $th->getMessage(),
                'On File ' . $th->getFile(),
                'On Line ' . $th->getLine()
            ]);
            return $this->error($th->getMessage(), 'getAllEmployeeJob');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $call = (new CreateEmployeeJobService($request))->call();
            if(@$call->status != 200){
                return $this->error(@$call->message, 'storeEmployeeJob', 400, @$call->data, 400);
            }
            return $this->success(@$call->data, @$call->message , 'storeEmployeeJob', $call->status(), 200);
        }catch (Throwable $th){
            Log::error(self::class, [
                'Message ' . $th->getMessage(),
                'On File ' . $th->getFile(),
                'On Line ' . $th->getLine()
            ]);
            return $this->error($th->getMessage(), 'storeEmployeeJob');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $call = (new FindEmployeeJobService($id))->call();
        try{
            if(@$call->status != 200){
                return $this->error(@$call->message, 'findEmployeeJob', 400, @$call->data, 400);
            }
            return $this->success(@$call->data, @$call->message , 'findEmployeeJob', $call->status(), 200);
        }catch (Throwable $th){
            Log::error(self::class, [
                'Message ' . $th->getMessage(),
                'On File ' . $th->getFile(),
                'On Line ' . $th->getLine()
            ]);
            return $this->error($th->getMessage(), 'findEmployeeJob');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $call = (new UpdateEmployeeJobService($id,$request))->call();
            if(@$call->status != 200){
                return $this->error(@$call->message, 'updateEmployeeJob', 400, @$call->data, 400);
            }
            return $this->success(@$call->data, @$call->message , 'updateEmployeeJob', $call->status(), 200);
        }catch (Throwable $th){
            Log::error(self::class, [
                'Message ' . $th->getMessage(),
                'On File ' . $th->getFile(),
                'On Line ' . $th->getLine()
            ]);
            return $this->error($th->getMessage(), 'updateEmployeeJob');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $call = (new DeleteEmployeeJobService($id))->call();
            if(@$call->status != 200){
                return $this->error(@$call->message, 'deleteEmployeeJob', 400, @$call->data, 400);
            }
            return $this->success(@$call->data, @$call->message , 'deleteEmployeeJob', $call->status(), 200);
        }catch (Throwable $th){
            Log::error(self::class, [
                'Message ' . $th->getMessage(),
                'On File ' . $th->getFile(),
                'On Line ' . $th->getLine()
            ]);
            return $this->error($th->getMessage(), 'deleteEmployeeJob');
        }
    }
}
