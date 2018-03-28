@if(Session::has('success'))
    <div class="col-md-12">
        <div class="alert alert-success fade in centrado_con" align="center">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <span class="glyphicon glyphicon-ok alert-icon" style="font-size: 20px"></span> <strong>{{ session('success') }}</strong>
        </div>
    </div>
@endif
@if(Session::has('info'))
    <div class="col-md-12">
        <div class="alert alert-info fade in centrado_con" align="center">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <span class="glyphicon glyphicon-info-sign alert-icon"></span> <strong>{{ session('info') }}</strong>
        </div>
    </div>
@endif
@if(Session::has('danger'))
    <div class="col-md-12">
        <div class="alert alert-danger fade in centrado_con" align="center">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <span class="glyphicon glyphicon-remove-circle alert-icon"></span> <strong>{{ session('danger') }}</strong>
        </div>
    </div>
@endif
@if(Session::has('warning'))
    <div class="col-md-12">
        <div class="alert alert-warning fade in centrado_con" align="center">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-times"></i>
            </button>
            <span class="glyphicon glyphicon-warning-sign alert-icon"></span> <strong>{{ session('warning') }}</strong>
        </div>
    </div>
@endif