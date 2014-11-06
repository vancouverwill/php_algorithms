## php_algorithms
==============

php_algorithms. I have implemented the methods here in PHP purely as a learning exercise.
I worked with the algorithms in http://algs4.cs.princeton.edu/code/ and to make sure I understood
them I have implemented and tested them in PHP.



## Big-Oh Notation

Upper Bounds

T(n) = o(f(n)) if and only if there exists constants c, n0 > 0 such that

T(n) <= c * f(n)

for all

n >= n0


## Omega Notation

Lower Bounds

T(n) = Ω(f(n)) If and only if there exists constants c, n0 > 0 such that

T(n) >= c * f(n)

for all

n >= n0


## Theta Notation

T(n) = Θ(f(n)) If and only if T(n) = Ω(f(n)) and T(n) = o(f(n))

and there exists constants c1, c2 n0 > 0 such that

 c1 * f(n) <= T(n) <= c2 * f(n)


TO DO 
============

* create compare sort to show difference in speed between different algorithms
* bottom up mergesort
* bubble sort
