# Graphs

Standard notation for graphs is Vertices are labelelle with V and edges with E.

A CUT of a graph splits the graph into two non empty sets A and B.

A graph with n vertices has 2^n cuts

## Min Cut - The cut with fewest number of crossing edges.

The minimum number of edges a graph can have is (n-1)

The maximum number of edges a graph can have is (n-1)n/2

If n = # of vertices and m = # of edges in most cases (not all) m is Ω(n) and O(n^2)

A sparse graph is m is close to O(n)

A dense graph m is close to Θ(n)


## Adjacency Matrix

Represent G by a n * n matrix A where A(ij) = 1 if G has an edge i <-> j
An adjacency matrix  uses n^2 space


## Adjacency List

Array or list of vertices and array or list of edges.
Each edge points to it's endpoints.
Each vertex points to edges incident to it.

# Usage of graphs

- Check if a network is connected
- Driving Directions
- Formulate a plan such as how to do a sudoku puzzle. Each node is a variation of a partially completed puzzle. --arcs is a sequence of moves to a complete puzzle
- Computing the density of components on a graph such as connectivity on the web

# Graph Search Algorithms

# Breadth First Search BFS
- explores nodes in layers
- can compute shortest paths from s (start)
- can compute connected components of an undirected graph
- run time o(m + n) i.e. linear time where n = number of nodes reachable from s and m = number of edges reachable from s
- works with a queue data structure FIFO

## applications
    - shortest paths. need another array which is distance to each node, initialize nodes by 0 if v = s otherwise infinity if v is not equal to s
    - undirected connectivity. check if network is disconnected for graph visualization and clustering
    --	initalize	all	nodes	as	unexplored	O(n)
    [assume	labelled 1	to	n]
    -- for i = 1 to	n	O(n)
    	--	if	i	not	yet	explored [in some previous BFS]
            --	BFS(G,i) [discovers	precisely i’s connected	component]


# Depth First Search DFS
- explores aggressively like a maze, only backtracks when necessary
- compute topological ordering of a directed acyclic graph //todo explain topological
A topological or topsort or topologoical ordering of a directed graph is a linear ordering of its vertices such that for every directed edge uv from vertex u to vertex v, u becomes before v in the ordering.
An example is the vertices of the graph represent the order tasks must be done, and each edge represents one task that must be done before another. In this case the topological ordering is the valid sequence of tasks.
- compute connected components in directed graphs
- works with a stack data structure LIFO


# Strongly Connected Components

- Reflexive : Every vertex v is strongly connected to itself.
- Symmetric : If v is strongly connected to w, then w is strongly connected to v.
- Transitive : If v is strongly connected to w and w is strongly connected to x, then v is also strongly connected to x.


# Radius

