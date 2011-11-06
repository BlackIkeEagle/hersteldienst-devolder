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
				'name' => 'Belgacom Tv',
				'url' => 'http://www.belgacom.be/belgacom/be-nl/category/c_television_l.page?',
				'logo' => 'logos/belgacomtv.jpg'
			),
			array(
				'name' => 'Telenet Digitaal Tv',
				'url' => 'http://telenet.be/222/0/1/nl/thuis/televisie.html',
				'logo' => 'logos/telenetdigitaltv.jpg'
			),
		);
	}
}
