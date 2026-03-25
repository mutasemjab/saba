<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /** GET /api/v1/user/categories */
    public function categories()
    {
        $data = Category::withCount('products')
            ->orderBy('created_at', 'desc')->get()
            ->map(fn($c) => [
                'id'             => $c->id,
                'name_ar'        => $c->name_ar,
                'name_en'        => $c->name_en,
                'products_count' => $c->products_count,
            ]);

        return response()->json(['status' => true, 'data' => $data]);
    }

    /** GET /api/v1/user/products */
    public function allProducts()
    {
        $data = Product::with(['category', 'options'])
            ->orderBy('category_id')
            ->get()
            ->map(fn($p) => $this->format($p));

        return response()->json(['status' => true, 'data' => $data]);
    }

    /** GET /api/v1/user/products/{categoryId} */
    public function productsByCategory($categoryId)
    {
        $data = Product::with(['category', 'options'])
            ->where('category_id', $categoryId)
            ->get()
            ->map(fn($p) => $this->format($p));

        return response()->json(['status' => true, 'data' => $data]);
    }

    private function format($p): array
    {
        return [
            'id'               => $p->id,
            'name_ar'          => $p->name_ar,
            'name_en'          => $p->name_en,
            'description_ar'   => $p->description_ar,
            'description_en'   => $p->description_en,
            'photo'            => $p->photo
                ? url('assets/admin/uploads/' . $p->photo) : null,
            'price'            => $p->price ? (float) $p->price : null,
            'price_unit_ar'    => $p->price_unit_ar ?? 'درهم',
            'price_unit_en'    => $p->price_unit_en ?? 'MAD',
            'is_featured'      => $p->is_featured == 1,
            'category_id'      => $p->category_id,
            'category_name_ar' => $p->category->name_ar ?? null,
            'category_name_en' => $p->category->name_en ?? null,
            'sort_order'       => $p->sort_order ?? 0,
            'options'          => $p->options->isNotEmpty()
                ? $p->options->map(fn($o) => $this->formatOption($o))->values()
                : [],
        ];
    }

    private function formatOption($o): array
    {
        return [
            'id'             => $o->id,
            'name_ar'        => $o->name_ar,
            'name_en'        => $o->name_en,
            'price'          => $o->price ? (float) $o->price : null,
            'price_unit_ar'  => $o->price_unit_ar ?? 'درهم',
            'price_unit_en'  => $o->price_unit_en ?? 'MAD',
            'sort_order'     => $o->sort_order ?? 0,
        ];
    }
}