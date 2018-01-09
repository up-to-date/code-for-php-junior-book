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
    <h2>할 일 추가하기</h2>
    <form action="/tasks" method="post">
        <input type="hidden" name="<?=$csrf['nameKey'];?>" value="<?=$csrf['name'];?>">
        <input type="hidden" name="<?=$csrf['valueKey'];?>" value="<?=$csrf['value'];?>">
        <input type="text" name="name">
        <button type="submit">추가</button>
    </form>
</section>

<?php if(isset($tasks)): ?>
<section>
    <h2>할 일 목록</h2>
    <ul>
    <?php foreach($tasks as $task): ?>
        <li>
            <?=$task['name'];?>
            <a href="/task/edit?id=<?=$task['id'];?>"><button>수정</button></a>
        </li>
    <?php endforeach;?>
    </ul>
</section>
<?php endif;?>

</body>
</html>