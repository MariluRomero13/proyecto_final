<?php



//Rutas de login
Route::get("/", "UsuarioController@mostrarLogin")->name("login");
Route::post("/iniciarsesion", "UsuarioController@iniciarSesion");
Route::post("/logout","UsuarioController@cerrarSesion");

//Rutas de inicio
Route::get("/inicio",["middleware" => "verificador", "uses" => "PanelController@index"])->name('panel');
Route::get("/inicio","PanelController@index")->name('panel');

//Rutas de categoria
Route::get("/categorias", "categoriacontroller@vista");
Route::get("/cateagregar", "categoriacontroller@agregar");
Route::POST("/cateagregar", "categoriacontroller@agregarcate");
Route::get("/cateeditar/{id_cate}", "categoriacontroller@veditarcate");
Route::POST("/cateeditar/{id}", "categoriacontroller@editarcate");

//Rutas De Productos
Route::get("/viewproductos", "ProductosController@verproductos")->name('viewproductos'); //
Route::get("/viewregistrarproductos", "ProductosController@viewregistrarproductos")->name('viewregistrarproductos');
Route::post("/registrarproducto", "ProductosController@registrarproducto");
Route::get("/altaProducto", "ProductosController@altaProducto");
Route::get("/seleccionarproducto/{id}", "ProductosController@seleccionarproducto");
Route::post("/actualizarproducto/{id}", "ProductosController@actualizarproducto");
Route::get("/eliminar/{id}", "ProductosController@eliminarproducto");
Route::get("/vermasproductos/{id}","ProductosController@vermas");
Route::post("/buscarproducto", "ProductosController@buscar");

//Rutas de inventario
Route::get("/viewRegistrarInventario", "InventarioController@viewRegistrarInventario");
Route::post("/altaInventario", "InventarioController@registrarInventario");
Route::get("/viewMostrarInventario", "InventarioController@viewInventario")->name('viewInventario');
Route::get("/viewActualizarInventario/{id}", "InventarioController@viewActualizarInventario");
Route::post("/actualizarInventario/{id}", "InventarioController@actualizarInventario");
Route::get("/eliminarInventario/{id}", "InventarioController@eliminarInventario");
Route::post("/buscarinventario", "InventarioController@buscar");
