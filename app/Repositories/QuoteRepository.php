<?php

namespace App\Repositories;

use App\Http\Requests\QuoteRequest;
use App\Interfaces\QuoteInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseAPI;
use App\Models\Quote;
use App\Models\Type;
use Exception;
use stdClass;

class QuoteRepository implements QuoteInterface
{
    use ResponseAPI;

    public function getAllData()
    {
        try {
            $data = Quote::all();

            return $this->success('All Data', $data, 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function getDataById($id)
    {
        try {
            $data = Quote::find($id);

            if (!$data) {
                return $this->error("No data with ID $id", 404);
            }

            return $this->success('Data', $data, 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function requestData(QuoteRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $data = $id ? Quote::findorfail($id) : new Quote();

            if ($id && !$data) {
                return $this->error("No data with ID $id", 404);
            }

            $data->types = json_decode($request->types);
            $data->content = $request->content;
            $data->author = $request->author;

            $data->save();
            DB::commit();

            return $this->success(
                $id ? "Quote updated"
                    : "Quote created",
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
            $data = Quote::find($id);
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
