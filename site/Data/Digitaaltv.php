<?php
class Data_Digitaaltv {
	public function getSuppliersSatellite() {
		return array(
			array(
				'name' => 'TV Vlaanderen',
				'url' => 'https://www.tv-vlaanderen.be',
				'logo' => 'logos/tvvlaanderen.jpg'
			),
			array(
				'name' => 'Telesat',
				'url' => 'https://www.telesat.be',
				'logo' => 'logos/telesat.jpg'
			),
		);
	}

	public function getSuppliersCable() {
		return array(
			array(
				'name' => 'Proximus Tv',
				'url' => 'https://www.proximus.be/pickx/nl',
				'logo' => 'logos/proximus.png'
			),
			array(
				'name' => 'Telenet Digitaal Tv',
				'url' => 'https://www2.telenet.be/residential/nl/producten/telenet-tv/',
				'logo' => 'logos/telenetdigitaltv.jpg'
			),
		);
	}
}
