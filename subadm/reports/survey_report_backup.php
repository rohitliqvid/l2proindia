<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 20px 0;
        }
        .chart {
            width: 30%;
        }
        .chart-section {
            margin-top: 40px;
        }
        .chart-question {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php 
include '../intface/adm_top.php'; 
$survey_questions = [
    1 => "I was able to get a good introduction to Intellectual Property",
    2 => "Course language and instructions were very easy to understand",
    3 => "Course developed my ability to apply theory to practice",
    4 => "Course had sufficient examples to help me understand the concept",
    5 => "Course was easy to navigate and find information",
    6 => "Course had good mix of media assets and presentation",
    7 => "Course assessments covered the context knowledge appropriately"
];
?>
<!-- mid section -->
<section class="panel panel-default padder">
    <!-- breadcrumbs -->
    <section class="panel panel-default text-center">
        <div class="rightHead text-center bgWt">
            <?php
                if (isset($_POST['from_date'])) {
                    $from_date = trim($_POST['from_date']);
                }
                if (isset($_POST['to_date'])) {
                    $to_date = trim($_POST['to_date']);
                }
                ?>
            <form name="frmprofile" id="frmprofile" onSubmit="return validateDateFilter();" action="survey_report.php" method="POST">
                <!-- Date filter form -->
                <div class="col-sm-1"></div>
                    <div class="searchbg">
                        <div class="search inline">
                            <span>
                                Show Status From Date:
                                <div id="divFromDate" class="input-append date inputCalenderDiv">
                                    <input type="text" name="from_date" id="from_date" class="input-sm form-control  searchbtn" size="20" maxlength="10" onClick="popUpCalendar(this,this,'dd/mm/yyyy');" readonly value="<?= $from_date; ?>"> <span class="calendarBg add-on">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                &nbsp;
                                To Date:
                                <div id="divToDate" class="input-append date inputCalenderDiv">
                                    <input type="text" name="to_date" id="to_date" class="input-sm form-control  searchbtn" size="20" maxlength="10" onClick="popUpCalendar(this,this,'dd/mm/yyyy');" readonly value="<?= $to_date; ?>">
                                    <span class="calendarBg add-on">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                <!--<i class="fa fa-search"></i>-->
                                &nbsp; &nbsp;<button type="submit" id="search" name="search" class="btn btn-sm btn-blue searchButton" title='Show login details for this time period'>Search</button>
                                &nbsp; &nbsp;
                                <a href="survey_report.php"><button type="button" class="btn btn-sm btn-blue searchButton" title='Reset Fields'>Reset</button></a>

                        </div>
                    </div>
            </form>
        </div>
    </section>

    <section>
        <div class="panel-body nobot panelBg" style="margin-top:20px">
            <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                <div class="pull-left m-b-xs coursetitle"><span class="orange_heading"><strong>Survey Questions and Responses</strong></span></div>
            </div>
        </div>
    </section>

    <div style="clear"></div>
    <form name="deletestd" id="deletestd" onSubmit="return confirmDelete();" action="#" method="post" style="margin:0px;">
        <section class="panel panel-default panelgridBg">
            <div class="panel row teacher-student-wrap">
                <div class="table-responsive promo courseGroup table-responsiveWindow" style="padding-top: 5px;">
                    <table class="table m-b-none dataTable table-fixed">
                        <thead class="fixedHeader">
                            <tr>
                               <th class="col-xs-1 text-left">S.No</th>
                                <th class="col-xs-4 text-left">Question</th>
                                <th class="col-xs-1" style="text-align: center">Strongly Agree</th>
                                <th class="col-xs-1" style="text-align: center">Agree</th>
                                <th class="col-xs-1" style="text-align: center">Undecided/ Neutral</th>
                                <th class="col-xs-1" style="text-align: center">Disagree</th>
                                <th class="col-xs-1" style="text-align: center">Strongly Disagree</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $u_q_part = "";

                            if (!empty($from_date)) {
                                $from_date = date('Y-m-d', strtotime($from_date));
                                $u_q_part .= " AND DATE(date_attempted) >= '$from_date'";
                            }
                            if (!empty($to_date)) {
                                $to_date = date('Y-m-d', strtotime($to_date));
                                $u_q_part .= " AND DATE(date_attempted) <= '$to_date'";
                            }

                            $con = createConnection();
                            $result = mysqli_query($con, "SELECT DISTINCT question_no FROM tbl_survey");
                            $num = mysqli_num_rows($result);
                            $i = 0;

                            $chart_data = []; // Array to hold chart data for each question

                            while ($row = $result->fetch_assoc()) {
                                $question_no = $row['question_no'];
                                
                                $option_1_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tbl_survey WHERE question_no = $question_no AND answer = '1'" . $u_q_part));
                                $option_2_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tbl_survey WHERE question_no = $question_no AND answer = '2'" . $u_q_part));
                                $option_3_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tbl_survey WHERE question_no = $question_no AND answer = '3'" . $u_q_part));
                                $option_4_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tbl_survey WHERE question_no = $question_no AND answer = '4'" . $u_q_part));
                                $option_5_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tbl_survey WHERE question_no = $question_no AND answer = '5'" . $u_q_part));

                                $question_text = isset($survey_questions[$question_no]) ? $survey_questions[$question_no] : "Question " . $question_no;

                                // Store chart data
                                $chart_data[$question_no] = [
                                    'question' => $question_text,
                                    'data' => [
                                        $option_1_count,
                                        $option_2_count,
                                        $option_3_count,
                                        $option_4_count,
                                        $option_5_count
                                    ]
                                ];
                            ?>
                                <tr>
                                    <td class="col-xs-1 text-left"><?php echo $i + 1; ?></td>
                                    <td class="col-xs-4 text-left"><?php echo $question_text; ?></td>
                                    <td class="col-xs-1" style="text-align: center"><?= $option_1_count ?></td>
                                    <td class="col-xs-1" style="text-align: center"><?= $option_2_count ?></td>
                                    <td class="col-xs-1" style="text-align: center"><?= $option_3_count ?></td>
                                    <td class="col-xs-1" style="text-align: center"><?= $option_4_count ?></td>
                                    <td class="col-xs-1" style="text-align: center"><?= $option_5_count ?></td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </form>
</section>

<!-- Add chart containers -->
<section class="panel panel-default padder chart-section">
    <?php foreach ($chart_data as $question_no => $data) { ?>
        <div class="chart-question">
            <?php echo "Question " . $question_no . ": " . $data['question']; ?>
        </div>
        <div class="chart-container">
            <div class="chart">
                <canvas id="pieChart<?php echo $question_no; ?>"></canvas>
            </div>
            <div class="chart">
                <canvas id="barChart<?php echo $question_no; ?>"></canvas>
            </div>
        </div>
    <?php } ?>
</section>


<!-- Include footer -->
<?php include '../intface/adm_footer.php'; ?>

<script>
<?php foreach ($chart_data as $question_no => $data) { ?>
    var ctxPie<?php echo $question_no; ?> = document.getElementById('pieChart<?php echo $question_no; ?>').getContext('2d');
    var ctxBar<?php echo $question_no; ?> = document.getElementById('barChart<?php echo $question_no; ?>').getContext('2d');

    new Chart(ctxPie<?php echo $question_no; ?>, {
        type: 'pie',
        data: {
            labels: ['Strongly Agree', 'Agree', 'Undecided/ Neutral', 'Disagree', 'Strongly Disagree'],
            datasets: [{
                data: <?php echo json_encode($data['data']); ?>,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Pie Chart for <?php echo addslashes($data['question']); ?>'
            }
        }
    });

    new Chart(ctxBar<?php echo $question_no; ?>, {
        type: 'bar',
        data: {
            labels: ['Strongly Agree', 'Agree', 'Undecided/ Neutral', 'Disagree', 'Strongly Disagree'],
            datasets: [{
                label: '',
                data: <?php echo json_encode($data['data']); ?>,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
            }]
        },
        options: {
            
            responsive: true,
            title: {
                display: true,
                text: 'Bar Chart for <?php echo addslashes($data['question']); ?>'
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
<?php } ?>
</script>
</body>
</html>
