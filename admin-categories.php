<?php
    use \Hcode\PageAdmin;
    use \Hcode\Model\User;
    use \Hcode\Model\Category;

    //Rota que redireiona para página de categorias
$app->get("/admin/categories", function(){
	User::verifyLogin();
	$categories = Category::ListAll();
	$page = new PageAdmin();
	$page->setTpl("categories", [
		'categories'=>$categories
	]);
});

//Rota que redireciona para página de criaação de categoria
$app->get("/admin/categories/create", function(){
	User::verifyLogin();
	$page = new PageAdmin();
	$page->setTpl("categories-create");
});

//Rota que envia os dados do formulário para a criaação da categoria
$app->post("/admin/categories/create", function(){
	User::verifyLogin();
	$category = new Category();
	$category->setData($_POST);
	$category->save();
	header("Location: /admin/categories");
	exit;
});

//Rota que deleta categoria
$app->get("/admin/categories/:idcategory/delete", function($idcategory){
	User::verifyLogin();
	$category = new Category();
	$category->get((int)$idcategory);
	$category->delete();
	header("Location: /admin/categories");
	exit;
});

//Rota que redireciona para a página de edição de categoria

$app->get("/admin/categories/:idcategory", function($idcategory){
	User::verifyLogin();
	$category = new Category();
	$category->get((int)$idcategory);
	$page = new PageAdmin();
	$page->setTpl("categories-update", [
		'category'=>$category->getValues()
	]);	
});
$app->post("/admin/categories/:idcategory", function($idcategory){
	User::verifyLogin();
	$category = new Category();
	$category->get((int)$idcategory);
	$category->setData($_POST);
	$category->save();	
	header('Location: /admin/categories');
	exit;
});
?>