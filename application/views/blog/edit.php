
<!-- /.Navbar  Static Side -->
<div class="control-sidebar-bg"></div>
<!-- Page Content -->
<div id="page-wrapper">
    <!-- main content -->
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="header-icon">
                <i class="pe-7s-note2"></i>
            </div>
            <div class="header-title">
                <h1>Edit Blog</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Edit Blog</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>blog/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $blog["id"] ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Edit Blog</h4>
                            </div>
                        </div>
                        <div class="panel-body"><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Title<span class="required">*</span></label>
                                        <div class="col-sm-9">
<?php $Title = explode(",", $blog["Title"]) ?>
                                        <input class="form-control" name="Title" type="text" value="<?php echo $blog["Title"] ?>" id="example-text-input" placeholder="" required=""></div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Description<span class="required">*</span></label>
                                        <div class="col-sm-9">
<?php $Description = explode(",", $blog["Description"]) ?>
                                        <textarea class="form-control" name="Description" required=""><?php echo $blog["Description"] ?></textarea></div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Category<span class="required">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="category" required="">
                                                <option>Select Category</option><?php foreach ($table_blog_category as $t) {?>
                                                    <option value="<?php echo $t["id"] ?>" <?php if($t["id"] == $blog["category"]) echo "selected" ?>><?php echo $t["Name"] ?></option>
                                               <?php } ?></select>
                                        </div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Image<span class="required">*</span></label>
                                        <div class="col-sm-9">
<?php $image = explode(",", $blog["image"]) ?>
                                        <input class="form-control" name="image" type="file" value="" id="example-text-input" placeholder=""></div>

                                    </div><div class="form-group row">

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
<!-- /.main content -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- START CORE PLUGINS -->
