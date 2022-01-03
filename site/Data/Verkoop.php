<?php
class Data_Verkoop {
	public function getSuppliersAudio() {
		return array(
			array(
				'name' => 'Yamaha',
				'url' => 'https://nl.yamaha.com/nl/products/audio_visual/',
				'logo' => 'logos/yamaha.jpg'
			),
			array(
				'name' => 'Panasonic',
				'url' => 'https://www.panasonic.com/be/nl/',
				'logo' => 'logos/panasonic.jpg'
			),
			array(
				'name' => 'Jb Systems',
				'url' => 'https://beglec.com',
				'logo' => 'logos/jbsystems.jpg'
			),
		);
	}

	public function getSuppliersTelevision() {
		return array(
			array(
				'name' => 'Philips',
				'url' => 'https://www.philips.be',
				'logo' => 'logos/philips.jpg'
			),
			array(
				'name' => 'Panasonic',
				'url' => 'https://www.panasonic.com/be/nl/',
				'logo' => 'logos/panasonic.jpg'
			),
			array(
				'name' => 'Sony',
				'url' => 'https://www.sony.be/nl',
				'logo' => 'logos/sony.jpg'
			),
			array(
				'name' => 'Samsung',
				'url' => 'https://www.samsung.com/be/',
				'logo' => 'logos/samsung.jpg'
			),
			array(
				'name' => 'LG',
				'url' => 'https://www.lg.com/nl',
				'logo' => 'logos/lg.jpg'
			),
		);
	}

	public function getSuppliersSatellite() {
		return array(
			array(
				'name' => 'Rebox',
				'url' => 'https://www.rebox.tv',
				'logo' => 'logos/rebox.jpg'
			),
			array(
				'name' => 'SAB',
				'url' => 'https://www.sabsatellite.nl/nl',
				'logo' => 'logos/sab.jpg'
			),
			array(
				'name' => 'Technomate',
				'url' => 'https://www.technomate.com',
				'logo' => 'logos/technomate.jpg'
			),
		);
	}
}
