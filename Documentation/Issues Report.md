
## MySQL Issue: Constraints

We designed some constraints but, they didn't work. According to information taken from StackOverflow and other
sites, we discovered that, depending on the database motor, constraints did not apply. Our database motor was InnoDB that 
supposedly should have constraints; nonetheless, they didn't apply.
Our temporary solution was to discard constraints from our scheme so we would not slow down. Therefore, all the checking
will be done in the PHP scripts that we will use in our backend.

## MySQL Issue: Procedures

To facilitate the communication with the database, we schematised various procedures. The problem we found was related to 
the core of MySQL: how the if/else structure is formed, how we need to specify a delimiter after each block and other problems.
Because of this, we decided to use MySQL only to store our information.


