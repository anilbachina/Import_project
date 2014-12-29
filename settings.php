<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 12/11/2014
 * Time: 12:47 PM
 */

$DB_COLUMNS= 'column1,column2,column3,column4,column5,column6,column7,column8,column9,column10,column11,column12,column13,column14,column15,column16,column17,column18,column19,column20';

$COLUMN_ROW = '<p class="form-control-static"><!--COLUMN_NAME--></p>';

$DB_COLUMN = '<option value="<!--DB_COLUMN_NAME-->"><!--DB_COLUMN_NAME--></option>';

$DB_COL_DROP_DOWN = '<select name="" id="input" class="form-control" required="required">
                                <option value="none">None</option>
                                <!--DB_COLUMN_OPTIONS-->
                            </select>';

$TABLE_ROW = '<tr><td><select name="selected_values" id="input" class="form-control" required="required">
                                <option value="Ignore" selected>Ignore</option>
                                <!--DB_COLUMN_OPTIONS-->
                            </select></td>
                  <td class="bg-info"><p class="form-control-static" title="<!--COLUMN2-->"><!--COLUMN2--></p></td>
                  <td class="bg-warning"><p class="form-control-static" title="<!--COLUMN3-->"><!--COLUMN3--></p></td>
                  <td class="bg-success"><p class="form-control-static" title="<!--COLUMN4-->"><!--COLUMN4--></p></td>
              </tr>';

$TABLE_ROW1 = '<tr><td><p class="form-control-static"><!--COLUMN1--></p></td>
                  <td class="bg-info"><p class="form-control-static"><!--COLUMN2--></p></td>
                  <td class="bg-warning"><p class="form-control-static"><!--COLUMN3--></p></td>
                  <td class="bg-success"><p class="form-control-static"><!--COLUMN4--></p></td>
              </tr>';