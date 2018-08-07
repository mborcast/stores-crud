<?php

namespace LaravelStores\Web\Resources\Sales\Services;

use LaravelStores\Web\Resources\Sales\Services\SalesServiceInterface;
use LaravelStores\Web\Resources\Sales\Repositories\SalesRepositoryInterface;

class SalesService implements SalesServiceInterface {

    private $_sales;

    public function __construct(SalesRepositoryInterface $salesRepository) {
        $this->_sales = $salesRepository;
    }    
    public function create($data) {
        return response()->json(
            $this->_sales->create($data),
            201
        );
    }
    public function get($id) {
        $lStore = $this->_sales->get($id);
        if ($lStore == null) {
            return response()->json(
                ['message' => 'Not found'], 
                404
            );
        }
        return response()->json(
            $lStore,
            200
        );
    }
    public function getAll() {
        return response()->json(
            $this->_sales->getAll(), 
            200
        );
    }
    public function update($data, $id) {
        $lStore = $this->_sales->update($data, $id);
        if ($lStore == null) {
            return response()->json(
                ['message' => 'Not found'], 
                404
            );
        }
        return response()->json(
            $lStore,
            200
        );
    }
    public function delete($id) {
        $lStore = $this->_sales->get($id);
        if ($lStore == null) {
            return response()->json(
                ['message' => 'Not found'], 
                404
            );
        }
        if ($this->_sales->delete($id)) {
            return response()->json(
                null, 
                204
            );
        }
        return response()->json(
            ['message' => 'Deletion failed'], 
            500
        );
    }
}
