<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\ProductOption;

class MergeChickenProductsSeeder extends Seeder
{
    /**
     * الكلمات المفتاحية اللي تدل على منتج دجاج بالأجزاء
     * نبحث عنها في الاسم العربي أو الإنجليزي
     */
    private array $quarterKeywords = ['ربع', 'quarter', '1/4'];
    private array $halfKeywords    = ['نص', 'نصف', 'half', '1/2'];
    private array $fullKeywords    = ['كاملة', 'كامل', 'full', 'whole'];

    /**
     * الكلمات اللي تدل على نوع الطبخة (مندي، مظبي، برياني...)
     * نستخدمها لتجميع المنتجات تحت اسم موحد
     */
    private array $cookingStyles = [
        'مندي'    => 'مندي',
        'مظبي'    => 'مظبي',
        'برياني'  => 'برياني',
        'مكبوس'   => 'مكبوس',
        'مفتول'   => 'مفتول',
        'mandi'   => 'مندي',
        'madhbi'  => 'مظبي',
        'biryani' => 'برياني',
    ];

    public function run(): void
    {
        $this->command->info('🔍 جاري البحث عن منتجات الدجاج المتكررة...');

        // ── 1. جلب كل المنتجات اللي اسمها يحتوي على ربع/نص/كاملة ──
        $products = Product::all();

        // نصنفها حسب طريقة الطبخ
        $grouped = [];

        foreach ($products as $product) {
            $nameAr = $product->name_ar ?? '';
            $nameEn = $product->name_en ?? '';
            $combined = $nameAr . ' ' . $nameEn;

            $sizeType = $this->detectSize($combined);
            if (!$sizeType) continue; // مش منتج دجاج بالأجزاء

            $style = $this->detectStyle($combined);

            // مفتاح التجميع = الكاتيجوري + طريقة الطبخ
            $groupKey = $product->category_id . '_' . $style;

            $grouped[$groupKey][] = [
                'product'  => $product,
                'size'     => $sizeType,
                'style'    => $style,
                'category' => $product->category_id,
            ];
        }

        if (empty($grouped)) {
            $this->command->warn('⚠️  ما لقينا منتجات دجاج بالأجزاء. تأكد من أسماء المنتجات.');
            $this->command->info('💡 نضيف الـ options الافتراضية (49 / 69 / 129) لكل منتجات الدجاج...');
            $this->seedDefaultOptions();
            return;
        }

        DB::transaction(function () use ($grouped) {

            foreach ($grouped as $groupKey => $items) {
                $this->command->info("📦 معالجة مجموعة: {$groupKey} (" . count($items) . " منتجات)");

                // ── 2. اختار المنتج الرئيسي (الدجاجة الكاملة أو أول وحدة) ──
                $mainItem = $this->pickMainProduct($items);
                $mainProduct = $mainItem['product'];

                // ── 3. نظف اسم المنتج الرئيسي من كلمات الحجم ──
                $cleanNameAr = $this->cleanName($mainProduct->name_ar, 'ar');
                $cleanNameEn = $this->cleanName($mainProduct->name_en, 'en');

                $mainProduct->update([
                    'name_ar' => $cleanNameAr,
                    'name_en' => $cleanNameEn,
                    // نمسح السعر من المنتج الرئيسي لأن السعر راح يكون في الـ options
                    'price'   => null,
                ]);

                $this->command->line("  ✅ المنتج الرئيسي: [{$mainProduct->id}] {$cleanNameAr}");

                // ── 4. احذف المنتجات الثانية (المكررة) ──
                foreach ($items as $item) {
                    if ($item['product']->id !== $mainProduct->id) {
                        $this->command->line("  🗑  حذف: [{$item['product']->id}] {$item['product']->name_ar}");
                        $item['product']->delete();
                    }
                }

                // ── 5. أضف options للمنتج الرئيسي ──
                // امسح القديمة لو موجودة
                ProductOption::where('product_id', $mainProduct->id)->delete();

                $this->createChickenOptions($mainProduct->id);

                $this->command->line("  🎯 تم إضافة خيارات الحجم بنجاح");
            }

        });

        $this->command->info('✅ تم الدمج بنجاح!');
        $this->command->table(
            ['المنتج', 'الخيار', 'السعر'],
            ProductOption::with('product')
                ->get()
                ->map(fn($o) => [
                    $o->product->name_ar ?? '—',
                    $o->name_ar,
                    $o->price . ' ' . $o->price_unit_ar,
                ])
                ->toArray()
        );
    }

