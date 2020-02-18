<?php
include './connection_sql.php';
?> 
<link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css"  type="text/css"/>

<link href="css/ihover.css" rel="stylesheet" type="text/css"/>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    .flip-box {
        background-color: transparent;
        width: 100px;
        height: 100px;
        border: 1px solid #f1f1f1;
        perspective: 1000px;
    }

    .flip-box-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.8s;
        transform-style: preserve-3d;
    }

    /*    .flip-box:hover .flip-box-inner {
            transform: rotateY(180deg);
        }*/

    .flip-box-front, .flip-box-back,.flip-box-book{
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
    }

    .flip-box-front {
        background-color: #66afe8;
        color: black;
    }
    .flip-box-book {
        background-color: red;
        color: black;
    }


    .flip-box-back {
        background-color: #bbb;
        color: black;
        transform: rotateY(180deg);
    }

</style>
<section class="content">

    <div class="box box-primary">

        <div class="box-header with-border">
            <h3 class="box-title">Table Reservation</h3>
        </div>

        <form role="form" name ="form1" class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <a onclick="newent();" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>

                    <a onclick="save_inv();" data-placement="top"   class="btn btn-success btn-sm">
                        <span class="fa fa-print"></span> &nbsp; Reserve
                    </a>
                    <a onclick = "NewWindow('search_reservation.php', 'mywin', '800', '700', 'yes', 'center');" class = "btn btn-primary btn-sm">
                        <span class = "fa fa-search"></span> &nbsp Find
                    </a>
                    <a onclick="print_mn();"   class="btn btn-danger btn-sm">
                        <span class="fa fa-trash-o"></span> &nbsp; Cancel
                    </a>
                    <div class="col-md-2">
                        <div id="msg_box"  class="span12 text-center"  ></div>
                        <input type="text" placeholder="" id="uniq" class="form-control ">
                        <input type="text" placeholder="" id="refno" class="form-control ">
                    </div> 
                </div> 
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Guest Name</th>
                                    <th scope="col"><input type="text" placeholder="" id="gname" class="form-control input-sm"></th> 
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col">Reservation Date</th>
                                    <th scope="col"><input type="text" placeholder="" id="rdate" class="form-control dt"></th> 
                                </tr>
                                <tr>
                                    <th scope="col">Reservation Time From</th>
                                    <th scope="col">
                                        <div class='input-group date'>
                                            <input type='time'  id='from' class="form-control " />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div></th> 
                                </tr>
                                <tr>
                                    <th scope="col">Reservation Time To</th>
                                    <th scope="col">
                                        <div class='input-group date' >
                                            <input type='time' id='to' class="form-control " />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div></th> 
                                </tr>
                                <tr>
                                    <th scope="col">No Of Persons</th>
                                    <th scope="col"><input type="number" placeholder="" id="person" onchange="checkreserved();" class="form-control input-sm"></th> 
                                </tr>
                                <tr>
                                    <th scope="col">Selected Tables</th>
                                    <th scope="col"><input type="text" placeholder="" id="tables" disabled class="form-control input-sm"></th> 
                                </tr>
                                <tr>
                                    <th scope="col">Note</th>
                                    <th scope="col"><textarea rows="2" id="note"  placeholder="Special Instructions" class="form-control  input-sm"></textarea></th> 
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="col-md-6">
                        <div class="col-md-2">
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs"   onclick="ch_reserve('01');">
                                    <div class="flip-box-front"  id="01">
                                        <h2>Table 01</h2>
                                    </div>
                                    <div class="flip-box-back" id="01">
                                        <h2>Table 01</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('02');">
                                    <div class="flip-box-front" id="02">
                                        <h2>Table 02</h2>
                                    </div>
                                    <div class="flip-box-back" id="02">
                                        <h2>Table 02</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('03');">
                                    <div class="flip-box-front" id="03">
                                        <h2>Table 03</h2>
                                    </div>
                                    <div class="flip-box-back" id="03">
                                        <h2>Table 03</h2>
                                    </div>
                                </div>
                            </div> 
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('04');">
                                    <div class="flip-box-front" id="04">
                                        <h2>Table 04</h2>
                                    </div>
                                    <div class="flip-box-back" id="04">
                                        <h2>Table 04</h2>
                                    </div>
                                </div>
                            </div> 

                        </div>
                        <div class="col-md-2">
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs"  onclick="ch_reserve('05');">
                                    <div class="flip-box-front" id="05">
                                        <h2>Table 05</h2>
                                    </div>
                                    <div class="flip-box-back" id="05">
                                        <h2>Table 05</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('06');">
                                    <div class="flip-box-front" id="06">
                                        <h2>Table 06</h2>
                                    </div>
                                    <div class="flip-box-back" id="06">
                                        <h2>Table 06</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('07');">
                                    <div class="flip-box-front" id="07">
                                        <h2>Table 07</h2>
                                    </div>
                                    <div class="flip-box-back" id="07">
                                        <h2>Table 07</h2>
                                    </div>
                                </div>
                            </div> 
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('08');">
                                    <div class="flip-box-front" id="08">
                                        <h2>Table 08</h2>
                                    </div>
                                    <div class="flip-box-back" id="08">
                                        <h2>Table 08</h2>
                                    </div>
                                </div>
                            </div> 

                        </div>
                        <div class="col-md-2">
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('09');">
                                    <div class="flip-box-front" id="09">
                                        <h2>Table 09</h2>
                                    </div>
                                    <div class="flip-box-back" id="09">
                                        <h2>Table 09</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('10');">
                                    <div class="flip-box-front" id="10">
                                        <h2>Table 10</h2>
                                    </div>
                                    <div class="flip-box-back" id="10">
                                        <h2>Table 10</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('11');">
                                    <div class="flip-box-front" id="11">
                                        <h2>Table 11</h2>
                                    </div>
                                    <div class="flip-box-back" id="11">
                                        <h2>Table 11</h2>
                                    </div>
                                </div>
                            </div> 
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('12');">
                                    <div class="flip-box-front" id="12">
                                        <h2>Table 12</h2>
                                    </div>
                                    <div class="flip-box-back" id="12">
                                        <h2>Table 12</h2>
                                    </div>
                                </div>
                            </div> 

                        </div>
                        <div class="col-md-2">
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('13');">
                                    <div class="flip-box-front" id="13">
                                        <h2>Table 13</h2>
                                    </div>
                                    <div class="flip-box-back" id="13">
                                        <h2>Table 13</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('14');">
                                    <div class="flip-box-front" id="14">
                                        <h2>Table 14</h2>
                                    </div>
                                    <div class="flip-box-back" id="14">
                                        <h2>Table 14</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('15');">
                                    <div class="flip-box-front" id="15">
                                        <h2>Table 15</h2>
                                    </div>
                                    <div class="flip-box-back" id="15">
                                        <h2>Table 15</h2>
                                    </div>
                                </div>
                            </div> 
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('16');">
                                    <div class="flip-box-front" id="16">
                                        <h2>Table 16</h2>
                                    </div>
                                    <div class="flip-box-back" id="16">
                                        <h2>Table 16</h2>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-2">
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('17');">
                                    <div class="flip-box-front" id="17">
                                        <h2 >Table 17</h2>
                                    </div>
                                    <div class="flip-box-back" id="17">
                                        <h2>Table 17</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('18');">
                                    <div class="flip-box-front" id="18">
                                        <h2>Table 18</h2>
                                    </div>
                                    <div class="flip-box-back" id="18">
                                        <h2>Table 18</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('19');">
                                    <div class="flip-box-front" id="19">
                                        <h2>Table 19</h2>
                                    </div>
                                    <div class="flip-box-back" id="19">
                                        <h2>Table 19</h2>
                                    </div>
                                </div>
                            </div> 
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('20');">
                                    <div class="flip-box-front" id="20">
                                        <h2>Table 20</h2>
                                    </div>
                                    <div class="flip-box-back" id="20">
                                        <h2>Table 20</h2>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-2">
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('21');">
                                    <div class="flip-box-front" id="21" >
                                        <h2>Table 21</h2>
                                    </div>
                                    <div class="flip-box-back" id="21">
                                        <h2>Table 21</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('22');">
                                    <div class="flip-box-front" id="22">
                                        <h2>Table 22</h2>
                                    </div>
                                    <div class="flip-box-back" id="22">
                                        <h2>Table 22</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('23');">
                                    <div class="flip-box-front" id="23">
                                        <h2>Table 23</h2>
                                    </div>
                                    <div class="flip-box-back" id="23">
                                        <h2>Table 23</h2>
                                    </div>
                                </div>
                            </div> 
                            <div class="flip-box">
                                <div class="flip-box-inner" data-toggle="tooltip" title="Table Have 5 Chairs" onclick="ch_reserve('24');">
                                    <div class="flip-box-front" id="24">
                                        <h2>Table 24</h2>
                                    </div>
                                    <div class="flip-box-back" id="24">
                                        <h2>Table 24</h2>
                                    </div>
                                </div>
                            </div> 

                        </div>

                    </div>
                </div>
            </div>

        </form>
    </div>

</section>


<script src="js/reservation.js" type="text/javascript"></script>
<script>
                                    newent();
</script>