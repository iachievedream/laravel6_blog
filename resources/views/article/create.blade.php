<title>新增文章</title>
<form action="/store" method="POST">
	@csrf
	標題:<input type="text" name="title">
	內容:<input type="text" name="content">
	<button type="submit"> 新增</button>
</form>