<!DOCTYPE html>
<html lang="en">
<head>
    <title>Social Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row p-5">
        <div class="col-12">
            <a href="javascript:;" id="login">Login With Google</a>
        </div>
    </div>
</div>

<script>
    $("#login").on('click',function (e) {
        e.preventDefault();
        var token = "{{ csrf_token() }}";
        $.ajax({
            type: "POST",
            url: "{{ url('social/google') }}",
            data: { '_token':token },
            success :function(res){
                console.log(res);
                window.location.href = res.data;
            }
        });
    });
</script>
</body>
</html>
