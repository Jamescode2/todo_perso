<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todos</title>
    <style>

    body{margin:0;padding:0;font-family:sans-serif;--primary-color:#55b;}
    h1{text-align:center;margin-top:50px;}

    .modal{display:none;;width:100vw;height:100vh;position:fixed;top:0;left:0;flex-direction:column;justify-content:space-around;color:white;background-color:rgba(0,0,0,0.8)}
    .modal *{margin:auto;}

    #addBtn{height:50px;width:50px;border-radius:50%;background-color:var(--primary-color);color:white;line-height:50px;font-size:36px;text-align:center;position:fixed;top:50px;right:50px;}

    .closeBtn{display:inline-block;height:50px;width:50px;line-height:50px;font-size:36px;text-align:center;background-color:#111;position:absolute;top:50px;right:50px;}

    #list{margin-top:100px;width:720px;max-width:100%;margin:auto;}

    .pseudoTxtarea{height:250px;overflow:auto;max-width:100%;width:720px;background-color:#ccc;color:#333;font-size:20px;padding:1em;}

    .pseudoBtn{padding:.75em 1.5em;color:white;font-weight:bold;letter-spacing:.5px;background-color:var(--primary-color);}
    #addBtn:hover,.closeBtn:hover,.pseudoBtn:hover{cursor:pointer;}

    </style>
</head>

<body>

<div id="main">
    <h1>Todo list</h1>
    <div id="addBtn" onclick="openCreateDialog()">+</div>
    <div id="list"></div>
</div>

<!-- fenêtre de création de nouveau todo -->
<div class="modal" id="modal1">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closeCreateDialog()">X</span></div>
    <h2>-- create new Todo --</h2>
    <p class="pseudoTxtarea" id="todoContent" contenteditable>&nbsp;</p>
    <div style="text-align:center;"><span class="pseudoBtn" onclick="createTodo()">Créer</span></div>
</div>

<!-- fenêtre de mise à jour d'un todo existant -->
<div class="modal" id="modal2">
</div>


<script>

function openCreateDialog(){
    document.getElementById("modal1").style.display="flex";
}

function closeCreateDialog(){
    document.getElementById("modal1").style.display="none";
}

function readall() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "readall.php");
        xhr.send();
        xhr.onload = function () {
            let reponse = xhr.response;
            todolist2html(JSON.parse(reponse));
        }
    }
    function todo2html(todoJson) {
        return '<div class="toWrap" id="todo-'+todoJson.id+'">'+
                '<div style="width:100%;height:100px;background-color:pink;text-align:center;margin:10px 0">'+
                '<p>'+todoJson.id+'</p>'+
                '<p>'+todoJson.content+'</p>'+
                '<p>'+todoJson.important+'</p>'+
                '</div>'+
                '<div style="display:flex;justify-content:space-around;">'+
                '<img src="edit.png">'+
                '<img src="flag.png">'+
                '<img src="color.png">'+
                '<img src="strike.png">'+
                '<img src="delete.png" onclick="deleteTodo('+todoJson.id+')">'+
                '</div>'+
                '</div>';
    }

    function todolist2html(todolistJson){
            var str='';
            for (let i = 0; i < todolistJson.length; i++) {
                str += todo2html(todolistJson[i]);
            }
            document.getElementById("list").innerHTML = str;
    }
    

        function deleteTodo(todoId){
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "delete.php?id="+todoId);
        xhr.send();
        xhr.onload = function () {
            let reponse = xhr.response;
        }
        document.getElementById("todo-"+todoId).style.display = "none";
    }

    function createTodo() {
        let newContent = document.getElementById("todoContent").innerText;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", 'create.php?content="'+newContent);
        xhr.send();
        xhr.onload = function () {
            let reponse = JSON.parse(xhr.response);
            let newTodo = {};
            newTodo.id = reponse.id;
            newTodo.content = newContent;
            document.getElementById("list").innerHTML += todo2html(newTodo);
        }
    }
    document.getElementById("list").innerHTML = readall();
</script>
</body>

</html>


