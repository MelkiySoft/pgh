<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test for SmartyMedia</title>

    <link href="/css/main.css" rel="stylesheet">
    <script src="/js/jquery-3.2.1.min.js"></script>


</head>
<body>

<?php //var_dump($_SERVER); ?>

<div class="start">
    <div class="forms">
        <div class="form">

            <select name="field" size="1" title="Field">
                <option selected disabled>field...</option>
                <option value="size">size</option>
                <option value="forks">forks</option>
                <option value="stars">stars</option>
                <option value="followers">followers</option>
            </select>

            <select name="operator" size="1" title="Operator">
                <option selected disabled>operator...</option>
                <option value=">">></option>
                <option value="">=</option>
                <option value="<"><</option>
            </select>

            <input type="number" name="value" size="25" title="Value" value="0" min="0">

            <input type="button" onclick="delete1(this.parentElement)" value="Delete">

        </div>

    </div>
    <br><hr><br>
    <div class="functional-buttons">
        <input type="button" onclick="apply(1)" value="Apply">
        <input type="button" onclick="clear1()" value="Clear">
        <input type="button" onclick="addrule()" value="Add Rule">
    </div>
</div>

<script>
    var countrules = 1;
    function delete1(rrr) {
        if (countrules > 1) {
            rrr.remove();
            countrules = countrules - 1;
        } else {
            rrr.children[0].value = 'field...';
            rrr.children[1].value = 'operator...';
            rrr.children[2].value = 0;
        }
    }
    function apply(num) {
        console.log('apply');
        var arrAll = [];
        for (var i = 0; i < countrules; i++) {
            var tmp = document.body.getElementsByClassName("form")[i];
            var field = tmp.children[0].value;
            var operator = tmp.children[1].value;
            var value = tmp.children[2].value;

            var obj = {};
            obj.field = field;
            obj.operator = operator;
            obj.value = value;
            arrAll.push(obj);
        }
        var obj2 = {};
        obj2.field = 'page';
        obj2.operator = '=';
        obj2.value = num;
        arrAll.push(obj2);

        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: {jsonForGitHub: JSON.stringify(arrAll)},
            dataType: 'json'
        })
            .always( function( data ) {
                $(".result").remove();
                //document.body.getElementsByClassName("result").remove();
                var div = document.createElement('div');
                div.insertAdjacentHTML("afterBegin", data.responseText);
                div.className = "result";
                document.body.appendChild(div);
            });
    }
    function clear1() {
        console.log('clear');
        var tmp = $(".forms div:first").clone();
        $(".forms div").remove();
        tmp.appendTo(".forms");
        countrules = 1;
    }
    function addrule() {
        if (countrules < 4) {
            countrules = countrules + 1;
            $(".forms div:first").clone().appendTo(".forms");
        }
    }
</script>





</body>
</html>