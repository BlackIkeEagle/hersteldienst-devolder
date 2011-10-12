<?php
class Data_Verkoop {
	public function getSuppliersAudio() {
		return array(
			array(
				'name' => 'Yamaha',
				'url' => 'http://www.yamaha-online.de/',
				'logo' => 'logos/yamaha.jpg'
			),
			array(
				'name' => 'Panasonic',
				'url' => 'http://www.panasonic.be/',
				'logo' => 'logos/panasonic.gif'
			),
			array(
				'name' => 'Jb Systems',
				'url' => 'http://www.beglec.com/',
				'logo' => 'logos/jbsystems.jpg'
			),
		);
	}

	public function getSuppliersTelevision() {
		return array(
			array(
				'name' => 'Philips',
				'url' => 'http://www.philips.be/',
				'logo' => 'logos/philips.gif'
			),
			array(
				'name' => 'Panasonic',
				'url' => 'http://www.panasonic.be/',
				'logo' => 'logos/panasonic.gif'
			),
			array(
				'name' => 'Sony',
				'url' => 'http://www.sony.be/',
				'logo' => 'logos/sony.gif'
			),
			array(
				'name' => 'Samsung',
				'url' => 'http://www.samsung.com/be/',
				'logo' => 'logos/samsung.jpg'
			),
			array(
				'name' => 'LG',
				'url' => 'http://www.lg.com/be_ne/',
				'logo' => 'logos/lg.jpg'
			),
		);
	}

	public function getSuppliersSatellite() {
		return array(
			array(
				'name' => 'Rebox',
				'url' => 'http://www.rebox.tv/p/homepage-rebox',
				'logo' => 'logos/rebox.jpg'
			),
			array(
				'name' => 'SAB',
				'url' => 'http://www.sabsatellite.nl/nl/downloads',
				'logo' => 'logos/sab.jpg'
			),
			array(
				'name' => 'Technomate',
				'url' => 'http://www.technomate.com/software_updates.php',
				'logo' => 'logos/technomate.jpg'
			),
		);
	}
}
