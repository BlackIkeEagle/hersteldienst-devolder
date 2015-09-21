<?php
class Data_Digitaaltv {
	public function getSuppliersSatellite() {
		return array(
			array(
				'name' => 'TV Vlaanderen',
				'url' => 'http://www.tv-vlaanderen.be/',
				'logo' => 'logos/tvvlaanderen.jpg'
			),
			array(
				'name' => 'Telesat',
				'url' => 'http://www.telesat.be/',
				'logo' => 'logos/telesat.jpg'
			),
		);
	}

	public function getSuppliersCable() {
		return array(
			array(
				'name' => 'Proximus Tv',
				'url' => 'http://www.proximustv.be/',
				'logo' => 'logos/proximus.png'
			),
			array(
				'name' => 'Telenet Digitaal Tv',
				'url' => 'https://www2.telenet.be/nl/tv-en-entertainment',
				'logo' => 'logos/telenetdigitaltv.jpg'
			),
		);
	}
}
