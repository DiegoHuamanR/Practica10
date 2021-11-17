<?php
//model.php
function open_database_connection()
{
    $link = mysqli_connect("localhost", "root", "clavenueva", "universidad");
    /* verificar la conexión */
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        exit();
    }
    return $link;
}
function close_database_connection($link)
{
    mysqli_close($link);
}
function get_all_posts()
{
    $link =open_database_connection();
    $consulta = "SELECT id, nombre from cursos";
    $result = mysqli_query($link, $consulta);
    $curso = array();
    while($row = mysqli_fetch_assoc($result)){
        $curso[] = $row;
    }
    close_database_connection($link);
    return $curso;
}