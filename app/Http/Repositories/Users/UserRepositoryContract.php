<?php

namespace App\Http\Repositories\Users;

use App\Http\Requests\StoreUsersPostRequest;
use App\Models\User;

interface UserRepositoryContract
{
    public function index();
    public function create();
    public function show(User $user);
    public function store(StoreUsersPostRequest $request);
    public function edit(User $user);
    public function persistUpdate(StoreUsersPostRequest $request, User $user);
    public function destroy(User $user);
    public function getAllUsersForSelect();
}
