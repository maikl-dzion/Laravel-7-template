<?php

namespace App\Http\Controllers;

//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use Illuminate\Foundation\Bus\DispatchesJobs;
//use Illuminate\Foundation\Validation\ValidatesRequests;

// use Illuminate\Support\Facades\DB;
use App\Repositories\BaseReferenceRepository;
use Illuminate\Http\Request;
// use App\Repositories\BaseReferenceRepositoryInterface;

class BaseReferenceController extends Controller
{
    private $repo;

    public function __construct(BaseReferenceRepository $baseRepository)
    {
        $this->repo = $baseRepository;
    }

    public function index() {
        $items = $this->repo->all();
        print_r($items);
    }

    public function getByItemId($itemId) {
        // $users = DB::select('select * from basicrefbook');
        $item = $this->repo->getByItemId($itemId);
        return $item;
    }

    public function getListByRecourceType($resourceType, $active = 0) {
        $items = $this->repo->getListByRecourceType($resourceType, $active);
        return $items;
    }

    public function addItem(Request $request) {
        $data = $request->all();
        $resp = $this->repo->addItem($data);
        return $resp;
    }

    public function updateItem(Request $request) {
        $data = $request->all();
        $resp = $this->repo->updateItem($data);
    }

    public function deleteItem($id) {
        print_r($id);
    }

//    public function detail($id)
//    {
//        $user = User::find($id);
//        $blogs = $this->blogRepository->getByUser($user);
//        return view('blog')->withBlogs($blogs);
//    }

}

// $users = DB::select('select * from basicrefbook');
