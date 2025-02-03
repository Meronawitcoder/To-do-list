<?php
$todos = [];
if (file_exists('todo.json')) {
    $json = file_get_contents('todo.json');
    $todos = json_decode($json, true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <style>
        body {
            background-color: #000000;
            color: #FFC0CB;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        form {
            margin: 10px 0;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #FFC0CB;
            border-radius: 5px;
            margin-right: 10px;
            width: 200px;
        }

        button {
            padding: 10px 20px;
            background-color: #FFC0CB;
            border: none;
            border-radius: 5px;
            color: #000000;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #FF69B4;
        }

        .todo-item {
            display: flex;
            align-items: center;
            margin-bottom: 4px;
            width: 300px; /* Consistent width for todo items */
        }

        .todo-item input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.5);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .todo-item input[type="checkbox"]:hover {
            transform: scale(1.7);
        }

        .todo-item button {
            margin-left: auto; /* Ensure buttons are right-aligned */
            background-color: #FF69B4;
            padding: 5px 10px; /* Smaller button size */
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .todo-item button:hover {
            background-color: #FF1493;
            transform: scale(1.2); /* Grow button on hover */
        }

        .todo-item div {
            flex-grow: 1;
            margin-right: 10px; /* Gap between text and delete button */
        }

    </style>
</head>
<body>
    <h1>Todo List</h1>
    <form action="newtodo.php" method="post">
        <input type="text" name="todo_name" placeholder="Enter your todo here...">
        <button>New Todo</button>
    </form>
    <br>
    <?php foreach ($todos as $todoName => $todo): ?>
        <div class="todo-item">
            <form style="display:inline-block" action="change_status.php" method="post">
                <input type="hidden" name="todo_name" value="<?php echo $todoName; ?>">
                <input type="checkbox" <?php echo $todo['completed'] ? 'checked' : ''; ?>>
            </form>
            <div><?php echo $todoName ?></div>
            <form action="delete.php" method="post" style="display:inline;">
                <input type="hidden" name="todo_name" value="<?php echo $todoName; ?>">
                <button>Delete</button>
            </form>
        </div>
    <?php endforeach; ?>
    <script>
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(ch => {
            ch.onclick = function () {
                this.parentNode.submit();
            };
        });
    </script>
</body>
</html>
