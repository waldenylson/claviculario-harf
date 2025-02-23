<?php

namespace App\Http\Repositories\Users;

use App\Http\Requests\StoreEfetivoPostRequest;
use App\Models\HarfStaff;

interface EfetivoRepositoryContract
{
    public function index();
    public function create();
    public function show(HarfStaff $harfStaff);
    public function store(StoreEfetivoPostRequest $request);
    public function edit(HarfStaff $harfStaff);
    public function persistUpdate(StoreEfetivoPostRequest $request, HarfStaff $harfStaff);
    public function destroy(HarfStaff $harfStaff);
    public function getAllUsersForSelect();
}
