<?php

session_start();

require_once ("connection_sql.php");

header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "getdt") {
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT reserno FROM invpara";
    $result = $conn->query($sql);

    $row = $result->fetch();
    $no = $row['reserno'];
    $uniq = uniqid();
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";

    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "pass_quot") {

    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];

    $sql = "select * from reservation where cancel ='0'  and refno  = '" . $_GET['custno'] . "'";

    $i = 1;
    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {

        $ResponseXML .= "<refno><![CDATA[" . $row['refno'] . "]]></refno>";
        $ResponseXML .= "<gname><![CDATA[" . $row['gname'] . "]]></gname>";
        $ResponseXML .= "<rdate><![CDATA[" . $row['rdate'] . "]]></rdate>";
        $ResponseXML .= "<from><![CDATA[" . $row['from'] . "]]></from>";
        $ResponseXML .= "<to><![CDATA[" . $row['to'] . "]]></to>";
        $ResponseXML .= "<person><![CDATA[" . $row['person'] . "]]></person>";

        $ResponseXML .= "<tables><![CDATA[" . $row['tables'] . "]]></tables>";
        $ResponseXML .= "<note><![CDATA[" . $row['note'] . "]]></note>";
        $ResponseXML .= "<note><![CDATA[" . $row['cancel'] . "]]></note>";
    }


    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "update_list") {
    $ResponseXML = "";
    $ResponseXML .= "<table class=\"table\">
	            <tr>
                        <th width=\"110\">Reservation No</th>
                        <th width=\"200\"> Date </th>
                        <th width=\"200\">Request By</th>
                    </tr>";


    $sql = "SELECT * from reservation where cancel='0' and refno <> ''";
    if ($_GET['cusno'] != "") {
        $sql .= " and refno like '%" . $_GET['cusno'] . "%'";
    }
    if ($_GET['customername'] != "") {
        $sql .= " and rdate like '%" . $_GET['customername'] . "%'";
    }
    if ($_GET['customername1'] != "") {
        $sql .= " and gname like '%" . $_GET['customername1'] . "%'";
    }
    $stname = $_GET['stname'];

    $sql .= " ORDER BY refno limit 50";

    foreach ($conn->query($sql) as $row) {
        $cuscode = $row["refno"];


        $ResponseXML .= "<tr>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['refno'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['rdate'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['gname'] . "</a></td>
                            </tr>";
    }
    $ResponseXML .= "</table>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "cancel_item") {
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();


        $sql = "update reservation set cancel = '1'  where refno = '" . $_GET['refno'] . "'";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Cancel";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "save_item") {

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $str = explode(",", $_GET['addtable']);
        $count = sizeof($str);

        for ($x = 0; $x < $count; $x++) {
            $sql2 = "Insert into reservation(refno,gname,rdate,tfrom,tto,person,note,sdate,user,tables)values
            ('" . $_GET['refno'] . "',  '" . $_GET['gname'] . "','" . $_GET['rdate'] . "','" . $_GET['rdate'] . ' ' . $_GET['from'] . "','" . $_GET['rdate'] . ' ' . $_GET['to'] . "','" . $_GET['person'] . "','" . $_GET['note'] . "', '" . date("Y-m-d h:i:s") . "', '" . strtoupper($_SESSION['UserName']) . "','" . $str[$x] . "')";
            $result = $conn->query($sql2);
        }

        $sql = "SELECT reserno FROM invpara";
        $resul = $conn->query($sql);
        $row = $resul->fetch();
        $no = $row['reserno'];
        $no2 = $no + 1;
        $sql = "update invpara set reserno = $no2 where reserno = $no";
        $result = $conn->query($sql);


        echo "Saved";

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}
$savedValues = array();

if ($_GET["Command"] == "reserve") {
    date_default_timezone_set('Asia/Colombo');
    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $tableval = $_GET['addtable'];

    $sql = "Select * from reservation where rdate='" . $_GET['rdate'] . "' and cancel='0'";
    $result = $conn->query($sql);
    if ($row = $result->fetch()) {
//        echo $row['tfrom'] . '/' . $_GET['from'] . '/' . $row['tto'] . '/' . $_GET['to'];
        if (($row['tfrom'] > $_GET['from']) and ( $row['tto'] > $_GET['to'])) {
            $mess1 = "Booking OK 1";
        } else {
            $mess1 = "Booking Wait";
        }
    } else {
        $mess1 = "Booking OK";
    }

    $ResponseXML .= "<stat><![CDATA[" . $mess1 . "]]></stat>";
    $ResponseXML .= "<table><![CDATA[" . $tableval . "]]></table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "show") {
    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";
    $NEW_ARY = array();
    if ($_GET['tables'] != "") {
        if (in_array($_GET['addtable'], $savedValues)) {

            foreach ($savedValues as $i) {

                if ($savedValues[$i] == $_GET['addtable']) {
                    array_shift($savedValues[$i]);
                    $tot = $savedValues;
                    $ResponseXML .= "<table><![CDATA[" . $tot . "]]></table>";
                } else {
                    array_push($NEW_ARY, $savedValues[$i]);
                }
            }
            $savedValues = $NEW_ARY;
            $ResponseXML .= "<color><![CDATA['#66AFE8']]></color>";
        } else {

            $aodval = $_GET['tables'];
            $tot = $aodval . ',' . $_GET['addtable'];
            array_push($savedValues, $_GET['addtable']);
            $ResponseXML .= "<table><![CDATA[" . $_GET['addtable'] . "]]></table>";
            $ResponseXML .= "<tablelist><![CDATA[" . $tot . "]]></tablelist>";
            $d = 'green';
            $ResponseXML .= "<color><![CDATA[" . $d . "]]></color>";
        }
    } else {
        array_push($savedValues, $_GET['addtable']);
        $ResponseXML .= "<table><![CDATA[" . $_GET['addtable'] . "]]></table>";
        $ResponseXML .= "<tablelist><![CDATA[" . $_GET['addtable'] . "]]></tablelist>";
        $d = 'green';
        $ResponseXML .= "<color><![CDATA[" . $d . "]]></color>";
    }

    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "checkreserve") {
    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $x = 0;
    $sql = "Select  * from reservation where rdate   ='" . $_GET['rdate'] . "' and cancel='0' and (tfrom >= '" . $_GET['rdate'] . ' ' . $_GET['from'] . "') or  (tto >= '" . $_GET['rdate'] . ' ' . $_GET['to'] . "')";

//    $sql = "select * from reservation where tfrom between '" . $_GET['rdate'] . ' ' . $_GET['from'] . "' and '" . $_GET['rdate'] . ' ' . $_GET['to'] . "' and tto between '" . $_GET['rdate'] . ' ' . $_GET['from'] . "' and '" . $_GET['rdate'] . ' ' . $_GET['from'] . "'";
//echo $sql;
    $savedValues1 = array();

    foreach ($conn->query($sql) as $row) {

        $ResponseXML .= "<table><![CDATA[" . $row['tables'] . "]]></table>";
//        }
        $x += 1;
    }

    $ResponseXML .= "<count><![CDATA[" . $x . "]]></count>";


    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>
