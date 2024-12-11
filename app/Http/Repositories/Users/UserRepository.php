<?php

namespace App\Http\Repositories\Users;

use App\Http\Requests\StoreUsersPostRequest;
use App\Models\User;

class UserRepository implements UserRepositoryContract
{
    protected $modelClass = User::class;

    public function listUsers()
    {
        return $this->modelClass::all();
    }

    public function findSingleUser($id)
    {
        return $this->modelClass::findOrFail($id);
    }

    public function store(StoreUsersPostRequest $request)
    {
        return $this->modelClass::create($request->all());
    }

    public function edit($id)
    {
        return $this->modelClass::findOrFail($id);
    }

    public function persistUpdate(StoreUsersPostRequest $request, $id)
    {
        return $this->modelClass::findOrFail($id)->update($request->all());
    }

    public function destroy($id)
    {
        $user = $this->modelClass::findOrFail($id);

        return $user->delete();
    }

    public function getAllUsersForSelect()
    {
        $baseArray = $this->modelClass::all();
        $users = array();

        foreach ($baseArray as $value) {
            $users[$value->id] = $value->posto_gradu . $value->nome_guerra;
        }

        return $users;
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function show(User $user)
    {
        // TODO: Implement show() method.
    }
}
