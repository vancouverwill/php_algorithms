<?php
/**
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-02-02
 * Time: 6:29 PM
 */
/**
 * Class Stack
 *
 * todo create iterator
 */

class Stack {

    private $N; //int
    private $first; //Node

public function isEmpty() {
    return $this->first == null;
}

public function size()
{
    return $this->N;
}


    /**
     * @param $item
     *
     * // Add item to top of stack.
     */
    public function push($item)
    {
        $oldfirst = $this->first;
        $this->first = new Node();
        $this->first->item = $item;
        $this->first->next = $oldfirst;
        $this->N++;
    }

    // Remove item from top of stack.

    public function pop()
    {
        $item = $this->first->item;
        $this->first = $this->first->next;
        $this->N--;
        return $item;
    }

}


class Node {
    public $item;
    public $next;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/bower_components/bootstrap-css/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<h1>Hello, world!</h1>

<?php

$stack = new Stack();

$stack->push("red");
$stack->push("orange");
$stack->push("yellow");

echo $stack->size() . '<br/>';
echo $stack->isEmpty() . '<br/>';


while(!$stack->isEmpty()) {
    echo '' . $stack->pop() . '<br/>';
}

?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/bower_components/bootstrap-css/js/bootstrap.min.js"></script>
</body>
</html>
