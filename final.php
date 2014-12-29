<?php
error_reporting(E_ALL);
include_once('settings.php');

class Finalize
{
    function run()
    {
        global $TABLE_ROW1;
        $importTableData = $_POST['importTableData'];
        // Unescape the string values in the JSON array
        //$importTableData = str_replace("\n", '', $importTableData);

        // Decode the JSON array
        $tableData1 = json_decode($importTableData, TRUE);
        // now $tableData can be accessed like a PHP array

        //echo $tableData1[1][0];

        $table_row = "";

        for($i=0; $i<count($tableData1); $i++)
        {
            for($j=0; $j<4; $j++)
            {
                if( preg_match("/http/i",$tableData1[$i][$j]))
                {
                    $image_url_column = '';

                    $tableData1[$i][$j] = str_replace('"', "", $tableData1[$i][$j]);

                    $imageUrls = explode(",", $tableData1[$i][$j]);
                    $k = 1;
                    foreach($imageUrls as $imageUrl)
                    {
                        $image_url_column .= "<a href={$imageUrl} onClick='return popitup(\"{$imageUrl}\")'>Photo{$k} </a>";
                        $k++;
                    }

                    $tableData1[$i][$j] = $image_url_column;
                }
            }
        }

        for($i=0;$i<count($tableData1);$i++)
        {
            if(@$tableData1[$i][0] != 'Ignore'){
                $table_row_col1 = str_replace("<!--COLUMN1-->", @$tableData1[$i][0], $TABLE_ROW1);
                $table_row_col2 = str_replace("<!--COLUMN2-->", @$tableData1[$i][1], $table_row_col1);
                $table_row_col3 = str_replace("<!--COLUMN3-->", @$tableData1[$i][2], $table_row_col2);
                $table_row_col4 = str_replace("<!--COLUMN4-->", @$tableData1[$i][3], $table_row_col3);

                $table_row .= $table_row_col4;
            }
        }

        $page_content = file_get_contents("template/final_view.html");
        $page_content = str_replace("<!--TABLE_CONTENTS-->", $table_row, $page_content);
        echo $page_content;
    }
}

$final = new Finalize();
$final->run();

?>