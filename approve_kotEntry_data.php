<?php

session_start();


require_once ("connection_sql.php");

header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "getdt") {

//
//    $tb = "";
//    $tb .= "<table class='table table-hover'>";
//
//    $sql = "select * from approve_kotentry order by entryNo desc";
//
//
//    $tb .= "<tr>";
//    $tb .= "<th class=\"success\" style=\"width: 350px;\">Item</th>";
//    $tb .= "<th class=\"success\" style=\"width: 500px;\">Description</th>";
//    $tb .= "<th class=\"success\" style=\"width: 350px;\">Qty</th>";
//    $tb .= "<th class=\"success\" style=\"width: 350px;\">Amount</th>";
//    $tb .= "<th class=\"success\" style=\"width: 500px;\">Sub Total</th>";
//    $tb .= "</tr>";
//    foreach ($conn->query($sql) as $row) {
//        $tb .= "<tr>";
//        $tb .= "<td onclick=\"getcode('" . $row['code'] . "','" . $row['name'] . "','" . $row['address'] . "','" . $row['telephone'] . "','" . $row['email'] . "','" . $row['nic'] . "','" . $row['account_no'] . "','" . "')\">" . $row['code'] . "</td>";
//        $tb .= "<td onclick=\"getcode('" . $row['code'] . "','" . $row['name'] . "','" . $row['address'] . "','" . $row['telephone'] . "','" . $row['email'] . "','" . $row['nic'] . "','" . $row['account_no'] . "')\">" . $row['name'] . "</td>";
//        $tb .= "<td onclick=\"getcode('" . $row['code'] . "','" . $row['name'] . "','" . $row['address'] . "','" . $row['telephone'] . "','" . $row['email'] . "','" . $row['nic'] . "','" . $row['account_no'] . "')\">" . $row['address'] . "</td>";
//        $tb .= "<td onclick=\"getcode('" . $row['code'] . "','" . $row['name'] . "','" . $row['address'] . "','" . $row['telephone'] . "','" . $row['email'] . "','" . $row['nic'] . "','" . $row['account_no'] . "')\">" . $row['telephone'] . "</td>";
//        $tb .= "<td onclick=\"getcode('" . $row['code'] . "','" . $row['name'] . "','" . $row['address'] . "','" . $row['telephone'] . "','" . $row['email'] . "','" . $row['nic'] . "','" . $row['account_no'] . "')\">" . $row['email'] . "</td>";
//        $tb .= "<td onclick=\"getcode('" . $row['code'] . "','" . $row['name'] . "','" . $row['address'] . "','" . $row['telephone'] . "','" . $row['email'] . "','" . $row['nic'] . "','" . $row['account_no'] . "')\">" . $row['nic'] . "</td>";
//        $tb .= "<td onclick=\"getcode('" . $row['code'] . "','" . $row['name'] . "','" . $row['address'] . "','" . $row['telephone'] . "','" . $row['email'] . "','" . $row['nic'] . "','" . $row['account_no'] . "')\">" . $row['account_no'] . "</td>";
//        $tb .= "</tr>";
//    }
//    $tb .= "</table>";

    echo $ResponseXML;
}






if ($_GET["Command"] == "update_list") {
    $ResponseXML = "";
    $ResponseXML .= "<table class=\"table\">
	            <tr>
                        <th width=\"121\">Item No</th>
                        <th width=\"424\"> Item Description </th>
                        
                        <th width=\"121\">Amount</th>  
                    </tr>";


    $sql = "SELECT * from ass_vender where itcode <> ''";
    if ($_GET['refno'] != "") {
        $sql .= " and itcode like '%" . $_GET['refno'] . "%'";
    }
    if ($_GET['cusname'] != "") {
        $sql .= " and itname like '%" . $_GET['cusname'] . "%'";
    }
    $stname = $_GET['stname'];

    $sql .= " ORDER BY itcode limit 50";

    foreach ($conn->query($sql) as $row) {
        $cuscode = $row["itcode"];


        $ResponseXML .= "<tr>               
                              <td onclick=\"itno_undeliver('$cuscode', '$stname');\">" . $row['itcode'] . "</a></td>
                              <td onclick=\"itno_undeliver('$cuscode', '$stname');\">" . $row['itname'] . "</a></td>
                              <td onclick=\"itno_undeliver('$cuscode', '$stname');\">" . $row['price'] . "</a></td>
                            </tr>";
    }
    $ResponseXML .= "</table>";
    echo $ResponseXML;
}



