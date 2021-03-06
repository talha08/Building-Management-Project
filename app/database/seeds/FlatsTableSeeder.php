<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FlatsTableSeeder extends Seeder {

	public function run()
	{


		$flats = [


			'name' => 'A1',
			'rent_amount' => '23000',
			'payment_status' => false,
			'flat_details' => 'A wiki is run using wiki software, otherwise known as
								a wiki engine. There are dozens of different wiki engines in use, both standalone
							 and part of other software, such as bug tracking systems. Some wiki engines are
							open source, whereas others are proprietary. Some permit control over different
								  functions (levels of access); for example, editing rights may permit changing,
			  					adding or removing material. Others may permit access without enforcing access
			 					 control. Other rules may also be imposed to organize content. A wiki engine
			 				 is a type of content management system, but it differs from most other such systems,
			 				  including blog software, in that the content is created without any defined owner
			  				 or leader, and wikis have little implicit structure,
			 					 allowing structure to emerge according to the needs of the users.[2]',


			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')


		];
		DB::table('flats')->insert($flats);
	}

}
