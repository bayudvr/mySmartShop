<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Management : User</title>
    @include('plugin.plugin-admin')
</head>
<body class="landing-page">
    @include('layout.admin.navbar')
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('../public/img/bg.jpg'); background-size: cover; background-repeat: no-repeat; margin-bottom: -200px;">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-7">
    				<h1 class="title" style="text-shadow: 4px 4px black;">Users Data</h1>
    				<br>
    				<div></div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="main main-raised">
    	<div class="container">
    		<div class="table-responsive pb-5 mb-5" id="data"></div>
    	</div>
    </div>
</body>
</html>
@include('js.js-admin')
<script type="text/javascript">
    
    $(document).ready(function(){
        showDataUser();       
    });

    function showDataUser(){

        $.ajax({
            url:'../data/user',
            method:'get',
            dataType:'json',
            processData: false,
            contentType: false,
            success:function(data){

                $('#data').html(data);
                $('#tdata').DataTable();
                toastr.success('Data Retrieved!', 'All Set');
            }
        });
    }
    
</script>