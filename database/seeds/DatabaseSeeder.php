
<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
			Model::unguard();
			$this->call([
	        CategoriesTableSeeder::class,
	        PublishersTableSeeder::class,

					AdsTableSeeder::class, // depend on both previous

					FAQSeeder::class,
	    ]);
			Model::reguard();
    }
}
