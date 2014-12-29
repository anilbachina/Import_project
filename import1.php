<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 12/10/2014
 * Time: 4:27 PM
 */
error_reporting(E_ALL);
include_once('settings.php');

class Import
{

    function init()
    {
        $page_content = file_get_contents("template/index.html");
        echo $page_content;
    }

    function run()
    {
        global $DB_COLUMNS,$COLUMN_ROW,$DB_COLUMN,$DB_COL_DROP_DOWN,$TABLE_ROW;

        $data = $_POST['datarows'];
        $col_sep = $_POST['col_sep'];

        if (!$data) {
            echo "Please copy data to start import! ";
            return;
        }

        $data_rows = explode("\n", $data);
        $data_col1 = "";
        $data_col2 = "";
        $data_col3 = "";
        $col_count = 0;

        if($col_sep == 1)
            $columnSeparator = "|";
        elseif ($col_sep == 2)
            $columnSeparator = "\t";
        elseif ($col_sep == 3)
            $columnSeparator = "\n";
        else
            $columnSeparator = "\t";

        foreach ($data_rows as $data_row) {
            $data_cols = explode($columnSeparator, $data_row);
            $display_row_count = count($data_cols);
            break;
        }
        $i = 0;
        foreach ($data_rows as $data_row) {
            $data_cols = explode($columnSeparator, $data_row);

            for($j=0; $j<count($data_cols); $j++)
            {
                $table[$j][$i] = $data_cols[$j];
            }
            $i++;
        }

        for($i=0; $i<count($table); $i++)
        {
            for($j=0; $j<3; $j++)
            {
                if( preg_match("/http/i",$table[$i][$j]))
                {
                    $image_url_column = '';

                    $table[$i][$j] = str_replace('"', "", $table[$i][$j]);

                    $imageUrls = explode(",", $table[$i][$j]);
                    $k = 1;
                    foreach($imageUrls as $imageUrl)
                    {
                        $image_url_column .= "<a href={$imageUrl} onClick='return popitup(\"{$imageUrl}\")'>Photo{$k} </a>";
                        $k++;
                    }

                    $table[$i][$j] = $image_url_column;
                }
            }
        }

        $drop_down_col = "";
        $db_cols = explode(",", $DB_COLUMNS);
        foreach ($db_cols as $db_col)
            $drop_down_col .= str_replace("<!--DB_COLUMN_NAME-->", $db_col, $DB_COLUMN);

        $table_row = "";
        for($i=0;$i<$display_row_count;$i++)
        {
            $table_row_col1 = str_replace("<!--DB_COLUMN_OPTIONS-->", $drop_down_col, $TABLE_ROW);
            $table_row_col2 = str_replace("<!--COLUMN2-->", $table[$i][0], $table_row_col1);
            $table_row_col3 = str_replace("<!--COLUMN3-->", $table[$i][1], $table_row_col2);
            $table_row_col4 = str_replace("<!--COLUMN4-->", $table[$i][2], $table_row_col3);

            $table_row .= $table_row_col4;
        }



        /*foreach ($data_rows as $data_row) {
            $data_cols = explode($columnSeparator, $data_row);

            $local_col = '';
            foreach ($data_cols as $data_col)
			{
                if( preg_match("/imageserver/i",$data_col) )
                {
                    $image_url_column = '';

					$data_col = str_replace('"', "", $data_col);

                    $imageUrls = explode(",", $data_col);
					$i = 1;
                    foreach($imageUrls as $imageUrl)
                    {
                        $image_url_column .= "<a href={$imageUrl} target=_blank>Photo{$i} </a>";
						$i++;
                    }

                    $local_col .= str_replace("<!--COLUMN_NAME-->", $image_url_column, $COLUMN_ROW);
                }
                else
                    $local_col .= str_replace("<!--COLUMN_NAME-->", substr($data_col, 0, 25), $COLUMN_ROW);
			}

            if (!$data_col1) {
                $data_col1 .= $local_col;
                $col_count = sizeof($data_cols);
            } elseif (!$data_col2)
                $data_col2 .= $local_col;
            elseif (!$data_col3)
                $data_col3 .= $local_col;
            else break;
        }

        $drop_down_col = "";
        $db_cols = explode(",", $DB_COLUMNS);
        foreach ($db_cols as $db_col)
            $drop_down_col .= str_replace("<!--DB_COLUMN_NAME-->", $db_col, $DB_COLUMN);
        $drop_down = str_replace("<!--DB_COLUMN_OPTIONS-->", $drop_down_col, $DB_COL_DROP_DOWN);

        $drop_down_list = "";
        for ($count = 0; $count < $col_count; $count++)
            $drop_down_list .= $drop_down;*/

        $page_content = file_get_contents("template/mapper.html");
        $page_content = str_replace("<!--TABLE_CONTENTS-->", $table_row, $page_content);

        echo $page_content;

    }

}


$imp = new Import();
$imp->run();

?>