<?php

namespace LaravelStores\Web\Resources\Stores\Repositories;

interface StoresRepositoryInterface {
    function create($data);
    function get($id);
    function getAll();
    function update($id, $data);
    function delete($id);
}