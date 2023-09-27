<?php

namespace App\Interfaces;

use App\Http\Requests\TypeRequest;
use Illuminate\Http\Request;

interface TypeInterface
{
    public function getAllData();
    public function getDataById($id);
    public function requestData(TypeRequest $request, $id = null);
    public function deleteData($id);
}
