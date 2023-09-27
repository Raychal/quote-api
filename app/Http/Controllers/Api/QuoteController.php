<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\QuoteInterface;
use App\Http\Requests\QuoteRequest;

class QuoteController extends Controller
{
    protected $quoteInterface;

    public function __construct(QuoteInterface $quoteInterface)
    {
        $this->quoteInterface = $quoteInterface;
    }

    public function index()
    {
        return $this->quoteInterface->getAllData();
    }

    public function show($id)
    {
        return $this->quoteInterface->getDataById($id);
    }

    public function store(QuoteRequest $request)
    {
        return $this->quoteInterface->requestData($request);
    }

    public function update(QuoteRequest $request, $id)
    {
        return $this->quoteInterface->requestData($request, $id);
    }

    public function destroy($id)
    {
        return $this->quoteInterface->deleteData($id);
    }
}
