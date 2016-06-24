<?php namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    // Index
    public function index() {
        return User::orderBy('id', 'desc')->get();
    }

    // show
    public function show($id) {
        $show = User::find($id);
        if (is_null($show)) {
            return ['code' => '-1', 'message' => 'Page Not Found'];
        }
        return $show;
    }

    // store
    public function store(Request $request) {
        return User::create([
            'email'    => e($request->input('email')),
            'name'     => e($request->input('name')),
            'password' => app('hash')->make(e($request->input('password')))
        ]);
    }

    // edit
    public function edit($id) {
        $edit = User::find($id);
        if (is_null($edit)) {
            return ['code' => '-1', 'message' => 'Page Not Found'];
        }
        return $edit;
    }

    // update
    public function update(Request $request, $id) {
        $data = [
            'name'     => e($request->input('name')),
            'password' => app('hash')->make(e($request->input('password')))
        ];
        if (User::where('id', $id)->update($data)) {
            return ['code' => 1000, 'message' => 'update Success...'];
        }
        return ['code' => '-1', 'message' => 'update Fail...'];
    }

    // destroy
    public function destroy($id) {
        if (User::destroy($id)) {
            return ['code' => 1000, 'message' => 'delete Success...'];
        }
        return ['code' => '-1', 'message' => 'delete Fail...'];
    }
}