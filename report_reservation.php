<?php session_start();
?>
<!DOCTYPE html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Report</title>


    <style>
        @media print {
            a[href]:after {
                content: none !important;
            }
        }
        a:link, a:visited {

            text-decoration: none;
            color:#000000;
        }


        a:hover {
            text-decoration: underline;
        }
        body {
            color: #333;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 10px;
            line-height: 1.32857;
        }
        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            border-top:1px solid #DDDDDD;
            line-height:1.2857;
            padding:1.5px;

            vertical-align:top;
        }
        .right {
            text-align: right;
        }
        .left {
            text-align: left;
        }
        .center {
            text-align: center;
        }
        .table1 {
            border-collapse: collapse;
            border: 1px;
        }
        .table1, td, th {

            font-family: Arial, Helvetica, sans-serif;
            padding: 5px;

        }
        .table1 th {
            font-weight: bold;
            font-size: 12px;
        }
        .table1 td {
            font-size: 12px;
            border-bottom: none;
            border-top: none;
        }
    </style>
</head>

<body>
    <?php
    require_once ("./connection_sql.php");

    date_default_timezone_set("Asia/Colombo");


    if ($_GET['optionsRadios'] == "preservations") {

        if ($_GET['datecheck'] == "datecheck") {
            $sql .= "select * from reservation where  rdate BETWEEN ('" . $_GET['from'] . "') AND ('" . $_GET['to'] . "') and cancel ='0'";
        } else {
            $sql = "select * from reservation where  cancel ='0'  ";
        }


        $table = "";
        $table .= "<table   style='width: 1200px;' class='table1'>
            <tr>
                <th class='bottom head' colspan = '6'><center>Pending Reservation</center></th>

            </tr> 
             <tr>
              <th colspan='6' ><center></center></th>

            </tr>
            <tr>
                <th colspan='6' ><center></center></th>
             </tr>
            <tr>


            </tr></table>";

        $table .= "<table   style='width: 660px;' class='table1'>
            <tr>
                <th style='width: 8px;' class='left'>Date :</th>
                <th style='width: 80px;' class='left'>" . date("Y-m-d") . "</th>
                <th style='width: 8px;' class='left'>Time :</th>
                <th style='width: 80px;' class='left'>" . date("h-i-sa") . "</th>
            </tr>
            <tr>
                <th style='width: 8px;' class='left'></th> 
            </tr></table>";

        $gtot = 0;
        $refno = "";
        $i = 0;

        foreach ($conn->query($sql) as $row) {

            if ($refno != $row["refno"]) {

                if ($i != 0) {
                    
                }
                $table .= "<tr>";
                $table .= "<td class='left' colspan=6>" . $row["refno"] . "</td>";
                $table .= "</tr>";
                $table .= "<table class='table' >
                    <tr>
                    <th class='center' style='width: 180px;'>Reservation No</th>
                    <th class='center' style='width: 180px;'>Guest Name</th>
                    <th class='center' style='width: 180px;'>Reservation Date</th>
                    <th class='center' style='width: 180px;'>Reservation Time From</th>
                    <th class='center' style='width: 180px;'>Reservation Time To</th>
                    <th class='center' style='width: 180px;'>No Of Persons</th>
                    <th class='center' style='width: 180px;'>Note</th> 
                    <th class='center' style='width: 180px;'>Table</th> 
                    <th class='center' style='width: 180px;'>Amount</th> 
    
    
                    </tr>";

                $i = 1;
            }

            $table .= "<table class='table'> ";

            $table .= "<tr>";
            $table .= "<tr class='center' style='width: 180px;'>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['refno'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['gname'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['rdate'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['tfrom'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['tto'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['person'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['note'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['tables'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['amount'] . "</td>";


            $table .= "</tr>";


            $gtot = $gtot + $row['amount'];

            $table .= "<table   style='width: 1350px;' class='table1'>
                <tr>
                    <th class='center' style='height: 10px;'></th>
                </tr>
            </table>";
            $refno = $row["refno"];
        }

        $table .= "<table   style='width: 1060px;' class='table1'>
            <tr>
                <th style='width: 50px;' colspan = '4' class='left'></th>
                <th style='width: 50px;' colspan = '4' class='left'></th>

                <th style='width: 50px;' colspan = '4' class='left'></th>
            </tr></table>";

        $table .= "<table   style='width: 1350px;' class='table1'>
            <tr>

        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'>Total :</th>

        <th class='center' style='width: 180px;'>" . number_format($gtot, 2) . "</th>
            </tr></table>";
    }

    if ($_GET['optionsRadios'] == "creservations") {

        if ($_GET['datecheck'] == "datecheck") {
            $sql .= "select * from reservation where  rdate BETWEEN ('" . $_GET['from'] . "') AND ('" . $_GET['to'] . "') and rdate>'" . date("Y-m-d") . "' and cancel ='0' ";
        } else {
            $sql = "select * from reservation where  cancel ='0'  and rdate>='" . date("Y-m-d") . "'";
        }


        $table = "";
        $table .= "<table   style='width: 1200px;' class='table1'>
            <tr>
                <th class='bottom head' colspan = '6'><center>Complete Reservation</center></th>

            </tr> 
             <tr>
              <th colspan='6' ><center></center></th>

            </tr>
            <tr>
                <th colspan='6' ><center></center></th>
             </tr>
            <tr>


            </tr></table>";

        $table .= "<table   style='width: 660px;' class='table1'>
            <tr>
                <th style='width: 8px;' class='left'>Date :</th>
                <th style='width: 80px;' class='left'>" . date("Y-m-d") . "</th>
                <th style='width: 8px;' class='left'>Time :</th>
                <th style='width: 80px;' class='left'>" . date("h-i-sa") . "</th>
            </tr>
            <tr>
                <th style='width: 8px;' class='left'></th> 
            </tr></table>";

        $gtot = 0;
        $refno = "";
        $i = 0;

        foreach ($conn->query($sql) as $row) {
            if ($refno != $row["refno"]) {

                if ($i != 0) {
                    
                }
                $table .= "<tr>";
                $table .= "<td class='left' colspan=6>" . $row["refno"] . "</td>";
                $table .= "</tr>";
                $table .= "<table class='table' >
                    <tr>
                    <th class='center' style='width: 180px;'>Reservation No</th>
                    <th class='center' style='width: 180px;'>Guest Name</th>
                    <th class='center' style='width: 180px;'>Reservation Date</th>
                    <th class='center' style='width: 180px;'>Reservation Time From</th>
                    <th class='center' style='width: 180px;'>Reservation Time To</th>
                    <th class='center' style='width: 180px;'>No Of Persons</th>
                    <th class='center' style='width: 180px;'>Note</th> 
                    <th class='center' style='width: 180px;'>Table</th> 
                    <th class='center' style='width: 180px;'>Amount</th> 
    
    
                    </tr>";

                $i = 1;
            }

            $table .= "<table class='table' > ";
            $table .= "<tr>";
            $table .= "<tr class='center' style='width: 180px;'>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['refno'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['gname'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['rdate'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['tfrom'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['tto'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['person'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['note'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['tables'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['amount'] . "</td>";


            $table .= "</tr>";




            $gtot = $gtot + $row['amount'];

            $i = 0;

            $table .= "<table   style='width: 1350px;' class='table1'>
                <tr>
                    <th class='center' style='height: 10px;'></th>
                </tr>
            </table>";
            $refno = $row["refno"];
        }


        $table .= "<table   style='width: 1060px;' class='table1'>
            <tr>
                <th style='width: 50px;' colspan = '4' class='left'></th>
                <th style='width: 50px;' colspan = '4' class='left'></th>

                <th style='width: 50px;' colspan = '4' class='left'></th>
            </tr></table>";

        $table .= "<table   style='width: 1350px;' class='table1'>
            <tr>

        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'>Total :</th>

        <th class='center' style='width: 180px;'>" . number_format($gtot, 2) . "</th>
            </tr></table>";
    }

    if ($_GET['optionsRadios'] == "cancelreservations") {

        if ($_GET['datecheck'] == "datecheck") {
            $sql .= "select * from reservation where  rdate BETWEEN ('" . $_GET['from'] . "') AND ('" . $_GET['to'] . "') and cancel ='1' ";
        } else {
            $sql = "select * from reservation where  cancel ='1'  ";
        }


        $table = "";
        $table .= "<table   style='width: 1200px;' class='table1'>
            <tr>
                <th class='bottom head' colspan = '6'><center>Cancel Reservations</center></th>

            </tr> 
             <tr>
              <th colspan='6' ><center></center></th>

            </tr>
            <tr>
                <th colspan='6' ><center></center></th>
             </tr>
            <tr>


            </tr></table>";

        $table .= "<table   style='width: 660px;' class='table1'>
            <tr>
                <th style='width: 8px;' class='left'>Date :</th>
                <th style='width: 80px;' class='left'>" . date("Y-m-d") . "</th>
                <th style='width: 8px;' class='left'>Time :</th>
                <th style='width: 80px;' class='left'>" . date("h-i-sa") . "</th>
            </tr>
            <tr>
                <th style='width: 8px;' class='left'></th> 
            </tr></table>";

        $gtot = 0;


        $refno = "";
        $i = 0;

        foreach ($conn->query($sql) as $row) {
            if ($refno != $row["refno"]) {

                if ($i != 0) {
                    
                }
                $table .= "<tr>";
                $table .= "<td class='left' colspan=6>" . $row["refno"] . "</td>";
                $table .= "</tr>";
                $table .= "<table class='table' >
                    <tr>
                    <th class='center' style='width: 180px;'>Reservation No</th>
                    <th class='center' style='width: 180px;'>Guest Name</th>
                    <th class='center' style='width: 180px;'>Reservation Date</th>
                    <th class='center' style='width: 180px;'>Reservation Time From</th>
                    <th class='center' style='width: 180px;'>Reservation Time To</th>
                    <th class='center' style='width: 180px;'>No Of Persons</th>
                    <th class='center' style='width: 180px;'>Note</th> 
                    <th class='center' style='width: 180px;'>Table</th> 
                    <th class='center' style='width: 180px;'>Amount</th> 
    
    
                    </tr>";

                $i = 1;
            }
            $table .= "<table class='table' > ";
            $table .= "<tr>";
            $table .= "<tr class='center' style='width: 180px;'>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['refno'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['gname'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['rdate'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['tfrom'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['tto'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['person'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['note'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['tables'] . "</td>";
            $table .= "<td class='center' style='width: 180px;'>" . $row['amount'] . "</td>";


            $table .= "</tr>";

            $gtot = $gtot + $row['amount'];

            $i = 0;

            $table .= "<table   style='width: 1350px;' class='table1'>
                <tr>
                    <th class='center' style='height: 10px;'></th>
                </tr>
            </table>";
            $refno = $row["refno"];
        }


        $table .= "<table   style='width: 1060px;' class='table1'>
            <tr>
                <th style='width: 50px;' colspan = '4' class='left'></th>
                <th style='width: 50px;' colspan = '4' class='left'></th>

                <th style='width: 50px;' colspan = '4' class='left'></th>
            </tr></table>";

        $table .= "<table   style='width: 1350px;' class='table1'>
            <tr>

        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'></th>
        <th class='center' style='width: 180px;'>Total :</th>

        <th class='center' style='width: 180px;'>" . number_format($gtot, 2) . "</th>
            </tr></table>";
    }


    echo $table;
    