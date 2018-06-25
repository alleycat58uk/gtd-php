<?php
$title='shortcut keys';
$menu='';
require_once 'headerHtml.inc.php';
@ob_start();
require_once 'headerMenu.inc.php';
$menutext=ob_get_contents();
ob_end_clean();
?>
</head><body>
<div class='noprint'>
    <?php echo $menutext; ?>
</div>
<div id='main'>
<h2>Shortcut keys for gtd-php</h2>
<table summary='Shortcut keys'>
<thead><tr><th>key</th><th>title</th><th>description</th></tr></thead>
<tbody>
<?php
foreach ($menu as $line)
    if (!empty($line['key']))
        echo "<tr>"
            ,"<td>{$line['key']}</td>"
            ,"<td>{$line['label']}</td>"
            ,"<td>{$line['title']}</td>"
            ,"</tr>";
?>
</tbody>
</table>

</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>

</html>
