<?php

/**
 * author : will Melbourne
 * date : 13 January 2015
 */


class SuffixReplacementGrammarCaseTestCase
{
    private $rules; /** @var array array of rules */
    private $N; /** @var int number of rules */
    private $start; /** @var string starting point string */
    private $goal;  /** @var string desired goal string */
    private $debug = false;


    public function __construct($numberOfRules, $start, $goal)
    {
        $this->N = $numberOfRules;
        $this->start = $start;
        $this->goal = $goal;
        $this->rules = array();
    }

    public function addRule($rule)
    {
        $this->rules[] = $rule;
    }


    /**
     * approach 1 - use regular queue to enqueue steps i.e. BFS
     * A BFS search progressively outwards so the first time we reach the goal we know it is the fastest route.
     *
     * Whereas if we use a DFS we have to test every possible route to reach the goal to determine which was the fastest route to the goal.
     *
     *
     */
    public function tryToReachGoal()
    {
        $q = new SplQueue();
        $marked = array();
        $distance = array();
        $distance[$this->start] = 0;

        $q->enqueue($this->start);

        while (!$q->isEmpty()) {
            $currentString = $q->dequeue();
            foreach ($this->rules as $index => $rule) {
                if ($rule->canTransform($currentString)) {
                    $newString = $rule->transform($currentString);
                    if (!isset($marked[$newString])) {
                            $q->enqueue($newString);
                            $marked[$newString] = true;
                            $distance[$newString] = $distance[$currentString] + 1;
                    }
                }
            }
        }

        if (isset($distance[$this->goal])) {
            return $distance[$this->goal];
        } else {
            return "No Solution";
        }
    }


    public function tryToReachGoalWithCurrentStringState()
    {
        $smallestDistance = INF;

        $q = new SplQueue();
        $marked = array();

        $q->enqueue(new CurrentStringState(null, null, $this->start));

        while (!$q->isEmpty()) {
            $currentStringState = $q->dequeue();
            foreach ($this->rules as $index => $rule) {
                if ($currentStringState->canTransform($rule)) {
                    $newStringState = new CurrentStringState($currentStringState, $rule);
                    if (!isset($marked[$newStringState->getStringState()])) {
                        if ($newStringState->getStringState() == $this->goal) {
                            $smallestDistance = $newStringState->getDistance();
                            if ($this->debug) {
                                $this->showRoute($newStringState);
                            }
                        }

                        $q->enqueue($newStringState);
                        $marked[$newStringState->getStringState()] = true;
                    }
                }
            }
        }

        if ($smallestDistance == INF) {
            return "No Solution";
        } else {
            return $smallestDistance;
        }
    }


    public function getN()
    {
        return $this->N;
    }

    public function showRoute($stringState) {
        echo $this->start . " " . $stringState->returnRouteString();
    }

}


class Rule
{
    private $suffix;
    private $replacementSuffix;
    private $length;


    public function __construct($suffix, $replacementSuffix)
    {
        if (strlen($suffix) != strlen($replacementSuffix)) {
            throw new \InvalidArgumentException("suffix and replacement must be of the same length");
        }
        $this->suffix = $suffix;
        $this->replacementSuffix = $replacementSuffix;

        $this->length = strlen($suffix);
    }

    public function canTransform($string)
    {
        return (substr($string, -$this->length) == $this->suffix);
    }


    public function transform($string)
    {
        $result = substr_replace($string, $this->replacementSuffix, -$this->length);
        return $result;
    }

    public function getSuffix() {
        return $this->suffix;
    }

    public function getReplacementSuffix() {
        return $this->replacementSuffix;
    }


}


class CurrentStringState
{
    private $routeStack; /** @var  Queue queue of rules necessary to get to this state */
    private $stringState; /** @var String current string state */


    public function __construct($previousState = null, $rule = null, $stringState = null)
    {
        if ($previousState == null) {
            $this->routeStack = array();
            $this->stringState = $stringState;
        } else {
            $this->routeStack = $previousState->getRoute();
            array_push($this->routeStack, $rule);
            $this->stringState = $rule->transform($previousState->getStringState());
        }
    }

    public function goBackOneStep() {
        array_pop($this->routeStack);
    }

    public function getRoute()
    {
        return $this->routeStack;
    }

    public function returnRouteString()
    {
        $string = "";

        foreach($this->routeStack AS $rule) {
            $string .= $rule->getSuffix() . "->" . $rule->getReplacementSuffix() . " ";
        }
        return $string;
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
        return count($this->routeStack);
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
                $numberOfRules = $pieces[2];
                $tempTestCase = new SuffixReplacementGrammarCaseTestCase($numberOfRules, $start, $goal);
                $numberOfTestCases++;
                $countRules = 0;
            } else {
                $suffix = $pieces[0];
                $replacementSuffix = $pieces[1];
                $rule = new Rule($suffix, $replacementSuffix);
                $tempTestCase->addRule($rule);
                $countRules++;
                if ($countRules >= $tempTestCase->getN()) {
                    $dist = $tempTestCase->tryToReachGoalWithCurrentStringState();
                    echo "Case " . $numberOfTestCases . ": " . $dist . PHP_EOL;
                    unset($tempTestCase);
                }
            }

        }
        fclose($handle);
    } else {
        // error opening the file.
        exit("no file exists");

    }

}


print "please enter the test data filename relative to this file to get started" . PHP_EOL;

$fh = fopen('php://stdin','r') or die($php_errormsg);
while($s = fgets($fh,1024)) {
    print "You typed: $s";
    setupAndRun(trim($s));
    exit;
}

