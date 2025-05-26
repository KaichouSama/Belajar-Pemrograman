<?php
class Book {
    private $code_book;
    private $name;
    private $qty;

    public function __construct($code_book, $name, $qty) {
        $this->setCodeBook($code_book);
        $this->name = $name;
        $this->setQty($qty);
    }

    // Setter privat
    private function setCodeBook($code_book) {
        if (preg_match('/^[A-Z]{2}[0-9]{2}$/', $code_book)) {
            $this->code_book = $code_book;
        } else {
            echo "Format code_book tidak valid. Gunakan format BB00.\n";
        }
    }

    private function setQty($qty) {
        if (is_int($qty) && $qty > 0) {
            $this->qty = $qty;
        } else {
            echo "Qty harus bilangan bulat positif.\n";
        }
    }

    // Getter
    public function getCodeBook() {
        return $this->code_book;
    }

    public function getQty() {
        return $this->qty;
    }

    public function getName() {
        return $this->name;
    }
}

// Contoh penggunaan:
$book1 = new Book("AB12", "Pemrograman PHP", 10);
echo "Kode Buku: " . $book1->getCodeBook() . "\n";
echo "Judul: " . $book1->getName() . "\n";
echo "Qty: " . $book1->getQty() . "\n";
?>
