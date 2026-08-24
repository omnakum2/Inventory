<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Seeds all master data + a small, internally-consistent set of sample
 * transactions (category -> brand -> product -> stock -> bill -> bill_items).
 *
 * Idempotent: uses updateOrInsert keyed on unique columns, so it is safe to
 * run on every boot (Render free-tier SQLite is ephemeral and re-seeded).
 *
 * Admin credentials come ONLY from the environment (ADMIN_EMAIL / ADMIN_PASSWORD
 * / ADMIN_NAME) — never hardcoded — so no secret ever lives in source control.
 */
class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // ---------------- ADMIN (credentials strictly from env) ----------------
        $adminEmail    = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');

        if (empty($adminEmail) || empty($adminPassword)) {
            throw new \RuntimeException(
                'ADMIN_EMAIL and ADMIN_PASSWORD environment variables are required to seed the admin user.'
            );
        }

        DB::table('users')->updateOrInsert(
            ['email' => $adminEmail],
            [
                'name'       => env('ADMIN_NAME', 'Administrator'),
                'password'   => Hash::make($adminPassword),
                'role_as'    => 1,
                'updated_at' => $now,
                'created_at' => $now,
            ]
        );
        $adminId = DB::table('users')->where('email', $adminEmail)->value('id');

        // ---------------- CATEGORIES ----------------
        foreach (['Smartphones', 'Accessories', 'Tablets'] as $name) {
            DB::table('category')->updateOrInsert(
                ['category_name' => $name],
                ['status' => 1, 'updated_at' => $now, 'created_at' => $now]
            );
        }
        $catId = fn ($n) => DB::table('category')->where('category_name', $n)->value('id');

        // ---------------- BRANDS ----------------
        foreach (['Samsung', 'Apple', 'Xiaomi', 'OnePlus'] as $name) {
            DB::table('brand')->updateOrInsert(
                ['brand_name' => $name],
                ['status' => 1, 'updated_at' => $now, 'created_at' => $now]
            );
        }
        $brandId = fn ($n) => DB::table('brand')->where('brand_name', $n)->value('id');

        // ---------------- WAREHOUSES ----------------
        foreach (['Main Store', 'Secondary Warehouse'] as $name) {
            DB::table('wharehouse')->updateOrInsert(
                ['name' => $name],
                ['status' => 1, 'updated_at' => $now, 'created_at' => $now]
            );
        }
        $mainWh = DB::table('wharehouse')->where('name', 'Main Store')->value('id');

        // ---------------- PRODUCTS (6) + STOCK ----------------
        $products = [
            ['code' => 'SM-S24',   'name' => 'Galaxy S24',    'description' => 'Samsung Galaxy S24 128GB',     'category' => 'Smartphones', 'brand' => 'Samsung', 'price' => 74999, 'qty' => 25],
            ['code' => 'AP-IP15',  'name' => 'iPhone 15',     'description' => 'Apple iPhone 15 128GB',         'category' => 'Smartphones', 'brand' => 'Apple',   'price' => 79999, 'qty' => 18],
            ['code' => 'XM-RN13',  'name' => 'Redmi Note 13', 'description' => 'Xiaomi Redmi Note 13 6/128GB',  'category' => 'Smartphones', 'brand' => 'Xiaomi',  'price' => 17999, 'qty' => 60],
            ['code' => 'OP-12',    'name' => 'OnePlus 12',    'description' => 'OnePlus 12 16/256GB',           'category' => 'Smartphones', 'brand' => 'OnePlus', 'price' => 64999, 'qty' => 15],
            ['code' => 'AP-APDS',  'name' => 'AirPods Pro 2', 'description' => 'Apple AirPods Pro 2nd Gen',      'category' => 'Accessories', 'brand' => 'Apple',   'price' => 24999, 'qty' => 40],
            ['code' => 'SM-TABS9', 'name' => 'Galaxy Tab S9', 'description' => 'Samsung Galaxy Tab S9 11-inch', 'category' => 'Tablets',     'brand' => 'Samsung', 'price' => 69999, 'qty' => 10],
        ];

        foreach ($products as $p) {
            DB::table('product')->updateOrInsert(
                ['code' => $p['code']],
                [
                    'name'        => $p['name'],
                    'description' => $p['description'],
                    'category_id' => $catId($p['category']),
                    'brand_id'    => $brandId($p['brand']),
                    'price'       => $p['price'],
                    'status'      => 1,
                    'updated_at'  => $now,
                    'created_at'  => $now,
                ]
            );

            DB::table('stock')->updateOrInsert(
                ['product_code' => $p['code'], 'wharehouse_id' => $mainWh],
                ['quantity' => $p['qty'], 'updated_at' => $now, 'created_at' => $now]
            );
        }

        // ---------------- BILLS (2, consistent, owned by admin) ----------------
        $this->seedBill($adminId, 'Rahul Sharma', '9876543210', [
            ['code' => 'XM-RN13', 'price' => 17999, 'qty' => 2],
            ['code' => 'AP-APDS', 'price' => 24999, 'qty' => 1],
        ], $now);

        $this->seedBill($adminId, 'Priya Patel', '9812345678', [
            ['code' => 'AP-IP15', 'price' => 79999, 'qty' => 1],
        ], $now);
    }

    /**
     * Seed one bill + its items. Idempotent on customer_phone.
     */
    private function seedBill($userId, string $customer, string $phone, array $items, $now): void
    {
        $amount = 0;
        foreach ($items as $it) {
            $amount += $it['price'] * $it['qty'];
        }

        DB::table('bill')->updateOrInsert(
            ['customer_phone' => $phone],
            [
                'user_id'       => $userId,
                'customer_name' => $customer,
                'amount'        => $amount,
                'updated_at'    => $now,
                'created_at'    => $now,
            ]
        );
        $billId = DB::table('bill')->where('customer_phone', $phone)->value('id');

        // Rebuild line items so totals stay consistent on re-seed.
        DB::table('bill_items')->where('bill_id', $billId)->delete();
        foreach ($items as $it) {
            DB::table('bill_items')->insert([
                'product_code'     => $it['code'],
                'product_price'    => $it['price'],
                'product_quantity' => $it['qty'],
                'total'            => $it['price'] * $it['qty'],
                'bill_id'          => $billId,
                'updated_at'       => $now,
                'created_at'       => $now,
            ]);
        }
    }
}
