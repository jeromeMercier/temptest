<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder {

	public function run() {

		DB::table('categories')->delete();

		$categories_en = [
			'Domestic help',
			'Babysitting',
			'Scientific experiment',
			'IT',
			'Office work',
			'Flyering',
			'Administrative work',
			'Studies/experiment',
			'Public relations',
			'Restaurant / Hotel work',
			'Tutoring',
			'Other',
		];

		$categories_fr = [
			'Aide à domicile',
			'Babysitting',
			'Expériences',
			'Informatique',
			'Job de bureau',
			'Flyering',
			'Administratif',
			'Etudes/expériences',
			'Promotion',
			'Restauration / Hôtellerie',
			'Soutien scolaire',
			'Autre',
		];

		for ($i = 0; $i < sizeof($categories_en); $i++) {
			$category = new Category;

			$category->name_en = current($categories_en);
			$category->name_fr = current($categories_fr);

			next($categories_en);
			next($categories_fr);

			$category->save();
		}
	}
}