if ($_GET["Command"] == "set") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
					<tr>
						<td style=\"width: 90px;\">Item</td>
                                                <td style=\"width: 90px;\">Meal Type</td>
						<td style=\"width: 450px;\">Description</td>
                                                <td style=\"width: 100px;\">Require Time</td>
						<td style=\"width: 150px;\">Serving Location</td>
						<td style=\"width: 100px;\">Qty</td>
						<td style=\"width: 100px;\">Amount</td>
						<td style=\"width: 100px;\">Sub Total</td>
						<td style=\"width: 10px;\"></td>
					</tr>";
    $i = 1;
//    $mtot = 0;
    $h = 0;
    $h1 = 0;
//    $menqty = $_GET['menqty'];
    $sql = "Select * from kot_itemdetail where entryNo='" . $_GET['tmpno'] . "' group by menu, user,serialno";
    foreach ($conn->query($sql) as $row) {
//        $icode = $row['itemcode'];
        $ResponseXML .= "<tr>
                             <td>" . $row['itemcode'] . "</td>
                                                         <td>" . $row['mealtype'] . "</td>
                                                         <td>" . $row['menu'] . "</td>
                                                         <td>" . $row['requiretime'] . "</td>
                                                         <td>" . $row['savinglock'] . "</td>        
                                                         <td>" . $row['qty'] . "</td>
							<td>" . number_format($row['amount'], 2, ".", ",") . "</td>
							 <td>" . number_format($row['qty']*$row['amount'], 2, ".", ",") . "</td>
							 
							 </tr>";

        $mtot = $mtot + $row['qty']*$row['amount'];

        $i = $i + 1;
    }

    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>";
    $ResponseXML .= "<subtot><![CDATA[" . number_format($mtot, 2, ".", "") . "]]></subtot>";
//    $ResponseXML .= "<subtot1><![CDATA[" . number_format($h1, 2, ".", "") . "]]></subtot1>";
    $ResponseXML .= "</salesdetails>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "cancel_item") {
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "update kot_entry set cancel = '1',ap_step = '1' where entryNo = '" . $_GET['entryNo'] . "'";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "save_item") {
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = "update kot_entry set ap_step = '1',grandTot = '" . $_GET['gtot'] . "' where entryNo = '" . $_GET['entryNo'] . "'";

        $result = $conn->query($sql);


//        $sql = "delete from kot_itemdetail where entryNo = '" . $_GET['entryNo'] . "'";
//        $result = $conn->query($sql);
//
//        $sql = "Select * from tmp_po_data where tmp_no='" . $_GET['tmpno1'] . "'";
//        foreach ($conn->query($sql) as $row) {
//
//            $sql1 = "Insert into kot_itemdetail(entryNo,itemcode,itemdesc,qty,amount,mealtype,subtot,aa,serialno,menu,user,requiretime,savinglock)values
//    ('" . $_GET['entryNo'] . "','" . $row['itemcode'] . "','" . $row['itemdesc'] . "','" . $row['qty'] . "','" . $row['amount'] . "','" . $row['mealtype'] . "','" . $row['subtot'] . "','" . $row['aa'] . "','" . $row['serialno'] . "','" . $row['menu'] . "','" . $row['user'] . "','" . $row['requiretime'] . "','" . $row['savinglock'] . "') ";
//
//            $result1 = $conn->query($sql1);
//        }
//        $sql3 = "delete from tmp_po_data where tmp_no = '" . $_GET['tmpno1'] . "'";
//        $result = $conn->query($sql3);
//        $result = $conn->query($sql);

        $conn->commit();

        echo "Saved";

//            echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}
?>