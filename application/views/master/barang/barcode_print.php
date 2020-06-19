<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Barang</title>
</head>

<body>
    <h4>Barcode Barang.....</h4>
    <?php
    // This will output the barcode as HTML output to display in the browser
    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    
    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barangs->barcode, $generator::TYPE_CODE_128)) . '" style="width:200px">';
    ?>
    
    <br>
    <?= $barangs->barcode ?>
    
</body>

</html>