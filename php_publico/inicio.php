<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div id="galeria" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#galeria" data-slide-to="0" class="active"></li>
            <li data-target="#galeria" data-slide-to="1"></li>
            <li data-target="#galeria" data-slide-to="2"></li>
            <li data-target="#galeria" data-slide-to="3"></li>
            <li data-target="#galeria" data-slide-to="4"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img width="100%" src="carga_imagenes/20150215_173928.jpg" alt="Titulo">
            </div>
            <div class="item">
                <img width="100%" src="carga_imagenes/20150215_173944.jpg" alt="Titulo">
            </div>
            <div class="item">
                <img width="100%" src="carga_imagenes/20150602_145933.jpg" alt="Titulo">
            </div>
            <div class="item">
                <img width="100%" src="carga_imagenes/20150215_174525.jpg" alt="Titulo">
            </div>
            <div class="item">
                <img width="100%" src="carga_imagenes/20150213_104038.jpg" alt="Titulo">
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#galeria" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="right carousel-control" href="#galeria" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>
</body>
</html>