<?php

//query function
//SQL abstraction layer

function query($querylabel,$config,$values=NULL,$options=NULL,$sort=NULL) {

    //for developer testing only--- testing data handling
    //testing passed variables
    if ($config['debug']=="developer") {
        echo "<p><b>Query label: ".$querylabel."</b><br />";
        echo "<pre>Config: ";
        print_r($config);
        echo "<br />Values: ";
        print_r($values);
        echo "<br />Options: ";
        print_r($options);
        echo "<br />Sort: ";
        print_r($sort);
        echo "</pre></p>";
    }
/*
    //sanitize input variables
    echo "<p>Sanitizing...</p>\n";

    //testing after sanitization
    echo "<p>Query label: ".$querylabel."<br />";
    echo "Config: ";
    print_r($config);
    echo "<br />Options: ";
    print_r($options);
    echo "<br />Values: ";
    print_r($values);
    echo "</p>";

    //parse options array (logic)
        //sort order
        //single NA or not?
        //others

*/

    //include correct SQL query library as chosen in config
    switch ($config['dbtype']) {
        case "frontbase":require("frontbase.inc.php");
        break;
        case "msql":require("msql.inc.php");
        break;
        case "mysql":require("mysql.inc.php");
        break;
        case "mssql":require("mssql.inc.php");
        break;
        case "postgres":require("postgres.inc.php");
        break;
        case "sqlite":require("sqlite.inc.php");
        break;
        }

    //grab correct query string from query library array
    //values automatically inserted into array
    $query = $sql[$querylabel];

    // for testing only: display fully-formed query
    if ($config['debug']=="developer") echo "<p>Query: ".$query."</p>";

    //perform query
   //parse result into multitdimensional array $result[row#][field name] = field value
    if($config['dbtype']=="mysql") {
        $reply = mysql_query($query) or die (($config['debug']=="true" || $config['debug']=="developer") ? "Error in query: ". $querylabel."<br />".mysql_error():"Error in query");

        if (@mysql_num_rows($reply)>0) {
            $i = 0;
           while ($field = mysql_fetch_field($reply)) {
                /* Create an array $fields which contains all of the column names */
                $fields[$i] = $field->name;
                $i++;
                }
            $ii = 0;
            while ($mysql_result = mysql_fetch_array($reply)) {
                /*populate array with result data */
                foreach ($fields as $value) {
                    $result[$ii][$value] = $mysql_result[$value];
                    }
                $ii++;
                }
            }
        else $result="-1";

        //always included; text/codes shown in errors on individual pages as warranted...
        $GLOBALS['ecode'] = mysql_errno();
        $GLOBALS['etext'] = mysql_error();
//        mysql_close($connection);
        }

    elseif($config['dbtype']=="postgres") {
        $reply = pg_query($query) or die ($config['debug']=="true" ? "Error in query: ". $querylabel."<br />".pg_error():"Error in query");
        echo ("Database not yet supported.");
         }

    elseif($config['dbtype']=="sqlite") {
        $reply = sqllite_query($query)  or die ($config['debug']=="true" ? "Error in query: ". $querylabel."<br />".sqllite_error():"Error in query");
        echo ("Database not yet supported.");
        }

    elseif($config['dbtype']=="msql") {
        $reply = msql_query($query) or die ($config['debug']=="true" ? "Error in query: ". $querylabel."<br />".msql_error():"Error in query");
        echo ("Database not yet supported.");
        }

    elseif($config['dbtype']=="mssql") {
        $reply = mssql_query($query) or die ($config['debug']=="true" ? "Error in query: ". $querylabel."<br />".mssql_error():"Error in query");
        echo ("Database not yet supported.");
        }

    elseif($config['dbtype']=="frontbase") {
        $reply = fbsql_query($query) or die ($config['debug']=="true" ? "Error in query: ". $querylabel."<br />".fbsql_error():"Error in query");
        echo ("Database not yet supported.");
        }

    else die("Database type not configured.  Please edit the config.php file.");

    //for developer testing only, print result array
    if ($config['debug']=="developer") {
        echo "<pre>Result: ";
        print_r($result);
        echo "</pre>";
        }

    return $result;
    }

?>