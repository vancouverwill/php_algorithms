
# The Divide and Conquer Paradigm

1. Divide into smaller subproblems

2. Conquer subproblems recursively

3. Combine solutions of subproblems into one for the original problem


# Matrix Algorithm

Calculating the product of two matrices has an order of 3 asymptotic running time from the size of the matrix.

Each element gets multiplied as many elements as the matrix is wide or high (both are n).
The matrix is of area n^2 so overall that makes the running time n^3.

X * Y = Z

where

Zij = (ith row of X) * (jth row of Y)

If you apply divide and conquer on matrix algorithm splitting each matrix up four ways you still end up with Θ(f(n^3))

# Strassens Algorithm

1. Recursively compute only 7 (very cleverly chosen) products

2. do the necessary clever additions + subtractions

(still Θ(f(n^2 but that is an order of magnitude greater than the normal method)