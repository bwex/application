
<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                       Logs from 
                        <?php

                            $routerName = Mikrotik::getRouterName(Mikrotik::mikroConnect());
                            echo $routerName;

                        ?>

                    </h1>


                </div>
            </div>
            <!-- /.row -->
            <!--                /.row-->

            <div class="row">

                <div class="table-responsive col-md-5 col-md-offset-3">

                <?php

                //getting logs from router via php API
                $routerConnection = Mikrotik::mikroConnect();

               
               

                ?> 
                </div>



            </div>

            <div class="row">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">


                </script>
                <div id="barchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>
            <!-- /.row -->

        </div>
            <!-- /.container-fluid -->

    </div>
        <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>



<?php include "includes/admin_footer.php"; ?>
