
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>AdWise | Example Assessment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/assets/js/html5shiv.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">AdWise</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link">Yothinix</a>
            </p>
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Main Menu</li>
              <li><a href="#"><i class="icon-home icon-black"></i>Home</a></li>
              <li class="active"><a href="#"><i class="icon-edit icon-black"></i>Assessment</a></li>
              <li><a href="#"><i class="icon-print icon-black"></i>Report</a></li>
              <li class="nav-header">User Menu</li>
              <li><a href="#"><i class="icon-user icon-black"></i>Profile</a></li>
              <li><a href="#"><i class="icon-wrench icon-black"></i>Settings</a></li>
              <div id="push"></div>
              <div id="push"></div>
              <div id="push"></div>
              <div id="push"></div>
              <div id="push"></div>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9 hero-unit">
            <?php
            $choice_detail = Array();

            if(isset($quiz)):
                foreach($quiz as $row):
                    echo "<h2>Question: $row->QuestionNr</h2>";
                    echo "<p>$row->Detail</p>";

                    $str = $row->ChoiceID;
                    $choice_nr = explode(",", $str);

                    //var_dump($choice_nr);

                    echo "<div class=\"row-fluid\">";
                    foreach($choice_nr as $item)
                    {
                        echo "<div class=\"span4\"><h2>Choice: $item</h2>";
                        foreach($choice as $row)
                        {
                            for($i = 0 ; $i<$item ; $i++)
                            {
                                $choice_detail = $row->Detail;
                            }
                        }
                        echo "<p>$choice_detail</p>
                        <a class=\"btn btn-primary btn-block btn-large\" href=\"#\">Select Choice $item</a>
                        </div><!--/span-->";
                    }

                endforeach;
            else:
                echo "<h2>No Question were returned.</h2>";
            endif;

            ?>

            <div class="span4">
                <h3>Controller</h3>
                <div class="row-fluid">
                <div class="span4">
                <p><a class="btn btn-success btn-block btn-large" href="#">&laquo; Prev</a></p> <!--หาวิธ๊ให้ปุ่มย้อนไปข้อก่อนหน้า-->
            </div><!--/span-->
            <div class="span4">
                <p><a class="btn btn-danger btn-block btn-large" href="#">Next &raquo; </a></p> <!--หาวิธีให้ปุ่มเลื่อนคำถามไปข้อถัดไป-->
            </div><!--/span-->
        </div><!--/.fluid-container-->
        <p><a class="btn btn-info btn-large btn-block" href="#"><i class="icon-download-alt icon-white"></i> Save Progress </a></p>
            </div><!--/span-->
        </div>
    </div><!--/.fluid-container-->

    <hr>
      <footer>
        <p>&copy; AdWise Project | Information Engineering | KMITL 2013</p>
      </footer>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap-transition.js"></script>
    <script src="/assets/js/bootstrap-alert.js"></script>
    <script src="/assets/js/bootstrap-modal.js"></script>
    <script src="/assets/js/bootstrap-dropdown.js"></script>
    <script src="/assets/js/bootstrap-scrollspy.js"></script>
    <script src="/assets/js/bootstrap-tab.js"></script>
    <script src="/assets/js/bootstrap-tooltip.js"></script>
    <script src="/assets/js/bootstrap-popover.js"></script>
    <script src="/assets/js/bootstrap-button.js"></script>
    <script src="/assets/js/bootstrap-collapse.js"></script>
    <script src="/assets/js/bootstrap-carousel.js"></script>
    <script src="/assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>