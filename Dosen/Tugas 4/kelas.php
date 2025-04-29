<?php
class Mobil {
    public $merk;
    public $tahun;

    function __construct($merk, $tahun) {
        $this->merk = $merk;
        $this->tahun = $tahun;
    }

    function getInfo() {
        return "Mobil: " . $this->merk . ", Tahun: " . $this->tahun;
    }
}

$mobilSaya = new Mobil("Toyota", 2020);
echo $mobilSaya->getInfo();
?>
