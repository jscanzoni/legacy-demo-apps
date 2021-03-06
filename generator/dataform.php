<?php

$settings = json_decode($config, true);
echo "<h2 style=\"text-align: left;\">3. First " . $settings["app_settings"]["recordName"] . "</h2>";
echo "<div style=\"text-align:left;\"><input id=\"firstData\" name=\"firstData\" type=\"submit\" value=\"Generate data.json from first record\" style=\"background-color: #008CBA; color:#FFFFFF;\"/></div><br>";
echo "<small>(This is what your data entry form is going to look like)</small><br>";
echo "<table style=\"border: 1px solid #000000;\">
            <tr>
                <td>";
echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"POST\">";
echo "<h3>**Hidden Fields**</h3>";
echo "<table>";
foreach ($settings["fields"]["hidden"] as $field) {
    echo "<tr><td style=\"padding:4px\"><strong><label for=\"$field\">";
    if (isset($settings["friendlyFieldNameOverrides"][$field]))
        echo $settings["friendlyFieldNameOverrides"][$field];
    else
        echo ucwords($field);
    echo "</label></strong></td>";
    echo "<td id=\"field-$field\" style=\"padding:4px\"><input type=\"text\" id=\"$field\" name=\"$field\" value=\"";
    if ($field == "id")
        echo intval($settings["app_settings"]["firstIdNumber"]);
    else
        echo $sample[$field];
    echo "\"></td></tr>";
}
echo "</table><br />";
foreach ($settings["fields"]["visible"] as $section => $items) {
    if ($section == "Line Items") {
        echo "<h3>" . $settings["app_settings"]["lineItemRecordNamePlural"] . " (" . count($sample["lineitems"]) . ")</h3>";
        echo "<input type=\"hidden\" id=\"numLines\" name=\"numLines\" value=\"" . count($sample["lineitems"]) . "\">";
        echo "<!--set number of lines as a GET variable using \"?n=" . count($sample["lineitems"]) . "\"-->";
        echo "<table width=\"100%\" style=\"background-color:#f5f5f5; text-align:center;\"><tr>";
        foreach ($items as $field) {
            echo "<th>";
            if (isset($settings["friendlyFieldNameOverrides"][$field]))
                echo $settings["friendlyFieldNameOverrides"][$field];
            else
                echo ucwords($field);
            echo "</th>";
        }
        echo "</tr>";
        foreach ($sample["lineitems"] as $key => $line) {
            echo "<tr style=\"border: 1px solid #666666;\">";
            foreach ($items as $field) {
                echo "<td id=\"lineitem-$key-field-$field\">";
                echo "<input type=\"text\" id=\"lineitem-$field".$key."\" name=\"lineitem-$field".$key."\" value=\"".$sample["lineitems"][$key][$field]."\">";
                echo "</td>";
                echo "</th>";
            }
            echo "</tr>";
        }
        echo "<tr style=\"border: 1px solid #666666;\"><td colspan=\"5\"><input id=\"new-lineitem\" name=\"new-lineitem\" type=\"submit\" value=\"Add ".$settings["app_settings"]["lineItemRecordName"]."\" /></td><tr>";
        echo "</table>";
    } else {
        echo "<h3>$section</h3>";
        echo "<table>";
        foreach ($items as $field) {
            echo "<tr><td style=\"padding:4px\"><strong><label for=\"$field\">";
            if (isset($settings["friendlyFieldNameOverrides"][$field]))
                echo $settings["friendlyFieldNameOverrides"][$field];
            else
                echo ucwords($field);
            echo "</label></strong></td>";
            echo "<td id=\"field-$field\" style=\"padding:4px\"><input type=\"text\" id=\"$field\" name=\"$field\" value=\"".$sample[$field]."\"></td></tr>";
        }
        echo "</table><br />";
    }
}


?>
</td>
</tr>
</table>