<?php

namespace App\Interfaces;

use App\Http\Requests\QuoteRequest;
use Illuminate\Http\Request;

interface QuoteInterface
{
    public function getAllData();
    public function getDataById($id);
    public function requestData(QuoteRequest $request, $id = null);
    public function deleteData($id);
}
