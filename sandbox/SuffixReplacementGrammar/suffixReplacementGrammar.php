<?php

require_once("./Stack.php");
require_once("./StackNode.php");
require_once("../queue.php");

class SuffixReplacementGrammarCaseTestCase
{
    private $rules; /** @var array array of rules */
    private $N; /** @var int number of rules */
    private $start; /** @var string starting point string */
    private $goal; /** @var string desired goal string */


    public function __construct($numberOrRules, $start, $goal)
    {
        $this->N = $numberOrRules;
        $this->start = $start;
        $this->goal = $goal;
        $this->rules = array();
    }

    public function addRule($rule)
    {
        $this->rules[] = $rule;
    }


    public function tryToReachGoal()
    {
        $smallestDistance = INF;

        $route = new \PHP_Algorithms\sandbox\Queue();
        $marked = array();

//        $route->enqueue($this->start);
        $route->enqueue(new CurrentStringState(null, null, $this->start));

        while (!$route->isEmpty()) {
            $currentStringState = $route->dequeue();
            foreach ($this->rules as $index => $rule) {
                if ($currentStringState->canTransform($rule)) {
//                    $newString = $rule->transform($currentStringState->getStringState());
                    $newStringState = new CurrentStringState($currentStringState, $rule);
//                    if (!isset($marked[$newString])) {
                    if (!isset($marked[$newStringState->getStringState()])) {
//                        if ($newString == $this->goal) {
                        if ($newStringState->getStringState() == $this->goal) {
                            $distance = $currentStringState->getDistance();
                            if ($distance < $smallestDistance) {
                                $smallestDistance = $distance;
                            }
                        } else {
                            $route->enqueue($newStringState);
                            $marked[$newStringState->getStringState()] = true;
                        }
                    }
                }
            }
        }

        return $smallestDistance;
    }


    public function getN()
    {
        return $this->N;
    }

}


class Rule
{
    private $suffix;
    private $replacemnetSuffix;
    private $length;


    public function __construct($suffix, $replacementSuffix)
    {
        if (strlen($suffix) != strlen($replacementSuffix)) {
            throw new \InvalidArgumentException("suffix and replacement must be of the same length");
        }
        $this->suffix = $suffix;
        $this->replacemnetSuffix = $replacementSuffix;

        $this->length = strlen($suffix);
    }

    public function canTransform($string)
    {
        if (substr($string, -$this->length) == $this->suffix) {
            return true;
        } else {
            return false;
        }

    }


    public function transform($string)
    {
        if (!$this->canTransform($string)) {
            throw new \InvalidArgumentException("this string does not have a valid suffix to change");
        }

        $result = substr_replace($string, $this->replacemnetSuffix, -$this->length);
        return $result;
    }


}

class CurrentStringState
{
    private $route; /** @var  Queue queue of rules necessary to get to this state */
    private $stringState; /** @var String current string state */


    public function __construct($previousState = null, $rule = null, $stringState = null)
    {
        if ($previousState == null) {
            $this->route = new \PHP_Algorithms\sandbox\Queue();
//            $this->route->enqueue($rule);
            $this->stringState = $stringState;
        } else {
            $this->route = $previousState->getRoute();
            $this->route = $this->route->enqueue($rule);
            $this->stringState = $rule->transform($previousState->getStringState());
        }
    }


    public function getRoute()
    {
        return $this->route;
    }


    public function getStringState()
    {
        return $this->stringState;
    }

    public function canTransform($rule)
    {
        return $rule->canTransform($this->stringState);
    }

    public function getDistance()
    {
        return $this->route->size();
    }
}


function setupAndRun($filename)
{
    $handle = fopen($filename, "r");

    $tempTestCase = null;
    $numberOfTestCases = 0;

    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $line = str_replace("\n", "", $line);
            $line = rtrim($line);

            if ($line == ".") {
                break;
            }

            $pieces = preg_split('/\s+/', $line);

            if (ctype_digit($pieces[count($pieces) - 1]) == true) {
                $start = $pieces[0];
                $goal = $pieces[1];
                $numberOrRules = $pieces[2];
                $tempTestCase = new SuffixReplacementGrammarCaseTestCase($numberOrRules, $start, $goal);
                $numberOfTestCases++;
                $countRules = 0;
            } else {
                $suffix = $pieces[0];
                $replacementSuffix = $pieces[1];
                $rule = new Rule($suffix, $replacementSuffix);
                $tempTestCase->addRule($rule);
                $countRules++;
                if ($countRules >= $tempTestCase->getN()) {
                    $dist = $tempTestCase->tryToReachGoal();

                    $distanceDisplay = ($dist != INF)? $dist + 1 : "No Solution";

                    echo "Case " . $numberOfTestCases . ": " . $distanceDisplay . "<br/>";
                    unset($tempTestCase);
                }
            }

        }
    } else {
        // error opening the file.
        "no file exists";
    }

    $count = 1;
//    foreach ($project as $testCase) {
//        $dist = $testCase->tryToReachGoal();
//
//        // add in 1 to account for starting point
//        $distanceDisplay = ($dist != INF)? $dist + 1 : "No Solution";
//
//
//        echo "Case " . $count . ": " . $distanceDisplay . "<br/>";
//        $count++;
//    }

}


setupAndRun("suffixRules.txt");