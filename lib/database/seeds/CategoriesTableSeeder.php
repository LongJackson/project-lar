<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'category_name' => 'iPhone',
                'category_slug' => str_slug('iPhone')],
        [
            'category_name' => 'Samsung',
            'category_slug' => str_slug('Samsung')]];

        DB::table('vp_categories')->insert($data);
    }
}
