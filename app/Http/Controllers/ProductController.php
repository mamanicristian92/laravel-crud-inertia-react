<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('products/index', [
            'products' => Product::orderBy('id','asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('products/create', [
            'products' => new Product()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        Product::create($validated);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return inertia('products/edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product->update($validated);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function generateReport()
    {
        $product_id = request()->id;
        $data = [
            //'title' => 'Listado de Productos',
            'date' => date('d/m/Y'),
            //'products' => $products,
        ];

        if ( $product_id ) {
            $product = Product::find($product_id);
            $data['title'] = 'Producto '.$product->name;
            $data['product'] = [$product];
            $pdf = Pdf::loadView( 'product', ['data' => $data])->setPaper('a4', 'portrait');
            return $pdf->stream( 'product.pdf' );
        }
        //en caso de que no se pase id, se listan todos
        $products = Product::select( 'id', 'name', 'description' )->get();
        $data['title'] = 'Listado de Productos';
        $data['products'] = $products;
        $pdf = Pdf::loadView( 'products', ['data' => $data])->setPaper('a4', 'portrait');
        return $pdf->stream( 'products.pdf' );
    }
    public function export() 
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
}
