<?php
$filename = 'badge.png';
$htmlFile = 'https://vanakkamhrd.com/event_poster.php?designation=test&company=comp&id=1&name=siva';
//wkhtmltopdf https://vanakkamhrd.com/event_poster.php?designation=test&company=comp&id=1&name=siva temp/1.jpg
$out=exec('wkhtmltoimage --width 705 --height 705 --disable-smart-width --enable-local-file-access "https://vanakkamhrd.com/event_poster.php?designation=test&company=comp&id=1&name=siva" temp/2.jpg');
var_dump($out);
?>