<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes' name='viewport'>
	<title>Upload IMG</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/font-awesome.min.css">
	<style type="text/css" media="screen">
		body { padding: 30px }
		form { margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px; }
		#percent { display: block; position: absolute; text-align: center; font-weight: bold; }
	</style>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<form id="formulario" method="post" enctype="multipart/form-data" action="upload.php">
				<div class="form-group">
					<input type="button" class="form-group form-control btn btn-primary btn-block" id="btn-reset" name="btn-reset" value="Reset" style="font-weight: bold;">
				</div>
				<div class="form-group input-group">
					<div class="input-group-addon">
                    	<i class="fa fa-file" aria-hidden="true"></i>
                    </div>
					<input type="file" class="form-group form-control input-sm" id="imagem" name="imagem" style="font-weight: bold;">
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="progress progress-striped active">
							<div class="progress-bar progress-success" id="bar">
							</div>
							<div class="col-md-12" id="percent">0%</div >
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	     
	     var bar = $('#bar');
	     var percent = $('#percent');
	     var status = $('#status');
	     /* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
	     $('#imagem').on('change',function(){
	        //$('#progress2').html('<center><img src="loading2.gif" width="50" height="50"/></center>');
	        /* Efetua o Upload sem dar refresh na pagina */
	        $('#formulario').ajaxForm({
	        	//target:'#visualizar', // o callback será no elemento com o id #visualizar
	        	beforeSend: function() {
	            status.empty();
	            var percentVal = '0%';
	            bar.width(percentVal);
	            percent.html(percentVal);
	        	},
	        	uploadProgress: function(event, position, total, percentComplete) {
	            var percentVal = percentComplete + '%';
	            bar.width(percentVal);
	            percent.html(percentVal);
	        	},
	        	complete: function(xhr) {
	          	status.html(xhr.responseText);
	          	//percent.html('Sucesso!');
	          	//$('#progress2').html('');
	        	}
	        }).submit();
	     });

	     $('#btn-reset').click(function(e) {
	     	e.preventDefault();
	     	$('#formulario').resetForm();
	     	percent.html('0%');
	     	bar.css('width', '0');
	     });

	 });
</script>
</body>
</html>