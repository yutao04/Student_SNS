<?php

include __DIR__ . '/../php_inc/header.php';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/php/open_list_style.css">
    <title>Discord-like Site</title>
    
</head>
    <body>
    	<div class="cp_tab">
	<input type="radio" name="cp_tab" id="tab1_1" aria-controls="first_tab01" checked>
	<label for="tab1_1">First Tab</label>
	<input type="radio" name="cp_tab" id="tab1_2" aria-controls="second_tab01">
	<label for="tab1_2">Second Tab</label>
	<input type="radio" name="cp_tab" id="tab1_3" aria-controls="third_tab01">
	<label for="tab1_3">Third Tab</label>
	<input type="radio" name="cp_tab" id="tab1_4" aria-controls="force_tab01">
	<label for="tab1_4">Force Tab</label>
	<div class="cp_tabpanels">
		<div id="first_tab01" class="cp_tabpanel">
			<div class="tab-content">
            <?php include __DIR__ . '/open_all.php'; ?>
            </div>
		</div>
		<div id="second_tab01" class="cp_tabpanel">
		<h2>Second Tab</h2>
		<p>Second Tab text</p>
		</div>
		<div id="third_tab01" class="cp_tabpanel">
		<h2>Third Tab</h2>
		<p>Third Tab text</p>
		</div>
		<div id="force_tab01" class="cp_tabpanel">
		<h2>Force Tab</h2>
		<p>Force Tab text</p>
		</div>
	</div>
</div>
    
    <?php include __DIR__ . '/../php_inc/footer.php'; // フッターの読み込み ?>

</body>
</html>