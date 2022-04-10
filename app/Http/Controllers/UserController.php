<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\User;
class UserController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        try {
            $data = User::get();
            return $this->responseSuccess($data, 'User Get Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        print_r($request->post());
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