    // ── Helpers ──────────────────────────────────────────────

    private function detectSize(string $text): ?string
    {
        foreach ($this->quarterKeywords as $kw) {
            if (str_contains($text, $kw)) return 'quarter';
        }
        foreach ($this->halfKeywords as $kw) {
            if (str_contains($text, $kw)) return 'half';
        }
        foreach ($this->fullKeywords as $kw) {
            if (str_contains($text, $kw)) return 'full';
        }
        return null;
    }

    private function detectStyle(string $text): string
    {
        foreach ($this->cookingStyles as $keyword => $style) {
            if (mb_stripos($text, $keyword) !== false) return $style;
        }
        return 'عام'; // لو ما عرف يحدد الطبخة
    }

    private function cleanName(string $name, string $lang): string
    {
        $removeAr = ['ربع ', 'نص ', 'نصف ', 'كاملة ', 'كامل ', 'دجاجة ', 'دجاج '];
        $removeEn = ['quarter ', 'half ', 'full ', 'whole ', 'chicken '];

        $words = $lang === 'ar' ? $removeAr : $removeEn;

        foreach ($words as $word) {
            $name = str_ireplace($word, '', $name);
        }

        return trim($name) ?: $name; // لو فضل فاضي ارجع الاصل
    }

    private function pickMainProduct(array $items): array
    {
        // نفضل الدجاجة الكاملة كمنتج رئيسي
        foreach ($items as $item) {
            if ($item['size'] === 'full') return $item;
        }
        // لو ما في كاملة، خد أول وحدة
        return $items[0];
    }

    private function createChickenOptions(int $productId): void
    {
        $options = [
            [
                'product_id'    => $productId,
                'name_ar'       => 'ربع دجاجة',
                'name_en'       => 'Quarter Chicken',
                'price'         => 49.00,
                'price_unit_ar' => 'درهم',
                'price_unit_en' => 'MAD',
                'sort_order'    => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_id'    => $productId,
                'name_ar'       => 'نص دجاجة',
                'name_en'       => 'Half Chicken',
                'price'         => 69.00,
                'price_unit_ar' => 'درهم',
                'price_unit_en' => 'MAD',
                'sort_order'    => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'product_id'    => $productId,
                'name_ar'       => 'دجاجة كاملة',
                'name_en'       => 'Whole Chicken',
                'price'         => 129.00,
                'price_unit_ar' => 'درهم',
                'price_unit_en' => 'MAD',
                'sort_order'    => 3,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];

        DB::table('product_options')->insert($options);
    }

    /**
     * Fallback: لو الأسماء ما فيها كلمات الحجم،
     * بس ما زلنا نبي نضيف الـ options على منتجات الدجاج
     */
    private function seedDefaultOptions(): void
    {
        // ابحث عن أي منتج فيه كلمة دجاج/chicken في اسمه
        $chickenProducts = Product::where(function($q) {
            $q->where('name_ar', 'like', '%دجاج%')
              ->orWhere('name_ar', 'like', '%دجاجة%')
              ->orWhere('name_en', 'like', '%chicken%')
              ->orWhere('name_en', 'like', '%Chicken%');
        })->get();

        foreach ($chickenProducts as $product) {
            if ($product->options()->count() > 0) continue;
            $this->createChickenOptions($product->id);
            $this->command->line("  ✅ [{$product->id}] {$product->name_ar} ← تم إضافة خيارات الحجم");
        }
    }
}