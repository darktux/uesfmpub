<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
			#sombreado_dos{
				position: relative;
			}
           #sombreado_dos:before{
                bottom: 10px;
                box-shadow: 0 5px 5px 3px #000;
                content:"";
                left: 6px;
                position: absolute;
                -webkit-transform: rotate(-1deg);
                -moz-transform: rotate(-1deg);
                -ms-transform: rotate(-1deg);
                -o-transform: rotate(-1deg);
                transform: rotate(-1deg);
                width: 300px;
                z-index: -1;
           }
           #sombreado_dos:after{
                bottom: 10px;
                box-shadow: 0 5px 5px 3px #000;
                content:"";
                right: 6px;
                position: absolute;
                -webkit-transform: rotate(1deg);
                -moz-transform: rotate(1deg);
                -ms-transform: rotate(1deg);
                -o-transform: rotate(1deg);
                transform: rotate(1deg);
                width: 300px;
                z-index: -1;

           }
		</style>
	</head>
	<body>
		<div id="sombreado_dos">
			<iframe 
				src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1938.6782527435516!2d-88.78704349120073!3d13.636064783566884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2ssv!4v1432413315824" 
				width="100%"
				height="450"  
				frameborder="0" 
				style="border:0"
			>
			</iframe>
		</div>
	</body>
</html>