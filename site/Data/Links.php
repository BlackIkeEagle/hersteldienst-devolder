<?php
class Data_Links {
	public function getSuppliersAudioVideo() {
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
			array(
				'name' => 'Philips',
				'url' => 'http://www.philips.be/',
				'logo' => 'logos/philips.gif'
			),
			array(
				'name' => 'Sony',
				'url' => 'http://www.sony.be/',
				'logo' => 'logos/sony.gif'
			),
		);
	}

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
			array(
				'name' => 'Rebox',
				'url' => 'http://www.rebox.tv',
				'logo' => 'logos/rebox.jpg'
			),
			array(
				'name' => 'SAB',
				'url' => 'http://www.sabsatellite.nl/nl',
				'logo' => 'logos/sab.jpg'
			),
			array(
				'name' => 'Technomate',
				'url' => 'http://www.technomate.com/',
				'logo' => 'logos/technomate.jpg'
			),
		);
	}

	public function getSuppliersCable() {
		return array(
			array(
				'name' => 'Belgacom Tv',
				'url' => 'http://www.belgacomtv.be/',
				'logo' => 'logos/belgacomtv.jpg'
			),
			array(
				'name' => 'Telenet Digitaal Tv',
				'url' => 'http://telenet.be/222/0/1/nl/thuis/televisie.html',
				'logo' => 'logos/telenetdigitaltv.jpg'
			),
		);
	}

	public function getSuppliersOther() {
		return array(
			array(
				'name' => 'Start.be',
				'url' => 'http://oostkamp.start.be',
				'logo' => 'logos/startbe.gif'
			)
		);
	}
}