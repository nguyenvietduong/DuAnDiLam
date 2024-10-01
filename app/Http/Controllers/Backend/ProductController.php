<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackEnd\Product\StoreProductRequest;
use App\Http\Requests\BackEnd\Product\UpdateProductRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $productRepository;
    public function __construct(
        ProductService      $productService,
        ProductRepository   $productRepository
    ) {
        $this->productService       = $productService;
        $this->productRepository    = $productRepository;
    }

    public function index(Request $request)
    {
        $config['model']    = 'product';
        $config['seo']      = config('apps.messages.product');
        $products_back      = $this->productService->paginate($request);
        return view('backend.product.index', compact('config', 'products_back'));
    }

    public function create()
    {
        $config['model'] = 'product';
        $config['seo'] = config('apps.messages.product');
        return view('backend.product.create', compact('config'));
    }


    public function store(StoreProductRequest $request)
    {
        if ($this->productService->create($request)) {
            return redirect()->route('admin.product.index')->with('success', 'Thêm mới bản ghi thành công');
        }
        return redirect()->route('admin.product.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }


    public function edit($id)
    {
        $config['model'] = 'product';
        $config['seo'] = config('apps.messages.product');
        $product = $this->productRepository->findById($id);
        return view('backend.product.edit', compact('product', 'config'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        if ($this->productService->update($id, $request)) {
            return redirect()->route('admin.product.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('admin.product.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function destroy($id)
    {
        if ($this->productService->destroy($id)) {
            return redirect()->route('admin.product.index')->with('success', 'Xóa bản ghi thành công');
        }
        return redirect()->route('admin.product.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
    }

}
