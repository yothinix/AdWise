<?php

class Apriori extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function Apriori($Dataset)
    {
        //this function get dataset from sets of | result | occupation | tags(i) |
        //using minimum support = 2 and target support = 3 as a variable
        //Implement base on Apriori algorithm with enchancement in Dynamic minimum support
        //and targetsets as a result to compare with TID or occupationID 
        //                       ## Format of database table ##
        // | TransactionID (Occupation) |                     Tagitems                   |
        // |----------------------------|------------------------------------------------|
        // |  Software Engineer         | Computer, Programmer, Engineer, Development,   |
        // |  Software Tester           | Computer, Tester, Quality Control              |
        // |  Project Manager           | Technology, Management, Development            |
        // |  Scrum Master              | Management, Development                        |
        // |  System Analyst            | Computer, Technology, Development              |
        // |  DevOps                    | Computer, Engineer, Quality Control, Operation |
        // |----------------------------|------------------------------------------------|
        // ## Format of L1 table ##
        // |      itemset    | support |
        // |-----------------|---------|
        // | Computer        |    4    |
        // | Programmer      |    1    |
        // | Engineer        |    2    |
        // | Development     |    4    |
        // | Tester          |    1    |
        // | Quality Control |    2    |
        // | Technology      |    2    |
        // | Management      |    2    |
        // | Operation       |    1    |
        // |-----------------|---------|
        // 1) L1 = { frequent items};
        // 2) for (k = 1; Lk != Uk ; k++) do begin
        // 3) Ck+1 = candidates generated from Lk 
        // 4) for each transaction t in database do
        // 5) increment the count of all candidates in Ck+1 that
        //    contained in t
        // 6) Lk+1 = All candidates in Ck with minimum support;
        // 7) end
        // 8) return = UkLk;

        $Database  = $Dataset;

    }

}
