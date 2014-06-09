<?php
/**
 *
 * Here we will Kosaraju’s Two-­‐Pass Algorith
 * to calculate strongly connected componenets
 * Strongly connected components in a directed graph are directed cycles within the graph
 *
 * let grev = G with all arcs reversed
 *
 * run dfs loop on Grev
 * goal : compute "magical ordering" of nodes
 * let f(V) = "finishing time" of each v in V
 *
 *
 * run dfs loop on G
 * goal discover the SCCs one-by-one
 * processing nodes in decreasing order of finishing times
 *
 * [SCCs = nodes with the same “leader” ]
 *
 * Created by PhpStorm.
 * User: will_melbourne
 * Date: 2014-06-08
 * Time: 10:07 PM
 */

class StronglyConnectComponents {

} 