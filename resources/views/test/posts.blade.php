<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container-fluid">
   <div class="row p-5">
       <div class="col-12">
           <h2>Stacked form</h2>
           <form action="{{ url('searchMultipleScopeSearch') }}" method="post">
               @csrf
               <div class="form-group">
                   <label for="search">Enter Text:</label>
                   <input type="search" class="form-control" id="search" placeholder="Enter text" name="search">
               </div>
               <button type="submit" class="btn btn-primary">Search</button>
           </form>
       </div>
   </div>
</div>

</body>
</html>