<?php

namespace App\Repositories;

use App\Http\Requests\TypeRequest;
use App\Interfaces\TypeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseAPI;
use App\Models\Type;
use Exception;
use stdClass;

class TypeRepository implements TypeInterface
{
    use ResponseAPI;

    public function getAllData()
    {
        try {
            $data = Type::all();

            return $this->success('All Data', $data, 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function getDataById($id)
    {
        try {
            $data = Type::find($id);
            if (!$data) {
                return $this->error("No data with ID $id", 404);
            }

            return $this->success('Data', $data, 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function requestData(TypeRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $data = $id ? Type::findorfail($id) : new Type();

            if ($id && !$data) {
                return $this->error("No data with ID $id", 404);
            }

            $data->name = $request->name;
            $data->status = $request->status;

            $data->save();
            DB::commit();

            return $this->success(
                $id ? "Type updated"
                    : "Type created",
                $data,
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 500);
        }
    }

    public function deleteData($id)
    {
        try {
            $data = Type::find($id);
            if (!$data) {
                return $this->error("No data with ID $id", 404);
            }
            $data->delete();
            return $this->success("Success deleted ID $id", null, 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
