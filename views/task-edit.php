<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/default.css">
    <title>Mission Todo List</title>
</head>
<body>
<header>
    <h1>Todo List</h1>
</header>
<section>
    <h2>할 일 수정하기</h2>
    <form action="/tasks/<?=$task['id'];?>" method="post">
        <input type="hidden" name="_METHOD" value="PUT">
        <input type="hidden" name="<?=$csrf['nameKey'];?>" value="<?=$csrf['name'];?>">
        <input type="hidden" name="<?=$csrf['valueKey'];?>" value="<?=$csrf['value'];?>">
        <input type="text" name="name" value="<?=$task['name'];?>">
        <button type="submit">수정</button>
    </form>
</section>
</body>
</html>