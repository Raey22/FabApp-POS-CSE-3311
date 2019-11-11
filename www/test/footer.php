<div class="app-wrapper-footer">
  <div class="app-footer">
    <div class="app-footer__inner">
      <div class="app-footer-left">
        <!-- <ul class="nav">
        <li class="nav-item">
        <a href="javascript:void(0);" class="nav-link">
        Footer Link 1
      </a>
    </li>
    <li class="nav-item">
    <a href="javascript:void(0);" class="nav-link">
    Footer Link 2
  </a>
</li>
</ul> -->
</div>
      <div class="app-footer-right">
        <!-- <ul class="nav">
          <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link">
              Footer Link 3
            </a>
          </li>
          <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link">
              <div class="badge badge-success mr-1 ml-0">
                <small>NEW</small>
              </div>
              Footer Link 4
            </a>
          </li>
        </ul> -->
      </div>
    </div>
  </div>
</div>

</div>
<!-- /#app-main-->
<!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
</div>
<!-- /#app-header -->
</div>
<!-- /#app-container -->


<!-- old code from before -->
<div id="popModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title">TM</h4>
            </div>
            <div class="modal-body">
                <p id="modal-body"> - </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="loadingModal" class="modal fade">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body text-center">
                <i class="fas fa-spinner fa-pulse fa-3x"></i>
          </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- dev details -->
<div class="col-sm-12">
    <?php echo "IP addy - ".getenv('REMOTE_ADDR');?>
</div>

<script type="text/javascript">
<?php if (isset($staff)){?>
    setTimeout(function(){window.location.href = "<?php echo $_SESSION['loc']?>"}, <?php echo (1+$_SESSION["timeOut"]-time())*1000; ?>);
<?php } elseif (isset($auto_off)) { ?>
    //no auto refresh timer
<?php } else {?>
    setTimeout(function(){window.location.href = "/index.php"}, 301000);
<?php } ?>
</script>
<script type="text/javascript" src="/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/vendor/moment/moment.min.js"></script>
<script type="text/javascript" src="/vendor/blackrock-digital/js/sb-admin-2.js"></script>
<script type="text/javascript" src="/vendor/datatables/js/dataTables.min.js"></script>
<script type="text/javascript" src="/vendor/bs-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/vendor/fabapp/fabapp.js?v=3"></script>
<script type="text/javascript" src="/vendor/metisMenu/metisMenu.min.js"></script>
<script type="text/javascript" src="/vendor/morrisjs/morris.min.js"></script>
<script type="text/javascript" src="/vendor/raphael/raphael.min.js"></script>
</body>

</html>
