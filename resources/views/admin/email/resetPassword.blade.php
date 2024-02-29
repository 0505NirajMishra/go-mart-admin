<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<style>
    .form-gap {
        padding-top: 70px;
    }

    .error {
        color: red;
    }
</style>
<div class="form-gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">

                            @if ($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="error" style="list-style-type: none;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <form class="form" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user[0]['id'] }}">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                        <input id="password" type="password" name="password" placeholder="New Password" class="form-control" />
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                        <input id="password" type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-lg btn-primary btn-block" />
                                </div>
                                <input type="hidden" class="hide" name="token" id="token" value="" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- / -->