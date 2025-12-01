<?php
/**
 * Program memanfaatkan Class Form untuk membuat form inputan sederhana.
 * Contoh implementasi Class Library Form
 **/

// Include class Form
include "lib/Form.php";

echo "<html><head><title>Mahasiswa</title>";
echo "<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px;
}
.container {
    max-width: 600px;
    margin: 50px auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
h3 {
    color: #667eea;
    text-align: center;
}
table {
    margin: 20px auto;
}
td {
    padding: 10px;
}
input[type='text'] {
    width: 100%;
    padding: 8px;
    border: 2px solid #e5e7eb;
    border-radius: 5px;
    font-size: 14px;
}
input[type='text']:focus {
    outline: none;
    border-color: #667eea;
}
input[type='submit'] {
    background: #667eea;
    color: white;
    padding: 10px 30px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}
input[type='submit']:hover {
    background: #764ba2;
}
</style>";
echo "</head><body>";

echo "<div class='container'>";
echo "<h3>📝 Silahkan isi form berikut ini :</h3>";

// Membuat instance class Form
$form = new Form("", "Input Form");
$form->setClass(""); // Kosongkan class default

// Menambahkan field menggunakan method addField
$form->addTextField("txtnim", "Nim");
$form->addTextField("txtnama", "Nama");
$form->addTextField("txtalamat", "Alamat");

// Tampilkan form
$form->displayForm();

echo "</div>";
echo "</body></html>";
?>