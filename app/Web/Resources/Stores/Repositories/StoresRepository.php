<?php 

namespace LaravelStores\Web\Resources\Stores\Repositories;
use LaravelStores\Web\Resources\Stores\Store;
use LaravelStores\Web\Shared\ResourceRepository;

class StoresRepository extends ResourceRepository implements StoresRepositoryInterface {

    public function create($data) {
        return Store::create([
          'name' => $data['name']
        ]);
    }
    public function get($id) {
        return Store::with('customers.sales', 'sales.products')
        ->find($id);
    }
    public function update($id, $data) {
        $lStore = Store::find($id);
        if ($lStore != null) {
          $lStore->name = $data['name'];
          $lStore->save();
        }
        return $lStore;
    }
    public function delete($id) {
        return (Store::destroy($id) > 0);
    }
    public function getByPage($page) {
        return Store::skip($this->itemsPerPage * ($page - 1))
        ->take($this->itemsPerPage)
        ->with('customers.sales')
        ->get();
    }
    public function getPagesCount() {
      return $this->calculateTotalPages(Store::count());
    }
}