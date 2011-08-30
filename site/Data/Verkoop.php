<?php
class Data_Verkoop {
	public function getSuppliersAudio() {
		return array(
			array(
				'name' => 'yamaha',
				'url' => 'http://www.yamaha-online.de/',
				'logo' => 'logos/yamaha.jpg'
			),
			array(
				'name' => 'panasonic',
				'url' => 'http://www.panasonic.be/',
				'logo' => 'logos/panasonic.gif'
			),
			array(
				'name' => 'Jb Systems',
				'url' => 'http://www.beglec.com/',
				'logo' => 'logos/jbsystems.jpg'
			)
		);
	}

	public function getSuppliersTelevision() {
	}

	public function getSuppliersSatellite() {
	}
}
