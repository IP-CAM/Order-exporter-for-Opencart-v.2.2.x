<?php echo $header; ?>
<?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $form_title; ?></h3>
      </div>
      <!-- panel body -->
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-exporter" class="form-horizontal">
          <!-- form group -->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-ids"><?php echo $order_ids; ?></label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="ids" id="input-ids" value="" placeholder="<?php echo $order_ids; ?>" />
              <?php if ($error_orderIds) { ?>
              <div class="text-danger"><?php echo $error_orderIds; ?></div>
              <?php } ?>
            </div>
          </div>
          <!-- form group end -->
          <!-- form group -->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-type"><?php echo $order_type; ?></label>
            <div class="col-sm-10">
              <select name="type" id="input-type" class="form-control">
                <option value="csv" selected="selected"><?php echo $type_csv; ?></option>
                <option value="excel"><?php echo $type_excel; ?></option>
              </select>
              <?php if ($error_orderType) { ?>
              <div class="text-danger"><?php echo $error_orderType; ?></div>
              <?php } ?>
            </div>
          </div>
          <!-- form group end -->
          <!-- form group -->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-submit"></label>
            <div class="col-sm-10">
              <input type="submit" class="form-control" id="input-submit" value="Export" />
            </div>
          </div>
          <!-- form group end -->
        </form>
      </div>
      <!-- panel body end -->
    </div>
  </div>
</div>

<div id="progress-dialog" class="modal" data-backdrop="static" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content padding20">
      <div id="progressbar">
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
          </div>
        </div>
      </div>
      <div id="progressinfo"></div>
      <button class="btn btn-default finishActionButton" style="display: none;">Abort</button>
    </div>
  </div>
</div>

<?php echo $footer; ?>
