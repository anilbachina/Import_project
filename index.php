<?php
error_reporting(E_ALL);

/**
 * Created by PhpStorm.
 * User: anil
 * Date: 12/9/2014
 * Time: 8:45 AM
 */
class App
{

    function Run($file_name,$delimiter)
    {
        $COLUMN_HEAD = '<th><!--COLUMN_DATA--></th>';
        $COLUMN_DATA = '<td><!--COLUMN_DATA--></td>';
        $row_count=0;
        $table_heads = $table_data = "";

        if (file_exists($file_name) && is_readable($file_name)) {
            $fp = @fopen($file_name, 'r');
            while (!feof($fp))
            {
                $row_count++;
                $data_cols = str_getcsv(fgets($fp,100001), $delimiter);
                $local_row = '';
                if( count($data_cols) > 3 ) { // This is in place to take out rows created by new lines characters in the Comments Col
                    foreach ($data_cols as $data_col)
                        $local_row .= str_replace("<!--COLUMN_DATA-->", substr($data_col, 0, 50), ($table_heads ? $COLUMN_DATA : $COLUMN_HEAD));

                    if (!$table_heads)
                    {
                        $local_row = "<th>SNO</th>" .$local_row;
                        $table_heads = "<tr>{$local_row}</tr>";
                    }
                    else
                    {
                        $serial_number = $row_count - 1;
                        $local_row = "<td>$serial_number</td>".$local_row;
                        $table_data .= "<tr>{$local_row}</tr>";
                    }

                    if ($row_count >= 3000)
                        break;
                }
            }
            fclose($fp);
            $page_content = file_get_contents("template/import_view.html");
            $page_content = str_replace("<!--ROW_COUNT-->", $row_count, $page_content);
            $page_content = str_replace("<!--TABLE_HEADERS-->", $table_heads, $page_content);
            $page_content = str_replace("<!--TABLE_DATA-->", $table_data, $page_content);
            echo $page_content;
        } else echo "The File (" . $file_name . ") Doesn't exits! or it is not readable.";
    }


}

$app = new App();
$app->Run('csoup_inv.txt',"\t");

?>


