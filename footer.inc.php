<?php
gtd_handleEvent(_GTD_ON_FOOTER,$pagename);
include 'showMessage.inc.php';
?>
<div id='debuglog'></div>
</div><!-- main -->
</div><!-- container -->
<div id='footer'>
<?php
    global $totalquerytime,$starttime;
    
    if(!empty($totalquerytime))
        echo 'Database: '
            ,(int) ($totalquerytime*1000+0.5)
            ,'ms&nbsp;&nbsp;+&nbsp;';

    if(!empty($starttime)) {
        list($usec, $sec) = explode(" ", microtime());
        $tottime=(int) (((float)$usec + (float)$sec - $starttime-$totalquerytime)*1000+0.5);
        echo "PHP: {$tottime}ms;&nbsp;&nbsp;&nbsp;&nbsp;";
    }
        
    echo 'gtd-php database:',_GTD_VERSION,', package:',_GTDPHP_VERSION,' rev',_GTD_REVISION;
?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>
</html>
