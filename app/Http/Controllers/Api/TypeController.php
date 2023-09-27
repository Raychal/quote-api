<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\TypeInterface;
use App\Http\Requests\TypeRequest;

class TypeController extends Controller
{
    protected $typeInterface;

    public function __construct(TypeInterface $typeInterface)
    {
        $this->typeInterface = $typeInterface;
    }

    public function index()
    {
        return $this->typeInterface->getAllData();
    }

    public function show($id)
    {
        return $this->typeInterface->getDataById($id);
    }

    public function store(TypeRequest $request)
    {
        return $this->typeInterface->requestData($request);
    }

    public function update(TypeRequest $request, $id)
    {
        return $this->typeInterface->requestData($request, $id);
    }

    public function destroy($id)
    {
        return $this->typeInterface->deleteData($id);
    }
}
