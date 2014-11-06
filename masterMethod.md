
# Master Method

A "black box" for solving recurrences

Critical Assumption : All sub-problems have equal size.

1. Base Case : T(n) <= a constant for all sufficiently small n

2. For all larger n:

T(n) <= aT(n/b) + o(n^d)

where

a = number of recursive (>= 1)
b = input size shrinkage factor (> 1)
d = exponent in running time of "combine step" (>=0)

[a,b,d independent of n]


Case 1 : if a = b^d  T(n) = o(n^d) log n

Case 2 : if a < b^d  T(n) = o(n^d)

Case 3 : if a > b^d  T(n) = o(n^logb a)